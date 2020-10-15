<?php
session_start();
require_once 'Controller/UserController.php';
if (isset($_SESSION['userSession'])) {
    header("Location: Index.php");
    exit(0);
} elseif (isset($_SESSION['adminSession'])) {
    header("Location: Admin.php");
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Sign In</title>

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
        #container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            margin-top: 10%;
        }
    </style>

</head>
<body>

<div id="container">
    <form method="post">
        <h1>Login</h1>
        <div class="form-group">
            <label>User Name</label>
            <input class="form-control" name="username" type="text" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="password" type="password" required>
        </div>
        <div class="form-group">
            <input name="btn_login" class="btn btn-primary" type="submit" value="Sign In">
        </div>
        <p>Do not have an account? <a href="Register.php">Register here</a>.</p>
        <?php
        if (isset($_POST['btn_login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userController = new UserController();
            $user = $userController->isExist($username, $password);

            if ($user) {
                if ($user->getIsAdmin() == 0) {
                    $_SESSION['userSession'] = [$user->getID(),$user->getUserName(),$user->getPassword(),$user->getProfileImage(),$user->getFirstName(),$user->getLastName(),$user->getIsAdmin()];
                    header("Location: Index.php");

                } elseif ($user->getIsAdmin() == 1) {
                    $_SESSION['adminSession'] = [$user->getID(),$user->getUserName(),$user->getPassword(),$user->getProfileImage(),$user->getFirstName(),$user->getLastName(),$user->getIsAdmin()];
                    header("Location: Admin.php");
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">User Name or Password Is not Correct!</div>';
            }

        }
        ?>
    </form>

</div>
</body>
</html>