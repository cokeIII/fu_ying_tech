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
</head>
<?php
require_once "connect.php";
$sql = "select * from fu_ying_tech";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3">
            <div class="card-body">

                <form action="editFuYingTech.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Fu Ying Tech Information</h3>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                    <div class="row">
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="companyName">Company Name:</label>
                                <input type="text" class="form-control" name="companyName" id="companyName" value="" required>
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="taxID">Tax ID:</label>
                                <input type="text" class="form-control" name="taxID" id="taxID" value="<?php echo $row["tax_id"] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="website">website:</label>
                                <input type="text" class="form-control" name="website" id="website" value="<?php echo $row["website"] ?>" required>
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="payment">Payment:</label>
                                <select class="form-control" name="payment" id="payment">
                                </select>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" id="addBranch"><i class="fas fa-plus"></i> Branch</button>
                            </div>
                        </div>
                    </div>

                    <?php
                    $company_address = json_decode($row["company_address"]);
                    for ($i = 0; $i < count($company_address); $i++) {
                    ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="companyAddress">Company Address: <?php echo ($i != 0 ? "(Branch)" : "(Head Office)") ?></label>
                                    <textarea name="companyAddress[]" class="form-control" id="" cols="30" rows="3" required><?php echo $company_address[$i]->companyAddress; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tel">tel</label>
                                    <input type="text" class="form-control" name="tel[]" id="tel" value="<?php echo $company_address[$i]->tel; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <?php if ($i != 0) { ?>
                                    <label for="addBranch">Branch</label>
                                    <button type="button" class="btn btn-danger del-address"><i class="fas fa-minus"></i></button>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div id="disPalyCustomerAddress">

                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Contact Person Information</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" id="addPerson"><i class="fas fa-plus"></i> Person</button>
                            </div>
                        </div>
                    </div>
                    <?php $contact_person = json_decode($row["contact_person"]);
                    for ($j = 0; $j < count($contact_person); $j++) {
                    ?>
                        <hr>
                        <div class="display-person">
                            <?php if ($j != 0) { ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-danger del-person"><i class="fas fa-minus"></i> Person</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dept"> <?php echo ($j + 1) . "."; ?> Dept</label>
                                        <select name="dept[]" class="form-control">
                                            <option value="General Manager" <?php echo ($contact_person[$j]->dept == "General Manager" ? "selected" : ""); ?>>General Manager</optoin>
                                            <option value="Purchasing" <?php echo ($contact_person[$j]->dept == "Purchasing" ? "selected" : ""); ?>>Purchasing</optoin>
                                            <option value="Maintenance" <?php echo ($contact_person[$j]->dept == "Maintenance" ? "selected" : ""); ?>>Maintenance</optoin>
                                            <option value="Production" <?php echo ($contact_person[$j]->dept == "Production" ? "selected" : ""); ?>>Production</optoin>
                                            <option value="Finance" <?php echo ($contact_person[$j]->dept == "Finance" ? "selected" : ""); ?>>Finance</optoin>
                                            <option value="HR" <?php echo ($contact_person[$j]->dept == "HR" ? "selected" : ""); ?>>HR</optoin>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="personName">Person Name</label>
                                        <input type="text" class="form-control" name="PersonName[]" value="<?php echo $contact_person[$j]->PersonName; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nickName:">Nick Name</label>
                                        <input type="text" class="form-control" name="nickName[]" value="<?php echo $contact_person[$j]->nickName; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="personTel">Mobile</label>
                                        <input type="text" class="form-control" name="personTel[]" value="<?php echo $contact_person[$j]->personTel; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="personEmail">Email</label>
                                        <input type="text" class="form-control" name="personEmail[]" value="<?php echo $contact_person[$j]->personEmail; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="personLine">Line</label>
                                        <input type="text" class="form-control" name="personLine[]" value="<?php echo $contact_person[$j]->personLine; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="personWechat">Wechat</label>
                                        <input type="text" class="form-control" name="personWechat[]" value="<?php echo $contact_person[$j]->personWechat; ?>">
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    <?php } ?>
                    <div id="disPerson">

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary m-2" type="submit">Save</button>
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
<script>
    $(document).ready(function() {
        let branchNumber = 0
        let personNumber = 1
        $("#addBranch").click(function() {
            $("#disPalyCustomerAddress").append(
                '<div class="row">' +
                '<div class="col-md-8">' +
                '<div class="form-group">' +
                '<label for="companyAddress">Company Address: (Branch)</label>' +
                '<textarea name="companyAddress[]" class="form-control" id="" cols="30" rows="3" required></textarea>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<div class="form-group">' +
                '<label for="tel">tel</label>' +
                '<input type="text" class="form-control" name="tel[]" required>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-1">' +
                '<label for="addBranch">Branch</label>' +
                '<button type="button" class="btn btn-danger del-address"><i class="fas fa-minus"></i></button>' +
                '</div>' +
                '</div>'
            )
        })

        $(document).on("click", ".del-address", function() {
            $(this).closest(".row").remove()
            branchNumber--
        })

        $("#addPerson").click(function() {
            console.log("addPerson")
            $("#disPerson").append(
                '<div class="display-person">' +
                '<div class="row">' +
                '<div class="col-md-6">' +
                '</div>' +
                '<div class="col-md-6">' +
                '<div class="d-flex justify-content-end">' +
                '<button type="button" class="btn btn-danger del-person"><i class="fas fa-minus"></i> Person</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label for="dept"> ' + (++personNumber) + '. Dept</label>' +
                '<select name="dept[]" class="form-control">' +
                '<option value="General Manager">General Manager</optoin>' +
                '<option value="Purchasing">Purchasing</optoin>' +
                '<option value="Maintenance">Maintenance</optoin>' +
                '<option value="Production">Production</optoin>' +
                '<option value="Finance">Finance</optoin>' +
                '<option value="HR">HR</optoin>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label for="personName">Person Name</label>' +
                '<input type="text" class="form-control" name="PersonName[]" required>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label for="nickName:">Nick Name</label>' +
                '<input type="text" class="form-control" name="nickName[]" required>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-md-2">' +
                '<div class="form-group">' +
                '<label for="personTel">Mobile</label>' +
                '<input type="text" class="form-control" name="personTel[]" required>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label for="personEmail">Email</label>' +
                '<input type="text" class="form-control" name="personEmail[]" required>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<div class="form-group">' +
                '<label for="personLine">Line</label>' +
                '<input type="text" class="form-control" name="personLine[]" >' +
                '</div>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<div class="form-group">' +
                '<label for="personWechat">Wechat</label>' +
                '<input type="text" class="form-control" name="personWechat[]" >' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr>' +
                '</div>'
            )
        })

        $(document).on("click", ".del-person", function() {
            $(this).closest(".display-person").remove()
            personNumber--
        })

    })
</script>