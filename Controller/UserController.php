<?php

require_once 'Model/User.php';
require_once 'Controller/RateController.php';
require_once 'Controller/FeedbackController.php';
require_once 'Controller/ReviewController.php';
class UserController extends User
{
    public function __construct()
    {
    }

    public function isExist($userName, $password)
    {
        return $this->login($userName, $password);
    }

    public function createUserI($userName, $password, $profileImageNew, $firstName, $lastName)
    {
        return $this->setUser($userName, $password, $profileImageNew, $firstName, $lastName);
    }

    public function createUserNoI($userName, $password, $firstName, $lastName)
    {
        return $this->setUser($userName, $password, "default3.png", $firstName, $lastName);
    }

    public function removeUser($id)
    {
        $rateController = new RateController();
        $feedbackController = new FeedbackController();
        $reviewController = new ReviewController();
        $rateController->removeRateByUserId($id);
        $feedbackController->removeUserById($id);
        $reviewController->removeReviewByUserId($id);
        return $this->deleteUser($id);
    }

    public function editUser($id, $password, $profileImageNew, $firstName, $lastName)
    {
        return $this->updateUser($id, $password, $profileImageNew, $firstName, $lastName);
    }

    public function viewUser($ID)
    {
        return $this->getUser($ID);
    }
}