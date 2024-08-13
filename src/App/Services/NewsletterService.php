<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use Framework\Exceptions\ValidationException;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class NewsletterService
{
    public function __construct(private Database $db) {}

    public function getNewsletter(array $pagination)
    {
        $query = "SELECT * FROM newsletter 
         WHERE {$pagination['searchCol']} LIKE :searchTerm
         ORDER BY {$pagination['sort']} {$pagination['direction']}  
         LIMIT {$pagination['perPage']} OFFSET {$pagination['offset']}";

        $params = ['searchTerm' => "%{$pagination['searchTerm']}%"];

        $newsletterList = $this->db->query($query, $params)->findAll();

        // Another query to know the total number of results without the limit ans offset, we need this to calculate the next page link
        $queryTotalResults = "SELECT COUNT(*) FROM newsletter 
         WHERE {$pagination['searchCol']} LIKE :searchTerm";

        $totalResults = $this->db->query($queryTotalResults, $params)->count();

        return [$newsletterList, $totalResults];
    }

    /**
     * Create a new entry in the DB Table newsletter
     * @param array $userData form variables, email
     * @return Database
     */

    public function insertNewEmail(array $userData): Database
    {
        $query = "INSERT INTO newsletter(email) VALUES('{$userData['email']}')";
        return $this->db->query($query);
    }

    /**
     * Given an id obtains all the info from the DB Table newsletter
     * @param mixed $entryId
     * @return mixed
     */

    public function getEmail(mixed $entryId)
    {
        $entryId = (int) $entryId;
        $query = "SELECT * FROM newsletter WHERE id = $entryId";
        return $this->db->query($query)->find();
    }

    /**
     * Update an Email in the Newsletter Database Table based in the ID and the new Email entry in the edit form
     * @param array $formData - (email) from the POST form in the edit.php file
     * @param int $id - Route parameter
     */

    public function updateEmail(array $formData, int $id): Database
    {
        $query = "UPDATE newsletter SET 
          email = :email, updated_at =:now
          WHERE id = :id";

        $params =
            [
                'email' => $formData['email'],
                'now' => date('Y-m-d H:i:s'),
                'id' => $id
            ];

        return $this->db->query($query, $params);
    }

    /**
     *  Delete an entry in the newsletter Database Table given an ID     
     * @param int $id - Route parameter
     * @return mixed - number of rows deleted
     */

    public function deleteEmail(int $id)
    {
        $query = "DELETE FROM newsletter WHERE id = $id";
        return $this->db->query($query);
    }

    /**
     * Given an id obtains all the info from the DB Table newsletter
     * @param mixed $entryId
     * @return mixed
     */

    public function getAllEmails()
    {
        $query = "SELECT email FROM newsletter";
        return $this->db->query($query)->findAll();
    }

    public function sendNewsletter(mixed $newsletterList, array $formData)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug    = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                         //Send using SMTP
            $mail->Host         = $_ENV['MAIL_HOST'];                  //Set the SMTP server to send through
            $mail->SMTPAuth     = true;                                //Enable SMTP authentication
            $mail->Username     = $_ENV['MAIL_USERNAME'];              //SMTP username
            $mail->Password     = $_ENV['MAIL_PASS'];                  //SMTP password
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;         //Enable implicit TLS encryption
            $mail->Port         = $_ENV['MAIL_PORT'];                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet      = PHPMailer::CHARSET_UTF8;

            //Recipients
            $mail->setFrom($_ENV['MAIL_SENDER'], 'Durgga - Mamen Carrasco');

            foreach ($newsletterList as $newsletter) {
                $mail->addAddress($newsletter->email);
                // Image
                $mail->AddEmbeddedImage("images/web/footer-logo.png", "my-image", "durgga.png");
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $formData['subject'];
                $mail->Body    = $formData['answer'] . '<img alt="Durgga" src="cid:my-image">';
                $mail->AltBody = $formData['answer'];
                $mail->send();
                $mail->clearAllRecipients();
            }

            return 1;
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}
