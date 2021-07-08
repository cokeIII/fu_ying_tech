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
$sql = "select * from customer";
$res = mysqli_query($conn, $sql);
?>

<body>
    <div class="container mt-5">
        <?php require_once "menu.php"; ?>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <a href="formInsertCus.php"><button class="btn btn-primary m-2">Add Customer</button></a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="" id="listCustomer">
                            <thead>
                                <tr>
                                    <th>tax_id</th>
                                    <th>company name</th>
                                    <th>website</th>
                                    <th>payment</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($res)) { ?>
                                    <tr>
                                        <td><?php echo $row["tax_id"]; ?></td>
                                        <td><?php echo $row["company_name"]; ?></td>
                                        <td><?php echo $row["website"]; ?></td>
                                        <td><?php echo $row["payment"]; ?></td>
                                        <td><a href="formEditCus.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button></a></td>
                                        <td><button class="btn btn-danger delCustomer" id="<?php echo $row["id"]; ?>"><i class="fas fa-trash-alt"></i> Del</button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
        $("#listCustomer").DataTable()
        $(".delCustomer").click(function() {
            if (confirm("you want to delete the item ?")) {
                $.redirect("delCustomer.php", {
                    id: $(this).attr("id"),
                },"GET");
            }
        })
    })
</script>