<?php
$user = [] ;
if ( isset($_POST['name']) && !empty($_POST['name']) ){
    $user['name'] = trim($_POST['name']);
}
else{
    header('Location: ../../login.php?msg=7');
    exit;
}
if ( isset($_POST['password']) && !empty($_POST['password']) ){
    $user['password'] = trim($_POST['password']);
}
else{
    header('Location: ../../login.php?msg=7');
    exit;
}
require_once('../models/users.php');
$verifiedUser = login($user);
if ($verifiedUser['bool'] === true){

    session_start();
    $idLogged = $verifiedUser['id'];
    $nameLogged = $verifiedUser['name'];
    $_SESSION['user'] = ['id' => $idLogged , 'name' => $nameLogged] ;

    header('Location: ../../adminpage.php?msg=5');
    exit;
}
else {
    header('Location: ../../login.php?msg=1');
    exit;
}