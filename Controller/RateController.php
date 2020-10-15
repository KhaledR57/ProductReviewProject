<?php

require_once 'Model/Rating.php';

class RateController extends Rating
{
    public function __construct()
    {
    }

    public function createRate($userID, $productID, $rate)
    {
        return $this->setUserRate($userID, $productID, $rate);
    }

    public function removeRateProductById($id)
    {
        return $this->deleteRateByProductId($id);
    }

    public function removeRateByUserId($id)
    {
        return $this->deleteRateByUserId($id);
    }



}