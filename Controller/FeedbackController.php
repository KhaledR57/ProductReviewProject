<?php

require_once 'Model/Feedback.php';

class FeedbackController extends Feedback
{
    public function __construct()
    {
    }
    public function createFeedback($userID,$feedback){
        return $this->setUserFeedback($userID,$feedback);
    }
    public function removeFeedback($ID){
        $this->deleteUserFeedback($ID);
    }

    public function viewFeedback($ID){
        return $this->getUserFeedback($ID);
    }
    public function removeUserById($ID){
     return $this->deleteUserById($ID);
    }






}