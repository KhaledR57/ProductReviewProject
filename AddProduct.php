<?php
session_start();
if (!isset($_SESSION['adminSession'])) {
    header("Location: Login.php");
    exit(0);
}

require_once 'Controller/ProductController.php';

if (isset($_POST['formSubmit'])) {
    $productImage = $_FILES['product_image']['name'];
    $tempProductImage = $_FILES['product_image']['tmp_name'];
    $category = $_POST['category'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $sellerName = $_POST['seller_name'];
    $sellerPhone = $_POST['seller_phone'];
    $sellerAddress = $_POST['seller_address'];
    $productDesc = $_POST['product_desc'];

    $ext = explode('.', $productImage);
    $productImageExt = end($ext);
    $productImageExt = strtolower($productImageExt);

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($productImageExt, $allowed)) {
        $productImageNew = uniqid('', true) . "." . $productImageExt;
        move_uploaded_file($tempProductImage, "upload/ProductsImages/$productImageNew");
        $is_ext = true;
    } else {
        $is_ext = false;
    }
    if ($is_ext) {
        $productNew = new ProductController();
        $productNew->createProduct($productName, $category, $sellerName, $sellerPhone, $sellerAddress, $productPrice, $productDesc, $productImageNew);
    } else
        echo '<div class="alert alert-danger" role="alert">Sorry Invalid File Extension!</div>';

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>product</title>

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
<h1 style="text-align: center;margin: 20px">Add Product</h1>
<div class="container">
    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <h5>Upload Product picture</h5><br>
            <input type="file" name="product_image" required>
            <br><br>
        </div>


        <div class="radio">
            <label><input type="radio" name="category" value="TV" required> TV</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="category" value="Laptop" required> Laptop</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="category" value="Watch" required> Watch</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="category" value="Mobile" required> Mobile</label>
        </div>


        <div class="form-group">
            <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" required>
        </div>


        <div class="form-group">
            <input type="number" class="form-control" name="product_price" placeholder="Enter Product Price" required>
        </div>


        <div class="form-group">
            <input type="text" class="form-control" name="seller_name" placeholder="Enter Seller Name" required>
        </div>


        <div class="form-group">
            <input type="text" class="form-control" name="seller_phone" placeholder="Enter Seller Phone" required>
        </div>


        <div class="form-group">
            <input type="text" class="form-control" name="seller_address" placeholder="Enter Seller Address" required>
        </div>


        <div class="form-group">
            <textarea class="form-control" rows="7" name="product_desc" placeholder="Enter Product Description"
                      required></textarea>
        </div>


        <input class="btn btn-success" type="submit" name="formSubmit" value="Add Product">
    </form>
</div>


</body>

</html>