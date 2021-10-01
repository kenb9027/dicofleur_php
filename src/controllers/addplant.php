<?php
$plantInfo = [];
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $plantInfo['name'] = htmlspecialchars(trim($_POST['name']));
} else {
    header('Location: ../../add-a-plant.php?msg=7');
    exit;
}
if (isset($_POST['specie']) && !empty($_POST['specie'])) {
    $plantInfo['specie'] = htmlspecialchars(trim($_POST['specie']));
} else {
    header('Location: ../../add-a-plant.php?msg=7');
    exit;
}
if (isset($_POST['family']) && !empty($_POST['family'])) {
    $plantInfo['family'] = htmlspecialchars(trim($_POST['family']));
} else {
    header('Location: ../../add-a-plant.php?msg=7');
    exit;
}
if (isset($_POST['description']) && !empty($_POST['description'])) {
    $plantInfo['description'] = htmlspecialchars(trim($_POST['description']));
} else {
    header('Location: ../../add-a-plant.php?msg=7');
    exit;
}
// Vérification de la taille du fichier
if (($_FILES['picture']['error'] === 1) || 
    ($_FILES['picture']['error'] === 2) || 
    ($_FILES['picture']['size'] > 5000000)) {
    header('Location: ../../add-a-plant.php&msg=14');
    exit;
}
// Vérification erreur 3 / 6 / 7 / 8
if (
    ($_FILES['picture']['error'] === 3) ||
    ($_FILES['picture']['error'] === 6) ||
    ($_FILES['picture']['error'] === 7) ||
    ($_FILES['picture']['error'] === 8)
) {
    header('Location: ../../add-a-plant.php?msg=8');
    exit;
}

// Vérification erreur 4 : pas de fichier
if ($_FILES['picture']['error'] === 4) {
    $plantInfo['picture'] = 'default.jpg';
    $extension = pathinfo($plantInfo['picture'], PATHINFO_EXTENSION);
    $basename = $plantInfo['picture'];
} else if ($_FILES['picture']['error'] === 0) {
    // Vérification de l'extension
    $authExtension = array('gif', 'jpg', 'jpe', 'jpeg', 'png');
    $picture = $_FILES['picture']['name'];
    $extension = pathinfo(strtolower($picture), PATHINFO_EXTENSION);
    if (!in_array($extension, $authExtension)) {
        header('Location: ../../add-a-plant.php?msg=15');
        exit;
    }
    $plantInfo['picture'] = $picture;
    $basename = $picture;
} else {
    header('Location: ../../add-a-plant.php?&msg=1');
};
require_once('../models/plants.php');
$id = addPlant($plantInfo);
if ($id != false) {
    if ($plantInfo['picture'] != 'default.jpg') {
        move_uploaded_file($_FILES['picture']['tmp_name'], '../../public/img/' . $id . '.' . $extension);
        changePicturePlant($id, $extension);
    }
    header('Location: ../../single.php?id=' . $id . '&msg=2');
    exit;
} else {
    header('Location: ../../add-a-plant.php?msg=7');
    exit;
}
