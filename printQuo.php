<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once "connect.php";
$quo_no = $_REQUEST["quo_no"];
$sql = "select * from quotation q, part p,customer c 
where q.part_no = p.part_no and c.company_code = q.quo_to
and q.quo_no = '$quo_no'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$mpdf = new \Mpdf\Mpdf();
function changeDate($D){
    $Darr = explode("-",$D);
    return $Darr[2]."-".$Darr[1]."-".$Darr[0];
}
$strData = "";
$strData .= '
<style>
    .th-text{
        font-family: Garuda;
    }
    .blue-text{
        color: #0066CC;
    }
    .red-text{
        color:red;
    }
    .f-13{
        font-size:13px;
    }
    .f-11{
        font-size:10px;
    }
    .t-center{
        text-align: center;
    }
    .border-table{
        border: 1px solid black;
        border-collapse: collapse;
    }
    .m-5{
        margin:5px;
    }
    .tab{
        tab-size: 16;
    }
    .v-top{
        vertical-align: top;
    }
    .t-right{
        text-align: right;
    }
    .t-left{
        text-align: left;
    }
    .f-12{
        font-size:12;
    }
</style>
<table>
    <tr>
        <td><img src="img/logo.png" width="80" height="80"></td>
        <td>
            <h4 class="blue-text">FU YING TECH CO., LTD.</h4>
            <h4 class="th-text blue-text">บริษัท ฟู่ หยิง เทค จำกัด</h4>
            <div>511/67 Srinakarin Rd., Suanluang, Suanluang, Bangkok 10250 Thailand</div>
            <div class="th-text f-12">เลขที่ 511/67 ถนนศรีนครินทร์ แขวงสวนหลวง เขตสวนหลวง กรุงเทพมหานคร 10250 ประเทศไทย</div>
            <div class="f-12">Tel: (02)187-3751, (038)109-428, HP: 081-761-1858, Email: sywang@fytthailand.com</div>
        </td>
    </tr>
</table>
<h3 class="t-center blue-text">Quotation</h3>
<table class="border-table" width="100%">
    <tr>
        <td class="border-table f-13" width="50%" >
            <div >To: ' . $row["company_name"] . '</div>
            <div>Attn: ' . $row["quo_attn"] . '</div>
            <p>CC:</p>
            <div>From: ' . $row["quo_from"] . '</div>
            <div>Contact: ' . $row["quo_contact"] . '</div>
            <div>15721436793@139.com</div>
            <p>CC:</p>
        </td>
        <td  class="f-13" width="50%">
            <div>Quotation No.: ' . $row["quo_no"] . '</div>
            <div>Date: ' . changeDate($row["quo_date"]) . '</div>
            <div>Validity: ' . changeDate(date('Y-m-d', strtotime($row["quo_date"]. ' + '.$row["delivery"].' days'))) . '</div>
            <div>Delivery: ' . $row["delivery"] . ' Days</div>
            <div>Term of Payment: ' . $row["term_of_payment"] . ' Days</div>
            <div>Shipment: ' . $row["shipment"] . '</div>
        </td>
    </tr>
</table>
<div class="red-text f-11">Note: 1. Please keep FYT P/N in your system, easy re-order in future</div>
<div class="red-text f-11">&emsp;&emsp;&nbsp;&nbsp; 2. Issue PO. base on quotation quantity </div>
<table class="border-table" width="100%" >
    <tr>
        <td height="400" colspan="8" class="v-top">
            <table width="100%"  class="border-table">
                <tr>
                    <td class="border-table f-13 t-center" width="4%">No</td>
                    <td class="border-table f-13 t-center" width="30%">Specification</td>
                    <td class="border-table f-13 t-center" width="5%">Qty</td>
                    <td class="border-table f-13 t-center" width="6%">Unit</td>
                    <td class="border-table f-13 t-center" width="20%">Image</td>
                    <td class="border-table f-13 t-center" width="15%">Unit Price <div>(Bath)</div></td>
                    <td class="border-table f-13 t-center" width="5%">Dis. <div>%</div></td>
                    <td class="border-table f-13 t-center" width="15%">Price <div>(Bath)</div></td>
                </tr>
                ';
$resItem = mysqli_query($conn, $sql);
$no = 0;
$total = 0;
while ($rowItem = mysqli_fetch_array($resItem)) {
    $total += ($rowItem["discount"] != 0 ? $rowItem["qty"] * $rowItem["unit_price"] - (($rowItem["qty"] * $rowItem["unit_price"] * $rowItem["discount"]) / 100) : $rowItem["qty"] * $rowItem["unit_price"]);
    $strData .= '<tr>
                    <td class="border-table f-13 t-center" width="4%">' . ++$no . '</td>
                    <td class="border-table f-13 t-center" width="30%">' . $rowItem["part_name"] . '</td>
                    <td class="border-table f-13 t-center" width="5%">' . $rowItem["qty"] . '</td>
                    <td class="border-table f-13 t-center" width="6%">' . $rowItem["unit"] . '</td>
                    <td class="border-table f-13 t-center" width="15%"><img src="uploads/' . $rowItem["img"] . '" width="80" height="80"></td>
                    <td class="border-table f-13 t-center" width="15%">' . number_format($rowItem["unit_price"]) . '</td>
                    <td class="border-table f-13 t-center" width="5%">' . $rowItem["discount"] . '</div></td>
                    <td class="border-table f-13 t-center" width="15%">' . ($rowItem["discount"] != 0 ? number_format($rowItem["qty"] * $rowItem["unit_price"] - (($rowItem["qty"] * $rowItem["unit_price"] * $rowItem["discount"]) / 100)) : number_format($rowItem["qty"] * $rowItem["unit_price"])) . '</td>
                </tr>';
}

$strData .= '</table>
        </td>
    </tr>
</table>
<table class="border-table" width="100%">
    <tr>
        <td class="red-text f-11">
        <div>Major goods: 1. FYT brand: Air blower, Chemical pump, Pressure gauge, Suction guide/Cup</div>
        <div>&emsp;&emsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp; 2. Agent / Distribtor brand: Flow meter (King spray), UPVC/PP pipe and accessories (WF), Motion part (XHS), Rectifier (ZHS)</div>
        <div>&emsp;&emsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp; 3. Other competivite goods: Pressure switch, Pressure sensor, Floating switch, Photo switch, Hepa filter</div>
        </td>
    <tr>
</table>
<br>
<table class="border-table v-top" width="100%">
    <tr>
        <td class="border-table" width="70%">
            <div>Remark:</div>
        </td>
        <td class="" width="30%">
            <table width="100%">
                <tr>
                    <td class="border-table">Total Price</td>
                    <td class="border-table t-right">' . number_format($total) . '</td>
                </tr>
                <tr>
                    <td class="border-table">Vat 7%</td>
                    <td class="border-table t-right">' . number_format($total * 7 / 100) . '</td>
                </tr>
                <tr>
                    <td class="border-table">Grand Price</td>
                    <td class="border-table t-right">' . number_format($total + ($total * 7 / 100)) . '</td>
                </tr>

            </table>
        </td>
    <tr>
</table>
<br>
<table width="100%">
    <tr>    
        <td class="t-center" width="50%">
            <div>Accepted and confirmed by</div>
            <div>' . $row["company_name"] . '</div>
            <br>
            <br>

            <hr width="80%">
            <div>Company Chop and Authorized Signature</div>
        </td>
        <td class="t-center" width="50%">
            <div>For and on behalf of </div>
            <div>FU YING TECH CO., LTD.</div>
            <br>
            <br>

            <hr width="80%">
            <div>Name: K. Shenyi Wang</div>
        </td>
    </td>
    </tr>
    <tr class="t-left">
        <td>
            <div>Name:</div>
            <div>Date:</div>
        </td>
    </tr>
</table>
';
$mpdf->WriteHTML($strData);
$mpdf->Output();
