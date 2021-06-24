<?php
require_once "connect.php";
$id = $_POST["id"];
$tax_id = $_POST["taxID"];
$company_name = $_POST["companyName"];
$website = $_POST["website"];
$payment = $_POST["payment"];
$company_code = $_POST["companyCode"];
//array
$companyAddress = $_POST["companyAddress"];
$tel = $_POST["tel"];
$company_address = array();
for($i = 0;$i < count($companyAddress);$i++){
    $company_address[$i]["companyAddress"] = $companyAddress[$i];
    $company_address[$i]["tel"] = $tel[$i];
}

$dept = $_POST["dept"];
$PersonName = $_POST["PersonName"];
$nickName = $_POST["nickName"];
$personTel = $_POST["personTel"];
$personEmail = $_POST["personEmail"];
$personLine = $_POST["personLine"];
$personWechat = $_POST["personWechat"];
$contact_person = array();
for($j = 0;$j < count($dept);$j++){
    $contact_person[$j]["dept"] = $dept[$j];
    $contact_person[$j]["PersonName"] = $PersonName[$j];
    $contact_person[$j]["nickName"] = $nickName[$j];
    $contact_person[$j]["personTel"] = $personTel[$j];
    $contact_person[$j]["personEmail"] = $personEmail[$j];
    $contact_person[$j]["personLine"] = $personLine[$j];
    $contact_person[$j]["personWechat"] = $personWechat[$j];
}
$sql = "update customer set 
company_code = '$company_code',
tax_id = '$tax_id',
company_name='$company_name', 
website = '$website',
payment = '$payment',
company_address = '".json_encode($company_address, JSON_UNESCAPED_UNICODE)."',
contact_person = '".json_encode($contact_person, JSON_UNESCAPED_UNICODE)."'
where
id = '$id'
 ";
$res = mysqli_query($conn,$sql);
if($res){
    header("location: customer.php");
} else {
    echo $sql;
}
