<?php

require_once 'DataBaseConnection.php';

class notification
{
private $ID;
private $notificationSubject;
private $notificationText;

private function __construct($ID,$notificationSubject,$notificationText){
    $this->ID = $ID;
    $this->notificationSubject = $notificationSubject;
    $this->notificationText = $notificationText;

}

    public function getID()
    {
        return $this->ID;
    }
    public function getNotificationSubject()
    {
        return $this->notificationSubject;
    }


    public function getNotificationText()
    {
        return $this->notificationText;
    }




protected function getAllNotifications(){
    return aBaseConnection::getInstance()->getConnection()->prepare("SELECT * FROM notification ");

}

    protected function setNotification($notificationSubject,$notificationText){
        return DataBaseConnection::getInstance()->getConnection()->query("INSERT INTO notification(notification _subject,notification _text)VALUES('$notificationSubject','$notificationText'");
    }

    protected function getUserNotifications(){
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT notification _subject ,notification _text
                                                                          FROM notification WHERE status = 1");
    }

    protected function deleteNotificationById($ID){
        return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM notification WHERE notification _id = $ID;");
    }

    
}
