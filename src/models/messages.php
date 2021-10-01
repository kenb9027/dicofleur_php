<?php
function connectBddMessages()
{
    try {    // On se connecte à MySQL
        $pdo = new PDO('mysql:host=localhost;dbname=dicofleur;charset=utf8', 'dicofleur_admin', 'Patchou19!');
        return $pdo;
    } catch (Exception $e) {    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}

function getInfosMessage($id)
{

    $sql = "SELECT id,message,class ,created_on FROM messages WHERE id= :id ";

    try {
        $pdo = connectBddMessages();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $message = $stmt->fetch(PDO::FETCH_ASSOC);
        return $message;
    } catch (\Throwable $th) {
        header('Location: ../../error.php?msg=1 ');
    }
}
