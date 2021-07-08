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
$part_no = $_REQUEST["part_no"];
$sql = "select * from part where part_no ='$part_no'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h3>Edit Part</h3>
                <form action="editPart.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="part_no">Part No</label>
                            <input type="text" class="form-control" name="part_no" id="part_no" value="<?php echo $row["part_no"]; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="part_name">Part Name</label>
                            <input type="text" class="form-control" name="part_name" id="part_name" value="<?php echo $row["part_name"]; ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit" id="unit" value="<?php echo $row["unit"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="part_description">Description</label>
                            <textarea name="part_description" id="part_description" cols="30" rows="4" class="form-control"><?php echo $row["part_description"]; ?></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control" step="0.01" value="<?php echo $row["unit_price"]; ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="img">Part Image</label>
                            <input type="file" name="img" id="img" class="form-control">
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <button data-toggle="modal" data-target="#part_img" type="button" class="btn btn-info">see old pictures</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary"> Save </button>
                        <!-- <button type="reset" class="btn btn-darkgray ml-3"> Reset </button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<!-- Modal -->
<div class="modal fade" id="part_img" tabindex="-1" role="dialog" aria-labelledby="part_imgLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="part_imgLabel"><?php echo $row["part_no"]." ".$row["part_name"];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="uploads/<?php echo $row["img"];?>" id="partImg" width="100%" height="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="jquery/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {})
</script>