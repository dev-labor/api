<?php
include('../config/db.php');

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            findOne($_GET['id']);
        } else {
            findAll();
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        create($data);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        update($data);
        break;
    case 'DELETE':
        destroy($_GET["id"]);
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("message" => "Method not allowed."));
        break;
}

function create($data)
{
    $employee_id = $data["employee_id"];
    $employee_name = $data["employee_name"];
    $employee_salary = $data["employee_salary"];
    $employee_start_date = $data["employee_start_date"];
    $employee_position = $data["employee_position"];
    $employee_work_status = $data["employee_work_status"];

    global $db;
    $sql = "INSERT INTO `employees`(`employee_id`, `employee_name`, `employee_salary`, `employee_start_date`, `employee_position`, `employee_work_status`) VALUES ('$employee_id','$employee_name','$employee_salary','$employee_start_date','$employee_position','$employee_work_status')";
    $result = $db->query($sql);

    if ($result) {
        http_response_code(200); // Method Not Allowed
        echo json_encode(array("message" => "Created Success"));
    } else {
        $item = [];
        echo json_encode(array("message" => "Error"));
    }
}
function update($data)
{
    $id = $data["id"];
    $employee_id = $data["employee_id"];
    $employee_name = $data["employee_name"];
    $employee_salary = $data["employee_salary"];
    $employee_start_date = $data["employee_start_date"];
    $employee_position = $data["employee_position"];
    $employee_work_status = $data["employee_work_status"];

    global $db;
    $sql = "UPDATE `employees` SET `employee_id`='$employee_id',`employee_name`='$employee_name',`employee_salary`='$employee_salary',`employee_start_date`='$employee_start_date',`employee_position`='$employee_position',`employee_work_status`='$employee_work_status' WHERE `id`='$id'";
    $result = $db->query($sql);

    if ($result) {
        http_response_code(200); // Method Not Allowed
        echo json_encode(array("message" => "Updated Success"));
    } else {
        $item = [];
        echo json_encode(array("message" => "Error"));
    }
}
function destroy($id)
{
    global $db;
    $sql = "DELETE FROM `employees` WHERE `id` = '$id'";
    $result = $db->query($sql);

    if ($result) {
        http_response_code(200); // Method Not Allowed
        echo json_encode(array("message" => "Delete Success"));
    } else {
        $item = [];
        echo json_encode(array("message" => "Error"));
    }
}
function findOne($id)
{
}

function findAll()
{
    global $db;
    $sql = "SELECT * FROM `employees`";
    $result = $db->query($sql);

    if ($result->rowCount() > 0) {
        $item = $result->fetchAll(PDO::FETCH_OBJ);
        http_response_code(200); // Method Not Allowed
        echo json_encode($item);
    } else {
        $item = [];
        echo json_encode($item);
    }
}



// function genCode(){
//     $value = $oldid; //ค่าเดิมที่อ่านมา
//     $old = str_split($value, 4);
//     $date = $old[0];
//     $number = $old[1];
//     $newdate = date("ym");
//     if ($date != $newdate) {
//         $number = 1;
//         $number = sprintf("%04d", $number);
//     } else {
//         $number = sprintf("%04d", ++$number);
//     }

//     $job_id = $newdate . $number;
//     $job_category = 'EM';
//     //gen job_id
// }
