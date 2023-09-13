<?php

if ($_SERVER['REQUEST_URI'] === '/api/employee' || isset($_SERVER['QUERY_STRING'])) {
    include('./employee.php');
} else {
    http_response_code(404); // Not Found
    echo json_encode(array("message" => "Endpoint not found."));
}
