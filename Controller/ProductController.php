<?php
require_once 'Model/Product.php';
require_once 'Controller/RateController.php';
require_once 'Controller/ReviewController.php';
class ProductController extends Product
{
    public function __construct()
    {
    }

    public function createProduct($productName,$category,$sellerName,$sellerPhone,$sellerAddress,$productPrice,$productDescription,$productImage){
        return $this->setProduct($productName,$category,$sellerName,$sellerPhone,$sellerAddress,$productPrice,$productDescription,$productImage);
    }

    public function removeProduct($ID){
        $rateController = new RateController();
        $reviewController = new ReviewController();
        $rateController->removeRateProductById($ID);
        $reviewController->removeReviewProductById($ID);
        return $this->deleteProduct($ID);
    }

    public function editProduct($ID,$productName,$category,$sellerName,$sellerPhone,$sellerAddress,$productPrice,$productDescription,$productImage){
        return $this->updateProduct($ID,$productName,$category,$sellerName,$sellerPhone,$sellerAddress,$productPrice,$productDescription,$productImage);
    }

    public function viewProduct($ID){
        return $this->getProduct($ID);
    }
    public function showProductsByCategory($category){
       return $this->getProductByCategory($category);
    }
}