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
</head>
<?php
require_once "connect.php";
$sql = "select * from part";
$res = mysqli_query($conn, $sql);
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="formInsertPart.php"><button class="btn btn-primary mb-3">Add Part</button></a>
                    </div>
                </div>
                <table class="table" id="listPart">
                    <thead>
                        <tr>
                            <th>part_no</th>
                            <th>part_name</th>
                            <th>unit</th>
                            <th>unit_price</th>
                            <th>img</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($res)) { ?>
                            <tr>
                                <td><?php echo $row["part_no"]; ?></td>
                                <td><?php echo $row["part_name"]; ?></td>
                                <td><?php echo $row["unit"]; ?></td>
                                <td><?php echo $row["unit_price"]; ?></td>
                                <td><a href="#" class="img" titleName="<?php echo $row["part_no"]." ".$row["part_name"]; ?>" img="<?php echo $row["img"]; ?>" ><?php echo $row["img"]; ?></a></td>
                                <td><a href="formEditPart.php?part_no=<?php echo $row["part_no"]; ?>"><button class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button></a></td>
                                <td><button class="btn btn-danger delPart" id="<?php echo $row["part_no"]; ?>"><i class="fas fa-trash-alt"></i> Del</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                <h5 class="modal-title" id="part_imgLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="partImg" width="100%" height="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="jquery/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="jquery/jquery.dataTables.min.js"></script>
<script src="jquery/jquery.redirect.js"></script>
<script>
    $(document).ready(function() {
        d = new Date();
        $("#listPart").DataTable()
        $(".img").click(function(){
            $("#part_imgLabel").html($(this).attr("titleName"))
            $("#partImg").attr("src","uploads/"+$(this).attr("img")+"?"+d.getTime())
            $("#part_img").modal("show")
        })
        $(".delPart").click(function() {
            if (confirm("you want to delete the item ?")) {
                $.redirect("delPart.php", {
                    id: $(this).attr("id"),
                },"GET");
            }
        })
    })
</script>