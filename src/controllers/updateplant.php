<?php

$plantInfo = [];
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $plantInfo['id'] = $_POST['id'];
} else {
    header('Location: ../../index.php?msg=1');
    exit;
}
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $plantInfo['name'] = htmlspecialchars(trim($_POST['name']));
} else {
    header('Location: ../../single.php?id=' . $plantInfo['id'] . '&msg=7');
    exit;
}
if (isset($_POST['specie']) && !empty($_POST['specie'])) {
    $plantInfo['specie'] = htmlspecialchars(trim($_POST['specie']));
} else {
    header('Location: ../../single.php?id=' . $plantInfo['id'] . '&msg=7');
    exit;
}
if (isset($_POST['family']) && !empty($_POST['family'])) {
    $plantInfo['family'] = htmlspecialchars(trim($_POST['family']));
} else {
    header('Location: ../../single.php?id=' . $plantInfo['id'] . '&msg=7');
    exit;
}
if (isset($_POST['description']) && !empty($_POST['description'])) {
    $plantInfo['description'] = htmlspecialchars(trim($_POST['description']));
} else {
    header('Location: ../../single.php?id=' . $plantInfo['id'] . '&msg=7');
    exit;
}

// Vérification de la taille du fichier
if (($_FILES['picture']['error'] === 1) ||
    ($_FILES['picture']['error'] === 2) ||
    ($_FILES['picture']['size'] > 5000000)
) {
    header('Location: ../../single.php?id=' . $plantInfo['id'] . '&msg=14');
    exit;
}

// Vérification erreur 3 / 6 / 7 / 8
if (
    ($_FILES['picture']['error'] === 3) ||
    ($_FILES['picture']['error'] === 6) ||
    ($_FILES['picture']['error'] === 7) ||
    ($_FILES['picture']['error'] === 8)
) {
    header('Location: ../../single.php?id=' . $plantInfo['id'] . '&msg=8');
    exit;
}

// Si pas de fichier
if ($_FILES['picture']['error'] === 4) {
    $plantInfo['picture'] = $_POST['expicture'];
    $extension = strtolower(pathinfo($plantInfo['picture'], PATHINFO_EXTENSION));
    $basename = $plantInfo['picture'];

    // Si un fichier à été télécharger
} else if ($_FILES['picture']['error'] === 0) {
    // Vérification de l'extension
    $authExtension = array('gif', 'jpg', 'jpe', 'jpeg', 'png');
    $picture = $_FILES['picture']['name'];
    $extension = pathinfo(strtolower($picture), PATHINFO_EXTENSION);
    if (!in_array($extension, $authExtension)) {
        header('Location: ../../update-a-plant.php?id=' . $plantInfo['id'] . '&msg=15');
        exit;
    }
    $plantInfo['picture'] = $picture;
    $basename = $picture;

    // unlink('../../public/img/' . $plantInfo['id'] . '.' . $extension);
    // move_uploaded_file($_FILES['picture']['tmp_name'], '../../public/img/' . $plantInfo['id'] . '.' . $extension);
    // changePicturePlant($plantInfo['id'], $extension);
} else {
    header('Location: ../../single.php?id=' . $plantInfo['id'] . '&msg=1');
};

require_once('../models/plants.php');

if (updatePlant($plantInfo)) {
    $id = $plantInfo['id'];

    if ($_FILES['picture']['error'] === 0) {

        unlink('../../public/img/' . $plantInfo['id'] . '.' . $extension);
        move_uploaded_file($_FILES['picture']['tmp_name'], '../../public/img/' . $plantInfo['id'] . '.' . $extension);
        changePicturePlant($plantInfo['id'], $extension);
    }
    header('Location: ../../single.php?id=' . $id . '&msg=4');
    exit;
} else {
    header('Location: ../../single.php?id=' . $id . '&msg=1');
    exit;
}
