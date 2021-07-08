<?php
require_once "../connect.php";
if (!empty($_REQUEST["partName"])) {
    $id = $_POST["id"];
    $sql = "select * from part where part_no = '$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    echo $row["part_name"];
} else if (!empty($_REQUEST["partAll"])) {
    $data = array();
    $sql = "select * from part";
    $res = mysqli_query($conn, $sql);
    $i =0;
    while ($row = mysqli_fetch_array($res)) {
        $data[$i]["part_no"] = $row["part_no"];
        $data[$i]["part_name"] = $row["part_name"];
        $i++;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
