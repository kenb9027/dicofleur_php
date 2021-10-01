<?php
session_start();
$userScore = 0;
$userNameScore = 0;
$userSpecieScore = 0;
$userFamilyScore = 0;
$_SESSION['results'] = [];
$_SESSION['size'] = $_POST['size'];
require_once('../models/plants.php');

for ($i = 0; $i < ($_POST['size']); $i++) {
    $plant = getOnePlant($_POST['id-' . $i]);
    $_SESSION['results'][$i]['plant'] = $plant;
    $_SESSION['results'][$i]['id'] = $plant['id'];
    if (strtolower($plant['name']) === strtolower(trim($_POST['name-' . $i]))) {
        $userScore++;
        $userNameScore++;
        $_SESSION['results'][$i]['name'] = 'success';
    }
    
    else {
        $explodedPlantNames = explode("/", $plant['name']) ;
        $_SESSION['results'][$i]['name'] = 'warning';
        foreach($explodedPlantNames as $exploName){
            if (strtolower(trim($exploName)) === strtolower(trim($_POST['name-' . $i]))){

                $userScore++;
                $userNameScore++;
                $_SESSION['results'][$i]['name'] = 'success';

            }
        }
    }
    if (strtolower($plant['specie']) === strtolower(trim($_POST['specie-' . $i]))) {
        $userScore++;
        $userSpecieScore++;

        $_SESSION['results'][$i]['specie'] = 'success';
    } else {
        $_SESSION['results'][$i]['specie'] = 'warning';
    }
    if (strtolower($plant['family']) === strtolower(trim($_POST['family-' . $i]))) {
        $userScore++;
        $userFamilyScore++;

        $_SESSION['results'][$i]['family'] = 'success';
    } else {
        $_SESSION['results'][$i]['family'] = 'warning';
    }
}

$_SESSION['score'] = $userScore;
$_SESSION['nameScore'] = $userNameScore;
$_SESSION['specieScore'] = $userSpecieScore;
$_SESSION['familyScore'] = $userFamilyScore;

header('Location: ../../game-form-results.php');
exit;
