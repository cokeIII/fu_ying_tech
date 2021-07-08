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

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Company Information</h3>
                    </div>
                </div>
                <form action="insertCustomer.php" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="companyName">Company Code:</label>
                                <input type="text" class="form-control" name="companyCode" id="companyCode" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="companyName">Company Name:</label>
                                <input type="text" class="form-control" name="companyName" id="companyName" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="taxID">Tax ID:</label>
                                <input type="text" class="form-control" name="taxID" id="taxID" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="website">website:</label>
                                <input type="text" class="form-control" name="website" id="website" required>
                            </div>
                        </div>
                        <div class="col-md-1.5">
                            <div class="form-group">
                                <label for="payment">Payment:</label>
                                <select class="form-control" name="payment" id="payment">
                                    <option value="30" selected="selected">30</optoin>
                                    <option value="60">60</optoin>
                                    <option value="90">90</optoin>
                                    <option value="120">120</optoin>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="companyAddress">Company Address: (Head Office)</label>
                                <textarea class="form-control" name="companyAddress[]" id="companyAddress" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel">tel</label>
                                <input type="text" class="form-control" name="tel[]" id="tel" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label for="addBranch">Branch</label>
                            <button type="button" class="btn btn-primary" id="addBranch"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
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

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dept"> 1. Dept</label>
                                <select name="dept[]" class="form-control">
                                    <option value="Purchasing" selected="selected">Purchasing</optoin>
                                    <option value="Maintenance">Maintenance</optoin>
                                    <option value="Production">Production</optoin>
                                    <option value="Finance">Finance</optoin>
                                    <option value="HR">HR</optoin>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="personName">Person Name</label>
                                <input type="text" class="form-control" name="PersonName[]" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nickName:">Nick Name</label>
                                <input type="text" class="form-control" name="nickName[]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="personTel">Mobile</label>
                                <input type="text" class="form-control" name="personTel[]" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="personEmail">Email</label>
                                <input type="email" class="form-control" name="personEmail[]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="personLine">Line</label>
                                <input type="text" class="form-control" name="personLine[]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="personWechat">Wechat</label>
                                <input type="text" class="form-control" name="personWechat[]">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="disPerson">

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary m-2" type="submit">Save</button>
                                <button class="btn btn-default m-2" type="reset">Reset</button>
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
                '<textarea class="form-control" name="companyAddress[]" id="companyAddress" cols="30" rows="3"></textarea>' +
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
                '<option value="Purchasing" selected="selected">Purchasing</optoin>' +
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