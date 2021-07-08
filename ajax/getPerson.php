<?php
require_once "../connect.php";
$id = $_POST["id"];
$data = array();
$sql = "select * from customer where id= '$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$data[] = $row["payment"];
$listPerson = json_decode($row["contact_person"]);
$data[] = $listPerson;
$data[] = $row["company_code"];
echo json_encode($data);
