<?php
session_start();
require_once 'Controller/UserController.php';

if (isset($_POST['btn_reg'])) {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $userName = $_POST['user_name'];
    $password = $_POST['password'];

    $profileImage = $_FILES['profile_image']['name'];
    $tempProfileImage = $_FILES['profile_image']['tmp_name'];

    $ext = explode('.', $profileImage);
    $profileImageExt = end($ext);
    $profileImageExt = strtolower($profileImageExt);

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($profileImageExt, $allowed)) {
        $profileImageNew = uniqid('', true) . "." . $profileImageExt;
        move_uploaded_file($tempProfileImage, "upload/ProfileImages/$profileImageNew");
        $is_ext = true;
    } else {
        $profileImageNew = "default3.png";
        $is_ext = false;
    }

    if (!empty($profileImage) && $is_ext) {
        $userController = new UserController();
        $res = $userController->createUserI($userName, $password, $profileImageNew, $firstName, $lastName);
    } elseif (empty($profileImage)) {
        $userController = new UserController();
        $res = $userController->createUserNoI($userName, $password, $firstName, $lastName);
    }


    if (!$is_ext && !empty($profileImage))
        echo '<div class="alert alert-danger" role="alert">Sorry Invalid File Extension!</div>';
    elseif (!$res)
        echo '<div class="alert alert-danger" role="alert">Sorry User Name Must Be Unique!</div>';
    else {
        if (isset($_SESSION['adminSession'])) {
            header("Location: Register.php");
            exit(0);
        } else {
            $_SESSION['userSession'] = [DataBaseConnection::getInstance()->getConnection()->insert_id, $userName, $password, $profileImageNew, $firstName, $lastName];
            header("Location: Index.php");
            exit(0);
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Sign Up</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="sidebar.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
            crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
            integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
            crossorigin="anonymous"></script>
    <style type="text/css">

    </style>

</head>
<body>
<div class="container">
    <div class="form">
        <H1 style="text-align: center;">Sign Up</H1><br>
        <form method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">First Name</label>
                    <input onkeyup="validName()" type="text" class="form-control" id="firstname" name="first_name"
                           required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Last Name</label>
                    <div class="input-group">
                        <input onkeyup="validName()" type="text" class="form-control" id="lastname" name="last_name"
                               required>
                        <div class="input-group-prepend">
                            <span style="display: none" id='valid_last_name_message' class="input-group-text"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="username">User Name</label>
                <div class="input-group">
                    <input type="text" id="username" name="user_name" class="form-control" onkeyup="validUserName()"
                           required>
                    <div class="input-group-prepend">
                        <span style="display: none" id='valid_name_message' class="input-group-text"></span>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" class="form-control" onkeyup='valid()'
                           required>
                    <div class="input-group-prepend">
                        <span style="display: none" id='valid_message' class="input-group-text"></span>
                    </div>
                </div>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Your password must be 8-20 characters long, contain letters , numbers and underscore only and first
                    character must be a letter.
                </small>
            </div>


            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="input-group">
                    <input id="confirm_password" type="password" name="confirm_password" class="form-control"
                           onkeyup='equal()' required disabled>
                    <div class="input-group-prepend">
                        <span style="display: none" id='match_message' class="input-group-text"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Profile Picture</label><br>
                <input id="image" type="file" name="profile_image">
                <small id="imageHelpBlock" class="form-text text-muted">
                    Your uploaded image extension must be jpeg , jpg or png only.
                </small>
            </div>


            <p style="float: right">Already have an account? <a href="Login.php">Login here</a>.</p>
            <div class="form-group">
                <input id="reg_btn" class="btn btn-primary" type="submit" value="Submit" name="btn_reg">
            </div>
        </form>
    </div>
</div>
<script>
    function equal() {
        if (document.getElementById('password').value === document.getElementById('confirm_password').value) {
            document.getElementById('match_message').style.display = 'block';
            document.getElementById('match_message').style.color = 'green';
            document.getElementById('match_message').innerHTML = 'matching';
            if (document.getElementById('match_message').innerHTML === 'matching' && document.getElementById('valid_message').innerHTML === 'valid' && document.getElementById('valid_name_message').innerHTML === 'valid' && document.getElementById('valid_last_name_message').innerHTML === 'valid')
                document.getElementById("reg_btn").disabled = false;
        } else {
            document.getElementById('match_message').style.display = 'block';
            document.getElementById('match_message').style.color = 'red';
            document.getElementById('match_message').innerHTML = 'not matching';
            document.getElementById("reg_btn").disabled = true;
        }
    }

    function valid() {
        const password = /^[A-Za-z]\w{7,19}$/;
        if (document.getElementById('password').value.match(password)) {
            document.getElementById('valid_message').style.display = 'block';
            document.getElementById('valid_message').style.color = 'green';
            document.getElementById('valid_message').innerHTML = 'valid';
            document.getElementById("confirm_password").disabled = false;
            if (document.getElementById('match_message').innerHTML === 'matching' && document.getElementById('valid_message').innerHTML === 'valid' && document.getElementById('valid_name_message').innerHTML === 'valid' && document.getElementById('valid_last_name_message').innerHTML === 'valid')
                document.getElementById("reg_btn").disabled = false;
        } else {
            document.getElementById('valid_message').style.display = 'block';
            document.getElementById('valid_message').style.color = 'red';
            document.getElementById('valid_message').innerHTML = 'not valid';
            document.getElementById("reg_btn").disabled = true;
            document.getElementById("confirm_password").disabled = true;
        }
    }

    function validUserName() {
        const name = /^[A-Za-z]\w{3,19}$/;
        if (document.getElementById('username').value.match(name)) {
            document.getElementById('valid_name_message').style.display = 'block';
            document.getElementById('valid_name_message').style.color = 'green';
            document.getElementById('valid_name_message').innerHTML = 'valid';
            if (document.getElementById('match_message').innerHTML === 'matching' && document.getElementById('valid_message').innerHTML === 'valid' && document.getElementById('valid_name_message').innerHTML === 'valid' && document.getElementById('valid_last_name_message').innerHTML === 'valid')
                document.getElementById("reg_btn").disabled = false;
        } else {
            document.getElementById('valid_name_message').style.display = 'block';
            document.getElementById('valid_name_message').style.color = 'red';
            document.getElementById('valid_name_message').innerHTML = 'not valid';
            document.getElementById("reg_btn").disabled = true;
        }
    }

    function validName() {
        const name = /^[A-Za-z]+$/;
        if (document.getElementById('lastname').value.match(name) && document.getElementById('firstname').value.match(name) && document.getElementById('firstname').value.length >= 3 && document.getElementById('firstname').value.length <= 25 && document.getElementById('lastname').value.length >= 3 && document.getElementById('lastname').value.length <= 25) {
            document.getElementById('valid_last_name_message').style.display = 'block';
            document.getElementById('valid_last_name_message').style.color = 'green';
            document.getElementById('valid_last_name_message').innerHTML = 'valid';
            if (document.getElementById('match_message').innerHTML === 'matching' && document.getElementById('valid_message').innerHTML === 'valid' && document.getElementById('valid_name_message').innerHTML === 'valid' && document.getElementById('valid_last_name_message').innerHTML === 'valid')
                document.getElementById("reg_btn").disabled = false;
        } else {
            document.getElementById('valid_last_name_message').style.display = 'block';
            document.getElementById('valid_last_name_message').style.color = 'red';
            document.getElementById('valid_last_name_message').innerHTML = 'not valid';
            document.getElementById("reg_btn").disabled = true;
        }
    }

</script>
</body>
</html>
