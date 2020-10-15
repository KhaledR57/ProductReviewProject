<?php
session_start();
require_once 'DataBaseConnection.php';
if (!isset($_SESSION['adminSession'])) {
    header("Location: Login.php");
    exit(0);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Panel</title>

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

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Control Panel</h3>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="Admin.php">Home</a>
            </li>
            <li>
                <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">Products</a>
                <ul class="collapse list-unstyled" id="productSubmenu">
                    <li onclick="loadProducts()">
                        <a href="#">View Products</a>
                    </li>
                    <li onclick="addProduct()">
                        <a href="#">Add Products</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">Users</a>
                <ul class="collapse list-unstyled" id="usersSubmenu">
                    <li onclick="loadUsers()">
                        <a href="#">View Users</a>
                    </li>
                    <li onclick="addUser()">
                        <a href="#">Add Users</a>
                    </li>
                </ul>
            </li>
            <li onclick="loadFeedback()">
                <a href="#">Feedback</a>
            </li>
            <li onclick="loadNotifications()">
                <a href="#">Notifications</a>
            </li>

        </ul>

    </nav>

    <!-- Page Content  -->

    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
                <!--                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"-->
                <!--                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"-->
                <!--                        aria-expanded="false" aria-label="Toggle navigation">-->
                <!--                    <i class="fas fa-align-justify"></i>-->
                <!--                </button>-->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto" style="margin: auto !important;">
                        <li class="nav-item active">
                            <h6>Welcome <?= $_SESSION['adminSession'][1] ?>!</h6>
                        </li>

                    </ul>
                    <a href="Logout.php" class="btn  btn-danger">Logout</a>
                </div>

            </div>
        </nav>

        <div class="line"></div>

        <iframe id="frame" frameborder="0" src="" style="width:100%;" onload="resizeIframe(this)"></iframe>

    </div>
</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });

    function loadUsers() {
        document.getElementById("frame").src = "UsersTable.php"
    }

    function loadFeedback() {
        document.getElementById("frame").src = "FeedBacks.php"
    }

    function loadNotifications() {
        document.getElementById("frame").src = "notifications.php"
    }

    function loadProducts() {
        document.getElementById("frame").src = "ProductsTable.php"
    }

    function addProduct() {
        document.getElementById("frame").src = "AddProduct.php"
    }

    function addUser() {
        document.getElementById("frame").src = "Register.php"
    }


    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }
</script>
</body>


</html>