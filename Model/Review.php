<?php

require_once 'DataBaseConnection.php';

class Review
{
private $ID;
private $userID;
private $productID;
private $review;
private function __construct($ID,$userID,$productID,$review){
    $this->ID = $ID;
    $this->userID = $userID;
    $this->productID = $productID;
    $this->review = $review;
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

    public function getReview()
     {
         return $this->review;
     }



protected function getAllUsersReview(){
    return aBaseConnection::getInstance()->getConnection()->prepare("SELECT * FROM reviewing ");

}

    protected function setUserReview($userID,$productID,$review){
        return DataBaseConnection::getInstance()->getConnection()->query("INSERT INTO reviewing(user_id,prod_id ,review)VALUES('$userID','$productID','$review')");
    }

    protected function getUsersReview($id){
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT users.user_name, reviewing.review ,reviewing.ID
                                                                          FROM reviewing
                                                                          INNER JOIN users ON reviewing.user_id=users.ID
                                                                          WHERE prod_id = $id ;");
    }

    protected function deleteUserReviewByProductId($ID){
        return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM reviewing WHERE prod_id = $ID;");
    }

     protected function deleteUserReviewByUserId($ID){
            return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM reviewing WHERE user_id = $ID;");
        }

     protected function deleteUserReviewById($ID){
            return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM reviewing WHERE ID = $ID;");
      }
}
