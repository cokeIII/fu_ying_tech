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
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h3>Add Part</h3>
                <form action="insertPart.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="part_no">Part No</label>
                            <input type="text" class="form-control" name="part_no" id="part_no">
                        </div>
                        <div class="col-md-6">
                            <label for="part_name">Part Name</label>
                            <input type="text" class="form-control" name="part_name" id="part_name">
                        </div>
                        <div class="col-md-3">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit" id="unit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="part_description">Description</label>
                            <textarea name="part_description" id="part_description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label for="img">Part Image</label>
                            <input type="file" name="img" id="img" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary"> Save </button>
                        <button type="reset" class="btn btn-darkgray ml-3"> Reset </button>
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
    $(document).ready(function() {})
</script>