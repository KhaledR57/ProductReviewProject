<?php


require_once 'DataBaseConnection.php';

class Product
{
    private $ID;
    private $productName;
    private $category;
    private $sellerName;
    private $sellerPhone;
    private $sellerAddress;
    private $productPrice;
    private $productDescription;
    private $productImage;

    private function __construct($ID, $productName, $category, $sellerName, $sellerPhone, $sellerAddress, $productPrice, $productDescription, $productImage)
    {
        $this->ID = $ID;
        $this->productName = $productName;
        $this->category = $category;
        $this->sellerName = $sellerName;
        $this->sellerPhone = $sellerPhone;
        $this->sellerAddress = $sellerAddress;
        $this->productPrice = $productPrice;
        $this->productDescription = $productDescription;
        $this->productImage = $productImage;
    }

    public function getID()
    {
        return $this->ID;
    }


    public function getProductName()
    {
        return $this->productName;
    }


    public function getCategory()
    {
        return $this->category;
    }


    public function getSellerName()
    {
        return $this->sellerName;
    }


    public function getSellerPhone()
    {
        return $this->sellerPhone;
    }


    public function getSellerAddress()
    {
        return $this->sellerAddress;
    }


    public function getProductPrice()
    {
        return $this->productPrice;
    }


    public function getProductDescription()
    {
        return $this->productDescription;
    }


    public function getProductImage()
    {
        return $this->productImage;
    }

    protected function getProduct($ID)
    {
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT * FROM products WHERE ID = '$ID' ")->fetch_assoc();
    }

    protected function setProduct($productName, $category, $sellerName, $sellerPhone, $sellerAddress, $productPrice, $productDescription, $productImage)
    {
        return DataBaseConnection::getInstance()->getConnection()->query("INSERT INTO products(product_name,category,seller_name,seller_phone,seller_address,product_price,product_desc,product_image)VALUES('$productName','$category','$sellerName','$sellerPhone','$sellerAddress','$productPrice','$productDescription','$productImage')");
    }

    protected function getAllProducts()
    {
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT * FROM products");
    }

    protected function deleteProduct($ID)
    {
        return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM products WHERE ID = $ID;");
    }

    protected function updateProduct($ID, $productName, $category, $sellerName, $sellerPhone, $sellerAddress, $productPrice, $productDescription, $productImage)
    {
        if ($productImage != null)
            return DataBaseConnection::getInstance()->getConnection()->query("UPDATE products SET product_name = '$productName', category = '$category', seller_name = '$sellerName', seller_phone = '$sellerPhone', seller_address = '$sellerAddress', product_price = '$productPrice', product_desc = '$productDescription',product_image = '$productImage' WHERE ID = $ID ");
        else
            return DataBaseConnection::getInstance()->getConnection()->query("UPDATE products SET product_name = '$productName', category = '$category', seller_name = '$sellerName', seller_phone = '$sellerPhone', seller_address = '$sellerAddress', product_price = '$productPrice', product_desc = '$productDescription' WHERE ID = $ID ");

    }

    protected function getProductByCategory($category)
    {
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT * FROM products WHERE category = '$category'");
    }





}