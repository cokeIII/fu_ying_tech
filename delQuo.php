<?php
require_once "connect.php";
$quo_no = $_GET["quo_no"];
$sql = "delete from quotation where quo_no = '$quo_no'";
$res = mysqli_query($conn,$sql);
if($res){
    header("location: listQuo.php");
} else {
    echo $sql;
}
