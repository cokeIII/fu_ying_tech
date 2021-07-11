<?php
require_once "connect.php";
$quo_no = $_REQUEST["quoNoDate"] . "-" .
    $_REQUEST["quoNO"] . "-" .
    $_REQUEST["cusNO"] . "-" .
    $_REQUEST["verNO"];

$quo_to = $_REQUEST["companyName"];
$quo_attn = $_REQUEST["attn"];
$quo_from = $_REQUEST["froms"];
$quo_contact = $_REQUEST["contact"];
$quo_date = $_REQUEST["quoDate"];
$delivery = $_REQUEST["deliveryDate"];
$term_of_payment = $_REQUEST["payment"];
$shipment = $_REQUEST["shipment"];

$part_numberArr = $_REQUEST["part_number"];
$part_nameArr = $_REQUEST["part_name"];
$QTYArr = $_REQUEST["QTY"];
$unitArr = $_REQUEST["unit"];
$unit_priceArr = $_REQUEST["unit_price"];
$disArr = $_REQUEST["dis"];

$i = 0;
foreach ($part_numberArr as $value) {
    // $part_name = $part_nameArr[$i];
    $QTY = $QTYArr[$i];
    // $unit = $unitArr[$i];
    // $unit_price = $unit_priceArr[$i];
    $dis = $disArr[$i];
    
    $sql = "insert into quotation
    (
       quo_no,
       part_no,
       quo_to,
       quo_attn,
       quo_from,
       quo_contact,
       quo_date,
       delivery,
       term_of_payment,
       shipment,
       qty,
       discount
    ) values (
       '$quo_no',
       '$value',
       '$quo_to',
       '$quo_attn',
       '$quo_from',
       '$quo_contact',
       '$quo_date',
       '$delivery',
       '$term_of_payment',
       '$shipment',
       '$QTY',
       '$dis'
    )
   ";
    echo $sql;
    $res = mysqli_query($conn, $sql);
    if(count($part_numberArr)-1 == $i){
        header("location: listQuo.php");
    }
    $i++;

}
