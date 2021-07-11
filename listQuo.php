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
$sql = "select * from quotation group by quo_no";
$res = mysqli_query($conn, $sql);
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="quotation.php"><button class="btn btn-primary mb-3">Create Quotation</button></a>
                    </div>
                </div>
                <table class="table" id="listQuo">
                    <thead>
                        <tr>
                            <th>quo_no</th>
                            <th>quo_to</th>
                            <th>quo_from</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($res)) { ?>
                            <tr>
                                <td><?php echo $row["quo_no"]; ?></td>
                                <td><?php echo $row["quo_to"]; ?></td>
                                <td><?php echo $row["quo_from"]; ?></td>
                                <td><a href="printQuo.php?quo_no=<?php echo $row["quo_no"]; ?>" target="_blank"><button class="btn btn-info"><i class="fas fa-print"></i> Print</button></a></td>
                                <td><button class="btn btn-danger delQuo" quo_no="<?php echo $row["quo_no"]; ?>"><i class="fas fa-trash-alt"></i> Del</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<script src="jquery/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="jquery/jquery.dataTables.min.js"></script>
<script src="jquery/jquery.redirect.js"></script>
<script>
    $(document).ready(function() {
        $("#listQuo").DataTable()
        $(".delQuo").click(function() {
            if (confirm("you want to delete the item ?")) {
                $.redirect("delQuo.php", {
                    quo_no: $(this).attr("quo_no"),
                }, "GET");
            }
        })
    })
</script>