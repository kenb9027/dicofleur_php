<?php 
    $pageTitle = 'DicoFleur | Evaluation' ;

    require_once('./src/models/plants.php');
    $plants = getAllPlants();

    if ( isset($_GET['game-size']) && 
        !empty($_GET['game-size']) &&
        ($_GET['game-size'] <= 800) && 
        ($_GET['game-size'] >= 1)
        )
        {
            if ($_GET['game-size'] >= count($plants)){
                $size = count($plants);
            }
            else{
                $size = $_GET['game-size'];

            }
        }
    else{
        if (count($plants) > 10 ){
            $size = 10 ;
        }
        else {
            $size = count($plants);

        }
    }

    shuffle($plants);
    $ans = array_slice($plants, 0, $size); 

    require_once('./templates/head.html');
    require_once('./templates/message-box.html');

    require_once('./templates/topbox-gameform.html');


    require_once('./templates/game-form.html');



    require_once('./templates/foot.html');
