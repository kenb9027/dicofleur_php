<?php
function connectBddUsers()
{
        try {    // On se connecte à MySQL
                $pdo = new PDO('mysql:host=localhost;dbname=dicofleur;charset=utf8', 'dicofleur_admin', 'Patchou19!');
                return $pdo;
        } catch (Exception $e) {    // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : ' . $e->getMessage());
        }
}

function addUser(array $userInfo)
{
        $sql = "INSERT INTO users (name, email, password) VALUES (:name , :email, :password)";
        try {
                $pdo = connectBddUsers();
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $userInfo['name']);
                $stmt->bindParam(':email', $userInfo['email']);
                $stmt->bindParam(':password', password_hash($userInfo['password'], PASSWORD_DEFAULT));


                return $stmt->execute();
        } catch (\Throwable $th) {
                header('Location: ./error.php?msg=1 ');
        }
}

function login($userInfo)
{
        $sql = "SELECT `id`, `name`, `email`, `password` FROM `users` WHERE name = :name ";
        try {
                $pdo = connectBddUsers();
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $userInfo['name']);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!password_verify($userInfo['password'], $res['password'])) {
                        header('Location: ../../login.php?msg=13 ');
                } else {
                        $res['bool'] = true;
                }
                return $res;
        } catch (\Throwable $th) {
                header('Location: ../../error.php?msg=1 ');
        }
}

function findAllUsers()
{
        $sql = "SELECT id, name, email, created_on FROM users WHERE 1 ORDER BY created_on ASC";
        try {
                $pdo = connectBddUsers();
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $users;
        } catch (\Throwable $th) {
                echo 'mince...';
                header('Location: ./error.php?msg=1 ');
        }


        $sql = "SELECT id,name,specie,family,picture,description,created_on FROM plants WHERE 1 ORDER BY created_on DESC";

        try {
                $pdo = connectBddUsers();
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $plants = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $plants;
        } catch (\Throwable $th) {
                header('Location: ../../error.php?msg=1 ');
        }
}
