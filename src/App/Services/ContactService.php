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
class ContactService
{
    public function __construct(private Database $db) {}


    /* ********************************************** PUBLIC *************************************************** */

    /**
     * Insert a new entry in the DB contact Table 
     * @param array $formData variables send in the contact form
     */

    public function newContact(array $formData)
    {

        $query = "INSERT INTO contact(name, email, phone, subject, message) VALUES(:name, :email, :phone, :subject, :message)";
        $params =
            [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'subject' => $formData['subject'],
                'message' => $formData['message']
            ];

        $this->db->query($query, $params);
    }


    /* ********************************************** ADMIN *************************************************** */


    public function getContacts(array $pagination)
    {
        $query = "SELECT * FROM contact 
         WHERE {$pagination['searchCol']} LIKE :searchTerm
         ORDER BY {$pagination['sort']} {$pagination['direction']}  
         LIMIT {$pagination['perPage']} OFFSET {$pagination['offset']}";

        $params = ['searchTerm' => "%{$pagination['searchTerm']}%"];

        $list = $this->db->query($query, $params)->findAll();

        // Another query to know the total number of results without the limit ans offset, we need this to calculate the next page link
        $queryTotalResults = "SELECT COUNT(*) FROM contact 
         WHERE {$pagination['searchCol']} LIKE :searchTerm";

        $totalResults = $this->db->query($queryTotalResults, $params)->count();

        return [$list, $totalResults];
    }

    /**
     * Given an id get all the information
     * @param mixed $id mixed in case the parameter is a string, No need to cast in a query string
     * @return mixed info found in the DB
     */

    public function getContactInfo(mixed $id)
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date
         FROM contact where id = $id";
        return $this->db->query($query)->find();
    }


    /**
     * Insert a new entry in the DB contact Table 
     * @param array $formData variables send in the Admin Contact form
     */

    public function newContactAdmin(array $formData)
    {

        $query = "INSERT INTO contact(status, name, email, phone, subject, message, comments) VALUES(:status, :name, :email, :phone, :subject, :message, :comments)";
        $params =
            [
                'status' => $formData['status'],
                'name' => $formData['name'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'subject' => $formData['subject'],
                'message' => $formData['message'],
                'comments' => $formData['comments']
            ];

        return $this->db->query($query, $params);
    }

    /**
     * Update an Email in the Newsletter Database Table based in the ID and the new Email entry in the edit form
     * @param array $formData - form in the contact Admin edit menu
     * @param int $id - Route parameter
     */

    public function updateContact(array $formData, int $id): Database
    {
        // to avoid the time(HH:MM:SS) DATETIME type to be created by the DB, we stablish it to the midnight because in this case only care for the date(YYY-MM-DD)
        $formattedDate = "{$formData['date']} 00:00:00";

        $query = "UPDATE contact SET 
           name = :name, email = :email, phone = :phone, subject = :subject, message = :message, status = :status, comments = :comments, created_at = :date, updated_at =:now
           WHERE id = :id";

        $params =
            [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'subject' => $formData['subject'],
                'message' => $formData['message'],
                'status' => $formData['status'],
                'comments' => $formData['comments'],
                'date' => $formattedDate,
                'now' => date('Y-m-d H:i:s'),
                'id' => $id
            ];

        return $this->db->query($query, $params);
    }

    /**
     *  Delete an entry in the contact Database Table given an ID     
     * @param int $id - Route parameter
     * @return mixed - number of rows deleted
     */

    public function deleteContact(int $id)
    {
        $query = "DELETE FROM contact WHERE id = $id";
        return $this->db->query($query);
    }


    /** TEST PHPMAILER */

    public function sendEmailContact(mixed $contact)
    {
        //debugator($contact);
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $_ENV['MAIL_HOST'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $_ENV['MAIL_USERNAME'];                     //SMTP username
            $mail->Password   = $_ENV['MAIL_PASS'];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $_ENV['MAIL_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($_ENV['MAIL_SENDER'], $_ENV['MAIL_COMPANY']);
            $mail->addAddress($contact->email, 'Xavulinki');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $contact->subject;
            $mail->Body    = $contact->message;
            $mail->AltBody = 'Test Durgini Contact Reply';

            $mail->send();

            return 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
