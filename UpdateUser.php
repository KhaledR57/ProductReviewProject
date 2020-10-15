<?php
session_start();
if (!isset($_SESSION['userSession'])) {
    header("Location: Login.php");
    exit(0);
}
require_once 'Controller/UserController.php';

//display data on update form

if (isset($_GET['userID'])&&$_SESSION['userSession'][0]==$_GET['userID']) {
    require_once 'Model/User.php';
    $id = $_GET['userID'];
    $user = new UserController();
    $userInfo = $user->viewUser($id);
} else {
    header("Location: Index.php");
    exit(0);
}

if (isset($_POST['update_user'])) {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
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
        $res = $userController->editUser($id, $password, $profileImageNew, $firstName, $lastName);
    }

    elseif (empty($profileImage)) {
        $userController = new UserController();
        $res = $userController->editUser($id, $password, null, $firstName, $lastName);
    }


    if (!$is_ext && !empty($profileImage))
        echo '<div class="alert alert-danger" role="alert">Sorry Invalid File Extension!</div>';
    elseif (!$res)
        echo '<div class="alert alert-danger" role="alert">Sorry Insertion Failed!</div>';
    else {
        $_SESSION['userSession'] = [$id, $userInfo['user_name'], $password, $profileImageNew, $firstName, $lastName];
        header("Location: Index.php");
        exit(0);
    }
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Update Profile</title>

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
    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">BTATES For Genuine Rating</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Index.php">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="UpdateUser.php?userID=<?= $_SESSION["userSession"][0] ?>">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Compare
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Team
                    </a>
                </li>

                <li class="nav-item">
                    <button class="btn btn-danger" style="margin-top: 5px">
                        <a style="text-decoration: none;  color: white" href="Logout.php">
                            Log Out
                        </a>
                    </button>
                </li>

            </ul>
        </div>
    </div>
</nav>
<div class="container">

    <label style="margin-bottom: 5px" for="image">Profile Picture</label><br>
    <img  style="margin-bottom: 5px" class="img-thumbnail" src="upload/ProfileImages/<?= $userInfo['profile_image'] ?>" width="200px"
         height="200px" alt="image">
    <br>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <input id="image" type="file" name="profile_image">
            <small id="imageHelpBlock" class="form-text text-muted">
                Your uploaded image extension must be jpeg , jpg or png only.
            </small>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">First Name</label>
                <input value="<?= $userInfo['first_name'] ?>"  onkeyup="validName()" type="text" class="form-control"
                       id="firstname" name="first_name"
                       required>
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Last Name</label>
                <div class="input-group">
                    <input value="<?= $userInfo['last_name'] ?>" onkeyup="validName()" type="text" class="form-control"
                           id="lastname" name="last_name"
                           required>
                    <div class="input-group-prepend">
                        <span style="display: none" id='valid_last_name_message' class="input-group-text"></span>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input id="password" value="<?= $userInfo['password'] ?>" type="password" name="password" class="form-control" onchange="valid()" onkeyup='valid()'
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
            <input id="reg_btn" class="btn btn-primary" type="submit" value="Submit" name="update_user">
        </div>
    </form>
</div>

<script>
    function valid() {
        const password = /^[A-Za-z]\w{7,19}$/;
        if (document.getElementById('password').value.match(password)) {
            document.getElementById('valid_message').style.display = 'block';
            document.getElementById('valid_message').style.color = 'green';
            document.getElementById('valid_message').innerHTML = 'valid';
            if (document.getElementById('valid_message').innerHTML === 'valid'  && document.getElementById('valid_last_name_message').innerHTML === 'valid')
                document.getElementById("reg_btn").disabled = false;
        } else {
            document.getElementById('valid_message').style.display = 'block';
            document.getElementById('valid_message').style.color = 'red';
            document.getElementById('valid_message').innerHTML = 'not valid';
            document.getElementById("reg_btn").disabled = true;
            document.getElementById("confirm_password").disabled = true;
        }
    }


    function validName() {
        const name = /^[A-Za-z]+$/;
        if (document.getElementById('lastname').value.match(name) && document.getElementById('firstname').value.match(name) && document.getElementById('firstname').value.length >= 3 && document.getElementById('firstname').value.length <= 25 && document.getElementById('lastname').value.length >= 3 && document.getElementById('lastname').value.length <= 25) {
            document.getElementById('valid_last_name_message').style.display = 'block';
            document.getElementById('valid_last_name_message').style.color = 'green';
            document.getElementById('valid_last_name_message').innerHTML = 'valid';
            if ( document.getElementById('valid_message').innerHTML === 'valid'  && document.getElementById('valid_last_name_message').innerHTML === 'valid')
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
