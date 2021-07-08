<?php
require_once "connect.php";
$part_no = $_REQUEST["part_no"];
$part_name = $_REQUEST["part_name"];
$unit = $_REQUEST["unit"];
$part_description = $_REQUEST["part_description"];
$unit_price = $_REQUEST["unit_price"];
$target_dir = "uploads/";
$target_file = $target_dir . $part_no.".jpg";
$file_name = $part_no.".jpg";

if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
  echo "Sorry, there was an error uploading your file.";
}

$sql = 'insert into part
    (
        part_no,
        part_name,
        unit,
        part_description,
        unit_price,
        img
    ) values (
        "'.$part_no.'",
        "'.$part_name.'",
        "'.$unit.'",
        "'.$part_description.'",
        "'.$unit_price.'",        
        "'.$file_name.'"
    )
    ';
$res = mysqli_query($conn,$sql);
if($res){
    header("location: addPart.php");
} else {
    echo $sql;
}
