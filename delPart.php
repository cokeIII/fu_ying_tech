<?php
require_once "connect.php";
$id = $_GET["id"];
$sql = "delete from part where part_no = '$id'";
$res = mysqli_query($conn,$sql);
if($res){
    header("location: addPart.php");
} else {
    echo $sql;
}
