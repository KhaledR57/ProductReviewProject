<?php

require_once 'DataBaseConnection.php';

class Rating
{
    private $ID;
    private $userID;
    private $productID;
    private $rate;

    private function __construct($ID, $userID, $productID, $rate)
    {
        $this->ID = $ID;
        $this->userID = $userID;
        $this->productID = $productID;
        $this->rate = $rate;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getProductID()
    {
        return $this->productID;
    }

    public function getRate()
    {
        return $this->rate;
    }

    protected function getAllUsersRate()
    {
        return DataBaseConnection::getInstance()->getConnection()->prepare("SELECT * FROM rating");

    }

    protected function setUserRate($userID, $productID, $rate)
    {
       /* $res = DataBaseConnection::getInstance()->getConnection()->query("SELECT user_id FROM rating WHERE user_id = '$userID'");
        if ($res->num_rows > 0)
            return false;
        else*/
            return DataBaseConnection::getInstance()->getConnection()->query("INSERT INTO rating(user_id,prod_id,rate)VALUES('$userID','$productID','$rate')");
    }

    protected function getUsersRate($id)
    {
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT users.first_name,users.last_name,users.user_name,products.product_name, rating.rate
                                                                                FROM rating
                                                                                INNER JOIN users ON rating.user_id=users.ID
                                                                                INNER JOIN products ON rating.prod_id=products.ID
                                                                                WHERE prod_id = $id AND rate IS NOT Null");
    }

    protected function deleteRateByProductId($id)
    {
        return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM rating WHERE prod_id = $id;");
    }

    protected function deleteRateByUserId($id)
    {
        return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM rating WHERE user_id = $id;");
    }

    protected function getProductAvgReview($id)
    {
        $sum = DataBaseConnection::getInstance()->getConnection()->query("SELECT SUM(rate) as sum FROM rating WHERE prod_id = $id");
        $count = DataBaseConnection::getInstance()->getConnection()->query("SELECT COUNT(rate) as coun FROM rating WHERE prod_id = $id");
        $data = $count->fetch_assoc();
        $cou = $sum->fetch_assoc();
        if ($data['coun'] == 0) {
            echo "0";
        } else {
            echo ($cou['sum'] / $data['coun']);
        }

    }

}