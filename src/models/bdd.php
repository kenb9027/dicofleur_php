<?php

function connectBdd()
{
    try {    // On se connecte à MySQL
        $pdo = new PDO('mysql:host=localhost;dbname=dicofleur;charset=utf8', 'dicofleur_admin', 'Patchou19!');
        return $pdo;
    } catch (Exception $e) {    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}

function connectBddOVH()
{
    try {    // On se connecte à MySQL
        $pdo = new PDO('mysql:host=kenbrokdicofleur.mysql.db;dbname=kenbrokdicofleur;charset=utf8', 'kenbrokdicofleur', 'Patchou190591');
        return $pdo;
    } catch (Exception $e) {    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}