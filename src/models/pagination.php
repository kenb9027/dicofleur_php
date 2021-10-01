<?php

function connectBddPagination()
{
    try {    // On se connecte à MySQL
        $pdo = new PDO('mysql:host=localhost;dbname=dicofleur;charset=utf8', 'dicofleur_admin', 'Patchou19!');
        return $pdo;
    } catch (Exception $e) {    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}

function getPaginationPlantsCount()
{
    $sql = "SELECT count(id) FROM plants";

    try {
        $pdo = connectBddPagination();
        $resultFoundRows = $pdo->query('SELECT count(id) FROM `plants`');
        $count = $resultFoundRows->fetchColumn();

        return $count;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}

function getPaginationPlants($limit = 10, $offset = 0)
{

    $sql = "SELECT id,name,specie,family,picture,description,created_on FROM plants WHERE 1 ORDER BY created_on DESC LIMIT $limit OFFSET $offset";

    try {
        $pdo = connectBddPagination();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $plants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $plants;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}
