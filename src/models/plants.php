<?php

function connectBddPlants()
{
    try {    // On se connecte à MySQL
        $pdo = new PDO('mysql:host=localhost;dbname=dicofleur;charset=utf8', 'dicofleur_admin', 'Patchou19!');
        return $pdo;
    } catch (Exception $e) {    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}

function getAllPlants()
{

    $sql = "SELECT id,name,specie,family,picture,description,created_on FROM plants WHERE 1 ORDER BY created_on DESC";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $plants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $plants;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}
function getOnePlant($id)
{

    $sql = "SELECT id,name,specie,family,picture,description,created_on FROM plants WHERE id= :id ";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $plant = $stmt->fetch(PDO::FETCH_ASSOC);
        return $plant;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}

function addPlant(array $plantInfo)
{
    $sql = "INSERT INTO plants (name,specie,family,picture,description) VALUES ( :name , :specie , :family , :picture , :description)";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $plantInfo['name']);
        $stmt->bindParam(':specie', $plantInfo['specie']);
        $stmt->bindParam(':family', $plantInfo['family']);
        $stmt->bindParam(':picture', $plantInfo['picture']);
        $stmt->bindParam(':description', $plantInfo['description']);

        if ($stmt->execute()){
            return $pdo->lastInsertId();
        }
        else{
            return false;
        }
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}

function deletePlant($id)
{
    $sql = "DELETE FROM plants WHERE id= :id ";
    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}

function updatePlant($updateInfo)
{
    $sql = "UPDATE `plants` 
    SET `name`= :name ,`specie`= :specie ,`family`= :family ,`description`= :description,`picture`= :picture 
    WHERE id= :id";
    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $updateInfo['id']);
        $stmt->bindParam(':name', $updateInfo['name']);
        $stmt->bindParam(':specie', $updateInfo['specie']);
        $stmt->bindParam(':family', $updateInfo['family']);
        $stmt->bindParam(':description', $updateInfo['description']);
        $stmt->bindParam(':picture', $updateInfo['picture']);
        return $stmt->execute();
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}
function filterPlants($filterInfos)
{
    $sql = "SELECT id, name, specie, family, description, picture, created_on
            FROM plants 
            WHERE name LIKE :name
            AND specie LIKE :specie
            AND family LIKE :family
            ORDER BY created_on DESC";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', "%{$filterInfos['name']}%");
        $stmt->bindValue(':specie', "%{$filterInfos['specie']}%");
        $stmt->bindValue(':family', "%{$filterInfos['family']}%");
        $stmt->execute();

        $plants = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return $plants;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}


function getLastPlants($number)
{

    $sql = "SELECT * FROM plants ORDER BY created_on DESC LIMIT " . $number;

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $cards  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cards;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}

function getNextPlant($id)
{

    $sql = "SELECT id FROM plants ORDER BY id DESC";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $idsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }

    if ($id === $idsList[0]['id']) {
        $nextPlant = null;
        return $nextPlant;
    }

    $sql2 = "SELECT id , name FROM plants WHERE id > :id ORDER BY id ASC LIMIT 1";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql2);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $nextPlant = $stmt->fetch(PDO::FETCH_ASSOC);
        return $nextPlant;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}

function getPreviousPlant($id)
{

    $sql = "SELECT id FROM plants ORDER BY id ASC";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $idsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }

    if ($id === $idsList[0]['id']) {
        $previousPlant = null;
        return $previousPlant;
    }

    $sql2 = "SELECT id , name FROM plants WHERE id < :id ORDER BY id DESC LIMIT 1";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql2);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $previousPlant = $stmt->fetch(PDO::FETCH_ASSOC);
        return $previousPlant;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}
function changePicturePlant($id, $extension)
{
    $newLink = $id . '.' . $extension;

    $sql = "UPDATE `plants` 
    SET `picture`= :picture 
    WHERE id= :id";
    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':picture', $newLink);
        return $stmt->execute();
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}
function getAllFamilies()
{

    $sql = "SELECT DISTINCT family FROM plants ";

    try {
        $pdo = connectBddPlants();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $families = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $families;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}