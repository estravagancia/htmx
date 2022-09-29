<?php 
// $data = file_get_contents("php://input");

// foreach (explode('&', $data) as $chunk) {
//     $param = explode("=", $chunk);
//     if ($param) {
//         printf("Value for parameter \"%s\" is \"%s\"<br/>\n", urldecode($param[0]), urldecode($param[1]));
//     }
// }


$method = $_SERVER['REQUEST_METHOD'];

function parseInput()
{
    $data = file_get_contents("php://input");
    if($data == false)
        return array();
    parse_str($data, $result);
    return $result;
}

switch ($method)
{
    case 'GET':
        echo "GET request method\n";
        echo print_r($_GET, true);
        break;
    case 'POST':
        echo "POST request method\n";
        echo print_r($_POST, true);
        break;
    case 'PUT':
        $_PUT = parseInput();

        echo "PUT request method\n";
        echo print_r($_PUT, true);
        break;
    case 'DELETE':
        $_DELETE = parseInput();
        echo "DELETE request method\n";
        echo print_r($_DELETE, true);
        break;
    default:
        echo "Unknown request method.";
        break;
}
?>