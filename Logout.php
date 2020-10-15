<?php
session_start();
session_destroy();
$_SESSION['adminSession'] = [];
$_SESSION['userSession'] = [];

header("Location: Login.php");