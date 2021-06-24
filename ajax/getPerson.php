<?php
require_once "../connect.php";
$id = $_POST["id"];
$sql = "select contact_person from customer where id= '$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$listPerson = json_decode($row["contact_person"]);
echo json_encode($listPerson);
