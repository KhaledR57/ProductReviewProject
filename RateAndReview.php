<?php
session_start();
if (!isset($_SESSION['adminSession'])) {
    header("Location: Login.php");
    exit(0);
}
require_once 'View/RateView.php';
require_once 'View/ReviewView.php';
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

</head>

<body>
<h1 style="text-align: center;margin: 20px">Rate And Review Tables </h1>
<hr>
<table class="table table-responsive table-bordered ">

    <tr class="thead-dark">
        <th class="col-3">Name</th>
        <th class="col-3">User Name</th>
        <th class="col-3">Product Name</th>
        <th class="col-4">Rate</th>
        <th class="col-6">progress</th>
    </tr>

    <?php
    if (isset($_GET['productID'])) {
        $id = $_GET['productID'];
        $rateView = new RateView();
        $rateView->showRate($id);
    }
    ?>
</table>
<table class="table table-responsive table-bordered ">
    <tr class="thead-dark">
        <th class="col-6">User Name</th>
        <th class="col-6">Review</th>
        <th class="col-6">Action</th>
    </tr>
    <?php
    if (isset($_GET['productID'])) {
        $id = $_GET['productID'];
        $reviewView = new ReviewView();
        $reviewView->showReview($id);

    }

    ?>
</table>
</body>

</html>