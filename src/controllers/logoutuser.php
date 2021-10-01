<?php
// session_start();
if (isset($_SESSION['user'])){
    session_destroy();
    header('Location: ./index.php?msg=6');
    exit;

}
else{
    header('Location: ./error.php?msg=1');
    exit;
}
