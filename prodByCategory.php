<?php
session_start();
require_once 'DataBaseConnection.php';
if (!isset($_SESSION['userSession'])) {
    header("Location: Login.php");
    exit(0);
} else {
    require_once 'View/ProductView.php';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Product By Category</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <script src="js/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>

        .checked {
            color: orange;
        }
    </style>
</head>
<body style="background-color: whitesmoke;">
<!-- Navigation -->

<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Product Review Analysis for Genuine Rating</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="UpdateUser.php?userID=<?= $_SESSION["userSession"][0] ?>">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Compare
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Team
                    </a>
                </li>

                <li class="nav-item">
                    <button class="btn btn-danger" style="margin-top: 5px">
                        <a style="text-decoration: none;  color: white" href="Logout.php">
                            Log Out
                        </a>
                    </button>
                </li>

            </ul>
        </div>
    </div>
</nav>


<!-- Products -->
<div class="carcard">
    <div class="owl-carousel owl-theme">
        <?php
        $productView = new ProductView();
        if (isset($_GET['category'])) {
            $cat = $_GET['category'];
            $productView->showProductsByCategoryUser($_GET['category'],0);
        }

        ?>
    </div>
</div>



<!--- Connect -->
<div class="container-fluid padding">
    <div class="row padding text-center">
        <div class="col-12">
            <h2 style="color: black">Connect</h2>
        </div>
        <div class="col-12 social padding">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

<!--- Footer -->
<footer style="background: black; color: #eaf0ff">
    <div class="container-fluid padding">
        <div class="row">
            <div class="col-md-4" style="padding-top: 24px;">
                <?php
                if (isset($_POST['feed_btn'])) {
                    require_once 'Controller/FeedbackController.php';
                    $id = $_SESSION['userSession'][0];
                    $feedback = $_POST['feedback'];

                    $feedController = new FeedbackController();
                    $feedController->createFeedback($id, trim($feedback));
                }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label for="feedback">Feedback</label>
                        <textarea name="feedback" type="text" class="form-control" id="feedback"
                                  placeholder="Minimum 20 Character . . ." onkeyup="validFeed()"></textarea>
                        <small id="" class="form-text text-muted">Feel Free To Write What You Want .</small>
                    </div>
                    <button disabled id="btn_feed" type="submit" class="btn btn-primary" name="feed_btn">Submit</button>
                </form>
            </div>
            <div class="col-md-4">
                <hr class="light">
                <h5>Our Hours</h5>
                <hr class="light">
                <p>Sunday:9am - 12am</p>
                <p>wednesday:9am - 12am</p>
                <p>Friday:Closed</p>
            </div>
            <div class="col-md-4">
                <hr class="light">
                <h5>Service Area</h5>
                <hr class="light">
                <p>Sunday:9am - 12am</p>
                <p>wednesday:9am - 12am</p>
                <p>Friday:Closed</p>
            </div>
            <div class="col-12" style="text-align: center">
                <hr class="light">
                <p>&copy; 2020 All rights ar reserved.</p>
            </div>
        </div>
    </div>
</footer>
<!-- End -->
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: true
            },
            600: {
                items: 3,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: true,
            }
        }

    });

    function validFeed() {
        var val = document.getElementById("feedback").value;
        var withOutSpace = val.replace(/\s+/g, '').length;
        if (withOutSpace >= 20 && withOutSpace <= 300) {
            document.getElementById("btn_feed").disabled = false;
        } else {
            document.getElementById("btn_feed").disabled = true;
        }
    }
</script>

</body>
</html>