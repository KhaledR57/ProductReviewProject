<?php
require_once 'Model/Product.php';

class ProductView extends Product
{
    public function __construct()
    {
    }

    public function showProducts()
    {
        $Products = $this->getAllProducts();

        foreach ($Products as $product):?>
            <tr>
                <td><?= $product['ID'] ?></td>
                <td><img class="img-thumbnail" src="upload/ProductsImages/<?= $product['product_image'] ?>"
                         alt="productImage"></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['category'] ?></td>
                <td><?= $product['product_desc'] ?></td>
                <td><?= $product['product_price'] ?></td>
                <td><?= $product['seller_name'] ?></td>
                <td><?= $product['seller_phone'] ?></td>
                <td><?= $product['seller_address'] ?></td>

                <td><a href="Delete.php?productID=<?= $product['ID'] ?>" class="btn btn-danger col-12"
                       style="margin-top: 5%">Delete</a>
                    <a href="UpdateProduct.php?productID=<?= $product['ID'] ?>" class="btn btn-success col-12"
                       style="margin-top: 5%">Edit</a>
                    <a href="RateAndReview.php?productID=<?= $product['ID'] ?>" class="btn btn-info col-12"
                       style="margin-top: 5%">Rate And Review</a></td>
            </tr>
        <?php
        endforeach;
    }

    /*
     this function must show when user choose type of category you must call this function
    */
    public function showProductsByCategory($category)
    {
        $Products = $this->getProductByCategory($category);
        foreach ($Products as $product):?>
            <tr>
                <td><?= $product['ID'] ?></td>
                <td><img class="img-thumbnail" src="upload/ProductsImages/<?= $product['product_image'] ?>"
                         alt="productImage"></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['category'] ?></td>
                <td><?= $product['product_desc'] ?></td>
                <td><?= $product['product_price'] ?></td>
                <td><?= $product['seller_name'] ?></td>
                <td><?= $product['seller_phone'] ?></td>
                <td><?= $product['seller_address'] ?></td>

                <td><a href="Delete.php?productID=<?= $product['ID'] ?>" class="btn btn-danger col-12"
                       style="margin-top: 5%">Delete</a>
                    <a href="UpdateProduct.php?productID=<?= $product['ID'] ?>" class="btn btn-success col-12"
                       style="margin-top: 5%">Edit</a>
                    <a href="RateAndReview.php?productID=<?= $product['ID'] ?>" class="btn btn-info col-12"
                       style="margin-top: 5%">Rate
                        And Review</a></td>
            </tr>
        <?php
        endforeach;

    }

    public function showProductsByCategoryUser($category, $n)
    {
        $Products = $this->getProductByCategory($category);
        foreach ($Products as $product):?>
            <div class="card">
                <img class="card-img-top" src="upload/ProductsImages/<?= $product['product_image'] ?>"
                     alt="Card image cap" style="width: 50%; height: 11rem">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['product_name'] ?></h5>
                    <h2 class="card-title"><span style="color:#000000 "><?= $product['product_price'] . " EGP" ?></span>
                    </h2>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <br><br>
                    <?php if ($n == 0):?>
                        <a href="Details.php?productID=<?= $product['ID'] ?>" class="btn btn-primary"
                           style="background: steelblue; !important;border: none;!important;">More Details</a>
                    <?php else:?>
                        <a href="compare.php?productID1=<?= $_GET['prodID1'] . "&productID2=" . $product['ID'] ?>"
                           class="btn btn-primary"
                           style="background: steelblue; !important;border: none;!important;">choose</a>
                    <?php
                    endif;?>
                </div>
            </div>
        <?php
        endforeach;

    }


    public function showProduct($id)
    {
        $Products = $this->getProduct($id);
        $rateView = new RateView();
        ?>
        <div class="col-sm-5">
        <a href="chooseProdTocompare.php?category=<?= $Products['category'] . "&prodID1=" . $_GET['productID'] ?>"
           class="btn btn-info">Compare to another product</a>
        <hr>
        <h3 class="card-title"><?= $Products['product_name'] ?></h3>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        (
        <?php $rateView->showAVg($id); ?>
        from 5)
        <br>
        <hr>
        <img src="upload/ProductsImages/<?= $Products['product_image'] ?>" class="img-responsive"
             style="width: 80%; height: 25rem" alt="Image">

        </div>
        <div class="col-sm-3">
            <h2 class="card-title"><span style="color:#000000 "><?= $Products['product_price'] ?> <span
                            style="color:#75846f;font-size: 20px ">EGP</span></span></h2>
            <br>
            <h5>Description :</h5>
            <p>
                <?= $Products['product_desc'] ?>
            </p>
            <br>
            <h5>Seller Name :</h5>
            <p>
                <?= $Products['seller_name'] ?>
            </p>
            <br>
            <h5>Seller Address :</h5>
            <p>
                <?= $Products['seller_address'] ?>
            </p>
            <br>
            <h5>Seller Phone :</h5>
            <p>
                <?= $Products['seller_phone'] ?>
            </p>
        </div>

        <?php
    }

    public function compare($id1,$id2){
        $Product1 = $this->getProduct($id1);
        $Product2 = $this->getProduct($id2);
        $rateView = new RateView();
        ?>

        <a href="chooseProdTocompare.php?category=<?= $Product1['category'] ."&prodID1=". $id1?>" class="btn btn-info">Choose Another To Compare</a>
    <hr>
    <div class="row">
        <div class="col-sm-4">


            <h3 class="card-title"><?= $Product1['product_name'] ?></h3>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            (
            <?php $rateView->showAVg($id1);?>
            from 5)
            <br><hr>
            <img src="upload/ProductsImages/<?= $Product1['product_image'] ?>" class="img-responsive" style="width: 80%; height: 25rem" alt="Image">
        </div>
        <div class="col-sm-2">
            <h2 class="card-title"><span style="color:#000000;font-size: 25px  "><?= $Product1['product_price'] ?> <span style="color:#75846f;font-size: 15px ">EGP</span></span></h2>            <br>
            <h5>Description :</h5>
            <p>
                <?= $Product1['product_desc'] ?>
              </p>
            <br>
            <h5>Seller Name :</h5>
            <p>
                <?= $Product1['seller_name'] ?>
            </p>
            <br>
            <h5>Seller Address :</h5>
            <p>
                <?= $Product1['seller_address'] ?>
            </p>
            <br>
            <h5>Seller Phone :</h5>
            <p>
                <?= $Product1['seller_phone'] ?>
            </p>


        </div>

        <div class="col-sm-4">


            <h3 class="card-title"><?= $Product2['product_name'] ?></h3>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            (
            <?php $rateView->showAVg($id2);?>
            from 5)
            <br><hr>
            <img src="upload/ProductsImages/<?= $Product2['product_image'] ?>" class="img-responsive" style="width: 80%; height: 25rem" alt="Image">
        </div>
        <div class="col-sm-2">
            <h2 class="card-title"><span style="color:#000000;font-size: 25px  "><?= $Product2['product_price'] ?> <span style="color:#75846f;font-size: 15px ">EGP</span></span></h2>
            <br>
            <h5>Description :</h5>
            <p>
                <?= $Product2['product_desc'] ?>
            </p>
            <br>
            <h5>Seller Name :</h5>
            <p>
                <?= $Product2['seller_name'] ?>
            </p>
            <br>
            <h5>Seller Address :</h5>
            <p>
                <?= $Product2['seller_address'] ?>
            </p>
            <br>
            <h5>Seller Phone :</h5>
            <p>
                <?= $Product2['seller_phone'] ?>
            </p>


        </div>

    </div>

        <?php
    }
}