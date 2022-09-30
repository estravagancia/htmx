<?php 
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
        echo "Método GET\n";
        echo print_r($_GET, true);
        break;
    case 'POST':
        echo "Método POST\n";
        echo print_r($_POST, true);
        break;
    case 'PUT':
        $_PUT = parseInput();
        echo "Método PUT\n";
        echo print_r($_PUT, true);
        break;
    case 'PUSH':
        $_PUSH = parseInput();
        echo "Método PUSH\n";
        echo print_r($_PUSH, true);
        break;
    case 'DELETE':
        $_DELETE = parseInput();
        echo "Método DELETE\n";
        echo print_r($_DELETE, true);
        break;
    default:
        echo "Método DESCONOCIDO.";
        break;
}
?>