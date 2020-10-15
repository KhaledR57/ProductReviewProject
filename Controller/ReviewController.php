<?php

require_once 'Model/Review.php';

class ReviewController extends Review
{
    public function __construct()
    {
    }

    public function createReview($userID, $productID, $review)
    {
        return $this->setUserReview($userID, $productID, $review);
    }


    public function removeReviewById($id)
    {
        return $this->deleteUserReviewById($id);
    }

    public function removeReviewProductById($id)
    {
        return $this->deleteUserReviewByProductId($id);
    }

    public function removeReviewByUserId($id)
    {
        return $this->deleteUserReviewByUserId($id);
    }

}