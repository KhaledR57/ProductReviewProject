<?php
session_start();
require_once 'DataBaseConnection.php';
if (!isset($_SESSION['userSession'])) {
    header("Location: Login.php");
    exit(0);
} else {
    require_once 'Controller/ProductController.php';
   // require_once 'View/ProductView.php';
    $productController = new ProductController();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                    <a class="nav-link active" href="Fetch.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="UpdateUser.php?userID=<?= $_SESSION["userSession"][0] ?>">
                        Profile
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-bell" style="margin-right: 2px">Notification</span><span class="label label-pill label-danger count" style="border-radius: 100%;
color: whitesmoke;
background: red;
width: 15px !important;
display: inline-block;
height: 15px;
text-align: center;
font-size: 10px;"></span> </a>
                    <ul class="dropdown-menu"></ul>
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

<!--- Image Slider -->

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="SiteImages/Laptop.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>

        <div class="carousel-item">
            <img class="d-block w-100" src="SiteImages/william-hook-9e9PD9blAto-unsplash.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <br>
</div>

<!--- Welcome Section -->
<div class="container-fluid padding">
    <div class="row text-center padding">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <img class="card-img-top"  src="img/choose-png.png" alt="choose" style="width: 100px;height: 100px;">
            <br><br>

            <p>This website is used to help you to get a product
                at its best choice and best price. This website allows
                you to look into a product with different reviews
                and rating rated by other users and for his simplicity
                the website shows the overall average rating of that product.</p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <img class="card-img-top"  src="img/rating.png" alt="choose" style="width: 300px;height: 100px;">
            <br><br>
            <p>The website gives a list of sellers and its price
                offered convenience and preference. You can role is to
                check out for the product using all the resources
                offered by the website in finding the best product
                and give your rating and review. You can is also
                allowed to give your feedback.</p>
        </div>
        <div class="col-xs-12 col-md-4">
            <img class="card-img-top"  src="img/compare.png" alt="choose" style="width: 150px;height: 100px;">
            <br><br>
            <p>The user can view all the products based on the category
                The user can view a single product with all the
                details namely pictures, overall ratings,
                sellers information, description and ratings/reviews,
                you can compare to products of the same kind/category</p>
        </div>
    </div>
    <hr class="my-4">
</div>


<!-- Categories -->
<div class="container-fluid padding">
    <div class="row welcome text-center">
        <div class="col-12">
            <h2 class="display-4">Our Categories</h2>
            <hr>
        </div>
    </div>
</div>

<!--- Cards -->
<div class="container-fluid padding">
    <div class="row padding">
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="upload/ProductsImages/P_setting_fff_1_90_end_600.jpg">
                <div class="card-body">
                    <h4 class="card-title">Laptop</h4>
                    <p class="card-text">
                        This Category shows you the Laptop , it's price and the user's reviews about it  </p>
                    <a href="prodByCategory.php?category=<?="Laptop"?>"  class="btn btn-outline-secondary">Show Products</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="upload/ProductsImages/giant_81527.jpg">
                <div class="card-body">
                    <h4 class="card-title">Mobile</h4>
                    <p class="card-text">
                        This Category shows you theSmart mobile , it's price and the user's reviews about it
                    </p>
                    <a href="prodByCategory.php?category=<?="Mobile"?>" class="btn btn-outline-secondary">Show Products</a>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="upload/ProductsImages/800927-515x515.jpg">
                <div class="card-body">
                    <h4 class="card-title">TV</h4>
                    <p class="card-text">
                        This Category shows you the smart TV , it's price and the user's reviews about it
                    </p>
                    <a href="prodByCategory.php?category=<?="TV"?>" class="btn btn-outline-secondary">Show Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="upload/ProductsImages/oyvm1505182016907.jpg">
                <div class="card-body">
                    <h4 class="card-title">Watch</h4>
                    <p class="card-text">
                        This Category shows you the Watch , it's price and the user's reviews about it
                    </p>
                    <a href="prodByCategory.php?category=<?="Watch"?>" class="btn btn-outline-secondary">Show Products</a>
                </div>
            </div>
        </div>


    </div>
</div>


     <br>
<!-- Products -->
<div class="container-fluid padding">
    <div class="row text-center padding">
        <div class="col-12">
            <h1 class="display-4">Products</h1>
            <i class="fa fa-angle-down"></i>
            <hr>
        </div>

        <div class="col-md-12">
            <div class="section-title-center text-left" style="width: 30%">
                <h2 class="title pl-0" style="display: inline">Watches</h2>
                <i style="margin-left: 3%" class="fa fa-angle-right"></i>
                <hr>
            </div>
        </div>
        <div class="carcard">
            <div class="owl-carousel owl-theme" style="width: 90%;">
                <?php
                $Products = $productController->showProductsByCategory("Watch");
                foreach ($Products as $product):?>
                    <div class="card">
                        <img class="card-img-top" src="upload/ProductsImages/<?= $product['product_image'] ?>"
                             alt="Card image cap" style="width: 50%; height: 11rem">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['product_name'] ?></h5>
                            <p class="card-text">Some quick example text to build on the card title .</p>
                            <a href="Details.php?productID=<?= $product['ID'] ?>" class="btn btn-primary"
                               style="background: steelblue; !important;border: none;!important;">More Details</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="section-title-center text-left" style="width: 30%">
                <h2 class="title pl-0" style="display: inline">Laptops</h2>
                <i style="margin-left: 3%" class="fa fa-angle-right"></i>
                <hr>
            </div>
        </div>
        <div class="carcard">
            <div class="owl-carousel owl-theme" style="width: 90%">
                <?php
                $Products = $productController->showProductsByCategory("Laptop");
                foreach ($Products as $product):?>
                    <div class="card">
                        <img class="card-img-top" src="upload/ProductsImages/<?= $product['product_image'] ?>"
                             alt="Card image cap" style="width: 50%; height: 8em">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['product_name'] ?></h5>
                            <p class="card-text">Some quick example text to build on the card title .</p>
                            <a href="Details.php?productID=<?= $product['ID'] ?>" class="btn btn-primary"
                               style="background: steelblue; !important;border: none;!important;">More Details</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>


        <div class="col-md-12">
            <div class="section-title-center text-left" style="width: 30%">
                <h2 class="title pl-0" style="display: inline">Mobile</h2>
                <i style="margin-left: 3%" class="fa fa-angle-right"></i>
                <hr>
            </div>
        </div>
        <div class="carcard">
            <div class="owl-carousel owl-theme" style="width: 90%">
                <?php
                $Products = $productController->showProductsByCategory("Mobile");
                foreach ($Products as $product):?>
                    <div class="card">
                        <img class="card-img-top" src="upload/ProductsImages/<?= $product['product_image'] ?>"
                             alt="Card image cap" style="width: 50%; height: 12rem">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['product_name'] ?></h5>
                            <p class="card-text">Some quick example text to build on the card title .</p>
                            <a href="Details.php?productID=<?= $product['ID'] ?>" class="btn btn-primary"
                               style="background: steelblue; !important;border: none;!important;">More Details</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>


        <div class="col-md-12">
            <div class="section-title-center text-left" style="width: 30%">
                <h2 class="title pl-0" style="display:inline;">TV</h2>
                <i style="margin-left: 3%" class="fa fa-angle-right"></i>
                <hr>
            </div>
        </div>
        <div class="carcard">
            <div class="owl-carousel owl-theme" style="width: 90%">
                <?php
                $Products = $productController->showProductsByCategory("TV");
                foreach ($Products as $product):?>
                    <div class="card">
                        <img class="card-img-top" src="upload/ProductsImages/<?= $product['product_image'] ?>"
                             alt="Card image cap" style="width: 50%; height: 9rem">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['product_name'] ?></h5>
                            <p class="card-text">Some quick example text to build on the card title .</p>
                            <a href="Details.php?productID=<?= $product['ID'] ?>" class="btn btn-primary"
                               style="background: steelblue; !important;border: none;!important;">More Details</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <hr class="my-4">
</div>


<!--- Fixed background -->
<figure>
    <div class="fixed-wrap">
        <div id="fixed">

        </div>
    </div>
</figure>
<br>
<br>
<br>

<!--- Meet the team -->
<div class="container-fluid padding">
    <div class="row welcome text-center">
        <div class="col-12">
            <h1 class="display-4">Meet The Team</h1>
            <hr>
        </div>
    </div>
</div>

<!--- Cards -->
<div class="container-fluid padding">
    <div class="row padding">
        <div class="col-md-2">
            <div class="card">
                <img class="card-img-top" src="upload/ProfileImages/khaled.jpg">
                <div class="card-body">
                    <h4 class="card-title">Khaled</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, aspernatur atque deserunt
                    </p>
                    <a href="#" class="btn btn-outline-secondary">See Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img class="card-img-top" src="upload/ProfileImages/omar.jpg">
                <div class="card-body">
                    <h4 class="card-title">Omar</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, aspernatur atque deserunt
                    </p>
                    <a href="#" class="btn btn-outline-secondary">See Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img class="card-img-top" src="upload/ProfileImages/shady.jpg">
                <div class="card-body">
                    <h4 class="card-title">Shady</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, aspernatur atque deserunt
                    </p>
                    <a href="#" class="btn btn-outline-secondary">See Profile</a>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <img class="card-img-top" src="upload/ProfileImages/hameed.jpg">
                <div class="card-body">
                    <h4 class="card-title">Hameed</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, aspernatur atque deserunt
                    </p>
                    <a href="#" class="btn btn-outline-secondary">See Profile</a>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <img class="card-img-top" src="upload/ProfileImages/hussain.jpg">
                <div class="card-body">
                    <h4 class="card-title">Hussein</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, aspernatur atque deserunt
                    </p>
                    <a href="#" class="btn btn-outline-secondary">See Profile</a>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <img class="card-img-top" src="upload/ProfileImages/hamdy.jpg">
                <div class="card-body">
                    <h4 class="card-title">Mohamed</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, aspernatur atque deserunt
                    </p>
                    <a href="#" class="btn btn-outline-secondary">See Profile</a>
                </div>
            </div>
        </div>

    </div>
</div>

<!--- Two Column Section -->
<div class="container-fluid padding">
    <div class="row padding">
        <div class="col-lg-6">
            <h2>Our Philosophy</h2>
            <p>This system is used to help a user to get a product at its best choice and best price.</p>
            <p>This system allows the user to look into a product with different reviews and rating rated by other users
                and for his simplicity the system shows the overall average rating of that product.</p>
            <p>The System also allows the user to compare two products of the same kind or same category and to rate and
                review the product as he wishes too but limiting to only once per product.</p>
            <p>The System is meant to give a rough as well as a much detailed idea of whether the user should go for a
                product.</p>
        </div>
        <div class="col-lg-6">
            <img class="img-fluid" src="img/mobile-version_-web-version.gif">
        </div>
    </div>
    <hr class="my-4">
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
                    if(isset($_POST['feed_btn'])){
                        require_once 'Controller/FeedbackController.php';
                        $id = $_SESSION['userSession'][0];
                        $feedback = $_POST['feedback'];

                        $feedController = new FeedbackController();
                        $feedController->createFeedback($id,trim($feedback));
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

    $(document).ready(function(){

        function load_unseen_notification(view = '')
        {
            $.ajax({
                url:"Fetch.php",
                method:"POST",
                data:{view:view},
                dataType:"json",
                success:function(data)
                {
                    $('.dropdown-menu').html(data.notification);
                    if(data.unseen_notification > 0)
                    {
                        $('.count').html(data.unseen_notification);
                    }
                }
            });
        }

        load_unseen_notification();

        $(document).on('click', '.dropdown-toggle', function(){
            $('.count').html('');
            load_unseen_notification('yes');
        });

        setInterval(function(){
            load_unseen_notification();
        }, 5000);

    });

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
        document.getElementById("btn_feed").disabled = !(withOutSpace >= 20 && withOutSpace <= 300);
    }




</script>
</body>
</html>