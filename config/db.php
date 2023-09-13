<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json, text/html; charset=utf-8');

$host = "localhost";
$db = "test";
$user = "root";
$password = "";

try {
  $db = new PDO("mysql:host=$host;dbname=$db", $user, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
