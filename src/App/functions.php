<?php

declare(strict_types=1);


/**
 * Sugar Function to escape characters to prevent Cross-site scripting (XSS) is an attack in which an attacker injects malicious executable scripts
 * into the code of a trusted application or website.
 * Escaping is the process of converting a character into a different character for security reasons.
 * @param mixed $value value to escape.
 * @return string escaped string
 */

function escapeChar(mixed $value): string
{
    // force to return a string using casting (string)
    // Sometimes you need to change a variable from one data type into another, 
    // and sometimes you want a variable to have a specific data type. This can be done with casting.
    return htmlspecialchars((string) $value);
}


/**
 * Redirect function using HTTP headers.  
 * HTTP headers let the client and the server pass information with a HTTP request and response
 */

function redirectTo(string $path)
{
    // the header need the Location path and the code
    header("Location: {$path}");

    // 302 represents temporary redirection code: the resource requested has been temporarily moved to the URL given by the Location header
    http_response_code(302);
    exit;
}


/********************************* FUNCTIONS FOR DEVELOPMENT ************************************************************************************ */


/**
 * Sugar Function to Debug values and the Stack (Stack traces contain information about all of the functions that are running at a given moment).
 * If there is no parameters just stops the application with die().
 * @param mixed $variable Check the value and the type 
 * @param bool $stack To activate (true) the Stack Trace 
 * @param int $depth Depth in the Stack Trace (0 to show ALL the Stack)
 */
// mixed -> accepts every value also NULL, so can NOT be typehint  with?
// to create optional parameters, typehint with ? (means that can be null) and give the parameters the null value by default
function debugator(mixed $variable = null, ?bool $stack = null, ?int $depth = 0)
{
    echo "<br />DEBUG INFORMATION<br />";
    if ($variable !== null) {
        echo "<br /><br />---------------------------------- Variable (type - " . gettype($variable) . ") ------------------------------<br />";
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        echo "------------------------------------------------------------------------------------------------<br />";
    }
    if ($stack) {
        $result = debug_backtrace(0, $depth);
        echo "<br /><br />---------------------------------- Backtrace - Depth ($depth) ---------------------------------<br />";
        foreach ($result as $x => $y) {
            echo "<br />Stack " . $x . "<br />";
            if (array_key_exists('file', $y)) {
                echo "File -------> " . $y['file'] . "<br />";
            }
            if (array_key_exists('class', $y)) {
                echo "Class -----> " . $y['class'] . "<br />";
            }
            if (array_key_exists('function', $y)) {
                echo "Function -> " . $y['function'] . "<br />";
            }
        }
        echo "<br />-----------------------------------------------------------------------------------------------<br />";
    }
    die('<br /><br />Function Debugator out<br />');
}

/**
 * Show a given value with a nice format, give info to debug better
 * @param mixed $value show the value and his type 
 * @param string $info (optional) add some information about the value to check
 */

function showNice(mixed $value, string $info = "")
{
    echo "<br /> $info <br />";
    echo "*******************************************************************<br />";
    echo "<br />VALUE TYPE - " . gettype($value) . "<br />";
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    echo "*******************************************************************<br />";
}

/************************************************************************************************************************************************ */
