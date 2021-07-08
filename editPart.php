<?php
require_once "connect.php";
$part_no = $_REQUEST["part_no"];
$part_name = $_REQUEST["part_name"];
$unit = $_REQUEST["unit"];
$part_description = $_REQUEST["part_description"];
$unit_price = $_REQUEST["unit_price"];
$target_dir = "uploads/";
$target_file = $target_dir . $part_no . ".jpg";
$file_name = $part_no . ".jpg";

if (!empty($_FILES["img"]["tmp_name"])) {
    if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
    }
    $sql = '
    update part set 
    part_name = "' . $part_name . '",
    unit = "' . $unit . '",
    part_description = "' . $part_description . '",
    unit_price = "' . $unit_price . '",
    img = "' . $file_name . '"
    where part_no = "'.$part_no.'"
    ';
} else {
    $sql = '
    update part set 
    part_name = "' . $part_name . '",
    unit = "' . $unit . '",
    part_description = "' . $part_description . '",
    unit_price = "' . $unit_price . '"
    where part_no = "'.$part_no.'"
    ';
}

$res = mysqli_query($conn, $sql);
if ($res) {
    header("location: addPart.php");
} else {
    echo $sql;
}
