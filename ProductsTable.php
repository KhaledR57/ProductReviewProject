<?php
session_start();
require_once 'View/ProductView.php';
if (!isset($_SESSION['adminSession'])) {
    header("Location: Login.php");
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
            crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
            integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
            crossorigin="anonymous"></script>

    <style>
        .radio {
            margin: 1%
        }
    </style>

</head>

<body>
<h1 style="text-align: center;margin: 20px">Products Table</h1>
<h5>Category</h5>
<form action="ProductsTable.php" method="GET" style="display:flex;">
    <div class="radio">
        <label><input type="radio" name="category" value="TV"> TV</label>
    </div>
    <div class="radio">
        <label><input type="radio" name="category" value="Laptop"> Laptop</label>
    </div>
    <div class="radio">
        <label><input type="radio" name="category" value="Watch"> Watch</label>
    </div>
    <div class="radio">
        <label><input type="radio" name="category" value="Mobile"> Mobile</label>
    </div>
    <button style="margin: 1%" class="btn btn-primary">Show</button>
</form>
<table class="table table-responsive table-bordered ">
    <tr class="thead-dark">
        <th class="col-1">ID</th>
        <th class="col-1">Product image</th>
        <th class="col-1">Product name</th>
        <th class="col-1">Product category</th>
        <th class="col-3">Description</th>
        <th class="col-1">Product Price</th>
        <th class="col-1">Seller Name</th>
        <th class="col-1">Seller Phone</th>
        <th class="col-1">Seller Address</th>

        <th>Action</th>
    </tr>
    <?php
    $productView = new ProductView();
    if (isset($_GET['category']))
        $productView->showProductsByCategory($_GET['category']);
    else
        $productView->showProducts();
    ?>
</table>
</body>

</html>

