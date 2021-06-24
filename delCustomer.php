<?php
require_once "connect.php";
$id = $_GET["id"];
$sql = "delete from customer where id = '$id'";
$res = mysqli_query($conn,$sql);
if($res){
    header("location: index.php");
} else {
    echo $sql;
}
