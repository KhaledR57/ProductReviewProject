<?php

require_once 'Model/User.php';

class UserView extends User
{
    public function __construct(){}

    public function showUsers()
    {
        $users = $this->getAllUsers();
        foreach ($users as $user):?>
            <tr>
                <td><?= $user['ID'] ?></td>
                <td><img class="img-thumbnail" src="upload/ProfileImages/<?= $user['profile_image'] ?>" alt=""></td>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td><?= $user['user_name'] ?></td>
                <td><?= $user['password'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td><a href="Delete.php?userID=<?= $user['ID'] ?>" class="btn btn-danger col-12">Delete</a></td>
            </tr>
        <?php
        endforeach;
    }
}
?>
