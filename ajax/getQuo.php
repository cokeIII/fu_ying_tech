<?php
require_once "../connect.php";
$quo_no = $_POST["quo_no"];
$data = array();
$sql = "select * from quotation q, part p,customer c 
where q.part_no = p.part_no and c.company_code = q.quo_to
and q.quo_no = '$quo_no'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$data["quo_no"] = $row["quo_no"];
$data["quo_to"] = $row["quo_to"];
$data["company_name"] = $row["company_name"];
$data["quo_attn"] = $row["quo_attn"];
$data["quo_from"] = $row["quo_from"];
$data["quo_contact"] = $row["quo_contact"];
$data["quo_date"] = $row["quo_date"];
$data["delivery"] = $row["delivery"];
$data["term_of_payment"] = $row["term_of_payment"];
$data["shipment"] = $row["shipment"];
$data["time_stamp"] = $row["time_stamp"];
$resItem = mysqli_query($conn, $sql);
$i = 0;
while($rowItem = mysqli_fetch_array($resItem)){
    $data["part"][$i]["part_no"] = $rowItem["part_no"];
    $data["part"][$i]["part_name"] = $rowItem["part_name"];
    $data["part"][$i]["qty"] = $rowItem["qty"];
    $data["part"][$i]["discount"] = $rowItem["discount"];
    $i++;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
