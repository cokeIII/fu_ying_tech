<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fu_ying_tech</title>
    <!-- Our project just needs Font Awesome solid + brand -->
    <script defer src="node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
    <script defer src="node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
    <script defer src="node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="dist/select2/select2.min.css">
</head>
<?php
require_once "connect.php";
date_default_timezone_set('Asia/Bangkok');
$date = date("Y-m-d");
$sql = "select * from customer";
$res = mysqli_query($conn, $sql);
$sqlFYT = "select * from fu_ying_tech";
$resFTY = mysqli_query($conn, $sqlFYT);
$rowFTY = mysqli_fetch_array($resFTY);
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3">
            <div class="card-body">
                <form action="insertCustomer.php" method="post">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="companyName">To:</label>
                                        <select name="companyName" id="companyName">
                                            <option value="">--- select customer ---</option>
                                            <?php while ($row = mysqli_fetch_array($res)) { ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row["company_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="attn">Attn:</label>
                                        <select name="attn" id="attn" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="from">From:</label>
                                        <?php
                                        $arrFYT = json_decode($rowFTY["contact_person"]); ?>
                                        <input type="hidden" id="arrFYT" value="<?php echo $arrFYT; ?>">
                                        <select name="froms" id="froms" class="form-control">
                                            <?php
                                            foreach ($arrFYT as $x => $value) {
                                            ?>
                                                <option index="<?php echo $x; ?>" value="<?php echo $value->PersonName; ?>"><?php echo $value->PersonName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="contact">Contact:</label>
                                        <textarea name="contact" id="contact" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border-left">
                            <div class="form-group">
                                <label for="quoNo">Quotation No.:</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="quoNoDate" id="quoNoDate" class="form-control" value="<?php echo substr(date("Y")+543,2).date("m");?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="proNO" id="proNO" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="empNO" id="empNO" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="rNO" id="rNO" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quoDate">Date:</label>
                                <input type="date" name="quoDate" id="quoDate" class="form-control" value="<?php echo $date;?>">
                            </div>
                            <div class="form-group">
                                <label for="deliveryDate">Delivery:</label>
                                <input type="text" name="deliveryDate" id="deliveryDate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="payment">Term of Payment:</label>
                                <input type="text" name="payment" id="payment" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="shipment">Shipment:</label>
                                <select name="shipment" id="shipment" class="form-control">
                                    <option value="DDP">DDP</option>
                                    <option value="DDU">DDU</option>
                                    <option value="C&F">C&F</option>
                                    <option value="CIF">CIF</option>
                                    <option value="FOB">FOB</option>
                                    <option value="EXW">EXW</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="jquery/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="jquery/jquery.dataTables.min.js"></script>
<script src="dist/select2/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#companyName").select2({
            width: '100%' // need to override the changed default
        })
        $("#attn").select2({
            width: '100%' // need to override the changed default
        })
        $("#companyName").change(function() {
            $.ajax({
                url: 'ajax/getPerson.php',
                type: 'POST',
                data: {
                    id: $("#companyName").val()
                },
                success: function(data) {
                    let obj = JSON.parse(data)
                    $("#attn").html();
                    $("#attn").append("<option value='' >--- select Attn ---</option>")
                    $.each(obj, function(index, value) {
                        console.log(value.PersonName)
                        $("#attn").append("<option value='" + value.PersonName + "' > " +
                            value.PersonName + "</option>")
                    })
                    $("#attn").select2({
                        width: '100%' // need to override the changed default
                    })
                }
            });
        })
        var arrFYT = <?php echo json_encode($arrFYT); ?>;
        $("#contact").val(arrFYT[0].personEmail + ', ' + arrFYT[0].personTel)
        $("#froms").change(function() {
            let index = $('option:selected', this).attr('index');
            $("#contact").val(arrFYT[index].personEmail + ', ' + arrFYT[index].personTel)
        })
    })
</script>