<?php
session_start();
require_once 'View/UserView.php';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>
<h1 style="text-align: center;margin: 20px">Users Table</h1>
<hr>
<table class="table table-responsive table-bordered ">
    <tr class="thead-dark">
        <th class="col-1">ID</th>
        <th class="col-3">Profile Picture</th>
        <th class="col-3">First Name</th>
        <th class="col-3">Last Name</th>
        <th class="col-3">User Name</th>
        <th class="col-3">Password</th>
        <th class="col-3">Created At</th>
        <th class="col-3">Action</th>
    </tr>
    <?php
    $userView = new UserView();
    $userView->showUsers();
    ?>
</table>
</body>

</html>