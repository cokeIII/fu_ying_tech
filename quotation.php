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
$sqlPart = "select * from part";
$resPart = mysqli_query($conn, $sqlPart);
$sqlGetQuo = "select * from quotation group by quo_no";
$resGetQuo = mysqli_query($conn, $sqlGetQuo);
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h3>Create Quotation</h3>
                <div class="row mt-3 mb-3">
                    <div class="col-md-4">
                        <select name="getQuo" id="getQuo">
                            <option value="">--- Select Quotation ---</option>
                            <?php while ($rowGetQuo = mysqli_fetch_array($resGetQuo)) { ?>
                                <option value="<?php echo $rowGetQuo["quo_no"]; ?>"><?php echo $rowGetQuo["quo_no"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <form action="insertQuo.php" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="companyName">To:</label>
                                        <select name="companyName" id="companyName" required>
                                            <option value="">--- select customer ---</option>
                                            <?php while ($row = mysqli_fetch_array($res)) { ?>
                                                <option value="<?php echo $row['company_code']; ?>"><?php echo $row["company_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="attn">Attn:</label>
                                        <select name="attn" id="attn" class="form-control" required>
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
                                        <select name="froms" id="froms" class="form-control" required>
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
                                        <textarea name="contact" id="contact" cols="30" rows="5" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border-left">
                            <div class="form-group">
                                <label for="quoNo">Quotation No.:</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="quoNoDate" id="quoNoDate" class="form-control" value="<?php echo substr(date("Y") + 543, 2) . date("m"); ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="quoNO" id="quoNO" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="cusNO" id="cusNO" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="verNO" id="verNO" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quoDate">Date:</label>
                                <input type="date" name="quoDate" id="quoDate" class="form-control" value="<?php echo $date; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="deliveryDate">Delivery:</label>
                                <input type="number" name="deliveryDate" id="deliveryDate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="payment">Term of Payment:</label>
                                <input type="number" name="payment" id="payment" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="shipment">Shipment:</label>
                                <select name="shipment" id="shipment" class="form-control" required>
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
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" id="addPart"><i class="fas fa-plus"></i> Add part</button>
                            <button type="button" class="btn btn-danger" id="delPart"><i class="fas fa-minus"></i> Delete part</button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12" id="disPalyPart">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="part_number">Part Number</label>
                                    <select name="part_number[]" id="part_number-0" class="form-control part_number">
                                        <option value="">--- select part ---</option>
                                        <?php while ($rowPast = mysqli_fetch_array($resPart)) { ?>
                                            <option value="<?php echo $rowPast["part_no"]; ?>"><?php echo $rowPast["part_no"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="part_name">Part Name</label>
                                    <input type="text" class="form-control part_name" name="part_name[]" id="part_name0" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="QTY">QTY</label>
                                    <input type="text" class="form-control" name="QTY[]" id="QTY0" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="dis">Dis %</label>
                                    <input type="text" class="form-control" name="dis[]" id="dis0">
                                </div>
                                <!-- <div class="col-md-3">
                                    <label for="img">Parts Image</label>
                                    <input type="file" class="form-control" name="img[]" id="img" accept="image/png, image/jpeg" required>
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <!-- <div class="col-md-3">
                                    <label for="unit">Unit</label>
                                    <input type="text" class="form-control" name="unit[]" id="unit" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="unit_price">Unit Price</label>
                                    <input type="text" class="form-control" name="unit_price[]" id="Unit" required>
                                </div> -->

                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block"> <i class="fas fa-file-alt"></i> Create Quotation </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
$resPart2 = mysqli_query($conn, $sqlPart);
$rowPast2 = mysqli_fetch_array($resPart2);
// print_r($rowPast2);
?>

</html>
<script src="jquery/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="jquery/jquery.dataTables.min.js"></script>
<script src="dist/select2/select2.min.js"></script>
<script>
    $(document).ready(function() {
        let getQuo_attn = null;
        let idAddPart = 1;
        $("#getQuo").select2({
            width: '100%'
        })
        $("#froms").select2({
            width: '100%'
        })
        let strOpt = "";

        $.ajax({
            url: 'ajax/getPart.php',
            type: 'POST',
            data: {
                partAll: true,
            },
            success: function(data) {
                let obj = JSON.parse(data)
                obj.forEach(element => {
                    strOpt += '<option value="' + element.part_no + '">' + element.part_no + '</option>'
                })
            }
        });
        $("#getQuo").change(function() {
            $.ajax({
                url: 'ajax/getQuo.php',
                type: 'POST',
                data: {
                    quo_no: $("#getQuo").val(),
                },
                success: function(data) {
                    let obj = JSON.parse(data)
                    console.log(obj)
                    $("#companyName").val(obj.quo_to).trigger("change")
                    getQuo_attn = obj.quo_attn
                    $("#froms").val(obj.quo_from).trigger("change")
                    let quo_no_arr = obj.quo_no.split("-")
                    $("#quoNoDate").val(quo_no_arr[0])
                    $("#quoNO").val(quo_no_arr[1])
                    $("#cusNO").val(quo_no_arr[2])
                    $("#verNO").val(quo_no_arr[3])
                    $("#quoDate").val(obj.quo_date)
                    $("#deliveryDate").val(obj.delivery)
                    $("#payment").val(obj.term_of_payment)
                    $("#shipment").val(obj.shipment)
                    $("#disPalyPart").html("")
                    obj.part.forEach(element => {

                        $("#disPalyPart").append(
                            '<div class="form-group row">' +
                            '<div class="col-md-4">' +
                            '<label for="part_number">Part Number</label>' +
                            '<select name="part_number[]" id="part_number-' + idAddPart + '" class="form-control part_number">' +
                            '<option value="">--- select part ---</option>' +
                            strOpt +
                            '</select> ' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<label for="part_name">Part Name</label>' +
                            '<input type="text" class="form-control part_name" name="part_name[]" id="part_name' + idAddPart + '" required>' +
                            '</div>' +
                            '<div class="col-md-2">' +
                            '<label for="QTY">QTY</label>' +
                            '<input type="text" class="form-control" name="QTY[]" id="QTY' + idAddPart + '" required>' +
                            '</div>' +
                            '<div class="col-md-2">' +
                            '<label for="dis">Dis %</label>' +
                            '<input type="text" class="form-control" name="dis[]" id="dis' + idAddPart + '" >' +
                            '</div>' +
                            '</div>'
                        )
                        $(".part_number").select2({
                            width: '100%' // need to override the changed default
                        })
                        $("#part_number-"+idAddPart).val(element.part_no).trigger("change")
                        $("#QTY"+idAddPart).val(element.qty)
                        $("#dis"+idAddPart).val(element.discount)
                        idAddPart++
                    });
                }
            });
        })
        $("#delPart").click(function() {
            $("#disPalyPart").find(".row:last").remove();
        })



        $("#addPart").click(function() {
            $("#disPalyPart").append(
                '<div class="form-group row">' +
                '<div class="col-md-4">' +
                '<label for="part_number">Part Number</label>' +
                '<select name="part_number[]" id="part_number-' + idAddPart + '" class="form-control part_number">' +
                '<option value="">--- select part ---</option>' +
                strOpt +
                '</select> ' +
                '</div>' +
                '<div class="col-md-4">' +
                '<label for="part_name">Part Name</label>' +
                '<input type="text" class="form-control part_name" name="part_name[]" id="part_name' + idAddPart + '" required>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<label for="QTY">QTY</label>' +
                '<input type="text" class="form-control" name="QTY[]" id="QTY' + idAddPart + '" required>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<label for="dis">Dis %</label>' +
                '<input type="text" class="form-control" name="dis[]" id="dis' + idAddPart + '" >' +
                '</div>' +
                '</div>'
            )
            idAddPart++
            $(".part_number").select2({
                width: '100%' // need to override the changed default
            })
        })
        $(document).on('change', '.part_number', function() {
            let thisItem = $(this)
            $.ajax({
                url: 'ajax/getPart.php',
                type: 'POST',
                data: {
                    partName: true,
                    id: $(this).val()
                },
                success: function(data) {
                    console.log(data);
                    let idFind = thisItem.attr("id").split("-")
                    console.log(idFind[1])
                    thisItem.parents(".row").find("#part_name" + idFind[1]).val(data)
                }
            });
        })
        $(".part_number").select2({
            width: '100%' // need to override the changed default
        })
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
                    $("#payment").val(obj[0])
                    $("#cusNO").val(obj[2].substr(1, obj[2].length) + "A")
                    $("#attn").html();
                    $("#attn").append("<option value='' >--- select Attn ---</option>")
                    $.each(obj[1], function(index, value) {
                        console.log(value.PersonName)
                        $("#attn").append("<option value='" + value.PersonName + "' > " +
                            value.PersonName + "</option>")
                    })
                    $("#attn").select2({
                        width: '100%' // need to override the changed default
                    })
                    if (getQuo_attn) {
                        $("#attn").val(getQuo_attn).trigger("change")
                    }
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