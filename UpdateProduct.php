<?php
session_start();
if (!isset($_SESSION['adminSession'])) {
    header("Location: Login.php");
    exit(0);
}
require_once 'Controller/ProductController.php';

//display data on update form

if (isset($_GET['productID'])) {
    require_once 'Model/Product.php';
    $id = $_GET['productID'];
    $product = new ProductController();
    $prodInfo = $product->viewProduct($id);
} else {
    header("Location: Admin.php");
    exit(0);
}

if (isset($_POST['update_prod'])) {

    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $sellerName = $_POST['seller_name'];
    $sellerPhone = $_POST['seller_phone'];
    $sellerAddress = $_POST['seller_address'];
    $prodDescription = $_POST['description'];
    $category = $_POST['category'];
    $productImage = $_FILES['product_image']['name'];
    $tempProdImage = $_FILES['product_image']['tmp_name'];

    if (!empty($productImage)) {
        $ext = explode('.', $productImage);
        $productImageExt = end($ext);
        $productImageExt = strtolower($productImageExt);

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($productImageExt, $allowed)) {
            $productImageNew = uniqid('', true) . "." . $productImageExt;
            move_uploaded_file($tempProdImage, "upload/ProductsImages/$productImageNew");
            $is_ext = true;
        } else {
            $is_ext = false;
        }
    }

    if ($is_ext)
        $res = $product->editProduct($id, $productName, $category, $sellerName, $sellerPhone, $sellerAddress, $productPrice, $prodDescription, $productImageNew);
    else
        $res = $product->editProduct($id, $productName, $category, $sellerName, $sellerPhone, $sellerAddress, $productPrice, $prodDescription, null);


    if (!$is_ext && !empty($profileImage))
        echo '<div class="alert alert-danger" role="alert">Sorry Invalid File Extension!</div>';
    elseif (!$res)
        echo '<div class="alert alert-danger" role="alert">Sorry Insertion Failed!</div>';
    else {
        header("Location: ProductsTable.php");
        exit(0);
    }

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

<h2 style="text-align: center;margin: 20px">Update Product</h2>
<div class="container">

    <h5>update Product picture</h5>

    <img class="img-thumbnail" src="upload/ProductsImages/<?= $prodInfo['product_image'] ?>" width="200px"
         height="200px" alt="image">
    <br>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <input type="file" name="product_image"><br>
        </div>

        <div class="radio">

            <label><input type="radio" name="category"
                          value="TV" <?php if ($prodInfo['category'] == "TV") echo("checked"); ?>> TV</label>
        </div>
        <div class="radio">
            <label><input value="Laptop" type="radio"
                          name="category" <?php if ($prodInfo['category'] == "Laptop") echo("checked"); ?>>
                Laptop</label>
        </div>
        <div class="radio">
            <label><input type="radio" value="Watch"
                          name="category" <?php if ($prodInfo['category'] == "Watch") echo("checked"); ?> >
                Watch</label>
        </div>
        <div class="radio">
            <label><input type="radio" value="Mobile"
                          name="category" <?php if ($prodInfo['category'] == "Mobile") echo("checked"); ?>>
                Mobile</label>
        </div>


        <div class="form-group">
            <input type="text" value="<?= $prodInfo['product_name'] ?>" class="form-control" name="product_name"
                   placeholder="Enter Product Name" required>
        </div>


        <div class="form-group">
            <input type="number" value="<?= $prodInfo['product_price'] ?>" class="form-control" name="product_price"
                   placeholder="Enter Product Price" required>
        </div>


        <div class="form-group">
            <input type="text" value="<?= $prodInfo['seller_name'] ?>" class="form-control" name="seller_name"
                   placeholder="Enter Seller Name" required>
        </div>


        <div class="form-group">
            <input type="text" value="<?= $prodInfo['seller_phone'] ?>" class="form-control" name="seller_phone"
                   placeholder="Enter Seller Phone" required>
        </div>


        <div class="form-group">
            <input type="text" value="<?= $prodInfo['seller_address'] ?>" class="form-control" name="seller_address"
                   placeholder="Enter Seller Address" required>
        </div>


        <div class="form-group">
            <textarea class="form-control" rows="7" name="description" placeholder="Enter Product Description"
                      required><?= $prodInfo['product_desc'] ?></textarea>
        </div>


        <input class="btn btn-success" type="submit" name="update_prod" value="Update Product">
    </form>
</div>


</body>

</html>