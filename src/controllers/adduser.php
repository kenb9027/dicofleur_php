<?php
require_once('../models/users.php');
$newUser = [];
$allUsers = findAllUsers();

foreach ($allUsers as $oldUser ) {
    if (
        trim($oldUser['name']) === trim($_POST['name']) ||
        trim($oldUser['email']) === trim($_POST['email'])
    ){
        header('Location: ../../add-a-user.php?msg=9');
        exit;
    }
}

if (isset($_POST['name']) && !empty($_POST['name'])) {
    $newUser['name'] =  htmlentities(trim($_POST['name']), ENT_QUOTES);
} else {
    header('Location: ../../add-a-user.php?msg=7');
    exit;
}
if (isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $newUser['email'] =  htmlentities(trim($_POST['email']), ENT_QUOTES);
} else {
    header('Location: ../../add-a-user.php?msg=7');
    exit;
}
if ((isset($_POST['password']) && !empty($_POST['password']))  &&
    (isset($_POST['password2']) && !empty($_POST['password2'])) &&
    $_POST['password'] === $_POST['password2']
) {
    $newUser['password'] = $_POST['password'];
} else {
    header('Location: ../../add-a-user.php?msg=10');
    exit;
}

if (addUser($newUser)) {

    header('Location: ../../index.php?msg=3');
    exit;
} else {
    header('Location: ../../add-a-user.php?msg=1');
    exit;
}


