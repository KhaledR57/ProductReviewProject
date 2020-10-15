<?php

require_once 'DataBaseConnection.php';

class User
{
    private $ID;
    private $userName;
    private $password;
    private $createdAt;
    private $profileImage;
    private $firstName;
    private $lastName;
    private $isAdmin;


    private function __construct($ID, $userName, $password, $createdAt, $profileImage, $firstName, $lastName, $isAdmin)
    {
        $this->ID = $ID;
        $this->userName = $userName;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->profileImage = $profileImage;
        $this->firstName = $firstName;
            
        $this->lastName = $lastName;
        $this->isAdmin = $isAdmin;
    }


    public function getID()
    {
        return $this->ID;
    }


    public function getUserName()
    {
        return $this->userName;
    }


    public function getPassword()
    {
        return $this->password;
    }



    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function getProfileImage()
    {
        return $this->profileImage;
    }


    public function getFirstName()
    {
        return $this->firstName;
    }


    public function getLastName()
    {
        return $this->lastName;
    }


    public function getIsAdmin()
    {
        return $this->isAdmin;
    }



    protected function login($userName,$password){
        $res = DataBaseConnection::getInstance()->getConnection()->prepare("SELECT * FROM users WHERE user_name = ? AND password = ? ");
        $res->bind_param("ss", $userName, $password);
        $res->execute();
        $res->store_result();
        $res->bind_result($id, $name, $pass, $at,$proImage,$firstName,$lastName,$isAdmin);
        if($res->fetch())
            return new User($id, $name, $pass, $at,$proImage,$firstName,$lastName,$isAdmin);
        return null;
    }

    protected function setUser($userName, $password, $profileImageNew, $firstName, $lastName){
        return DataBaseConnection::getInstance()->getConnection()->query("INSERT INTO users(user_name,password,profile_image,first_name,last_name)VALUES('$userName','$password','$profileImageNew','$firstName','$lastName')");
    }

    protected function getAllUsers(){
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT * FROM users WHERE is_admin = false");
    }

    protected function deleteUser($id){
        return DataBaseConnection::getInstance()->getConnection()->query("DELETE FROM users WHERE ID = $id;");
    }

    protected function updateUser($id, $password, $profileImageNew, $firstName, $lastName)
    {
        if ($profileImageNew != null)
            return DataBaseConnection::getInstance()->getConnection()->query("UPDATE `users` SET `password` = '$password', `profile_image` = '$profileImageNew', `first_name` = '$firstName', `last_name` = '$lastName' WHERE `users`.`ID` = '$id';");
        else
            return DataBaseConnection::getInstance()->getConnection()->query("UPDATE `users` SET `password` = '$password', `first_name` = '$firstName', `last_name` = '$lastName' WHERE `users`.`ID` = '$id';");

    }

    protected function getUser($id){
        return DataBaseConnection::getInstance()->getConnection()->query("SELECT * FROM users WHERE ID = '$id' ")->fetch_assoc();
    }
}