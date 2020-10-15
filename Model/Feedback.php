<?php

require_once 'DataBaseConnection.php';

class Feedback
{
private $ID;
private $userID;
private $feedback;
private function __construct($ID,$userID,$feedback){
    $this->ID = $ID;
    $this->userID = $userID;
    $this->feedback = $feedback;
}

    public function getID()
    {
        return $this->ID;
    }
    public function getUserID()
    {
        return $this->userID;
    }


    public function getFeedback()
    {
        return $this->feedback;
    }
protected function getUserFeedback($ID){
    $res = DataBaseConnection::getInstance()->getConnection()->prepare("SELECT * FROM feedback WHERE ID = ? ");
    $res->bind_param("i", $ID);
    $res->execute();
    $res->store_result();
    $res->bind_result($ID,$userID,$feedback);
    if($res->fetch())
        return new Feedback($ID,$userID,$feedback);
    return null;
}

    protected function setUserFeedback($userID,$feedback){
        return DataBaseConnection::getInstance()->getConnection()->query("INSERT INTO feedback(user_id,feedback)VALUES('$userID','$feedback')");
    }

    protected function getAllUsersFeedback(){
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT feedback.ID, users.first_name,users.last_name ,users.user_name, feedback.feedback
                                                                          FROM feedback
                                                                          INNER JOIN users ON feedback.user_id=users.ID;");
    }

    protected function deleteUserFeedback($ID){
        return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM feedback WHERE ID = $ID;");
    }

     protected function deleteUserById($ID){
            return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM feedback WHERE user_id = $ID;");
        }
}
