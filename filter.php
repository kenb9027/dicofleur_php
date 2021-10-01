<?php
$pageTitle = 'DicoFleur | Rechercher';

require_once('./src/models/plants.php');
$families = getAllFamilies();


require_once('./templates/head.html');
require_once('./templates/message-box.html');
require_once('./templates/topbox-filter.html');

require_once('./templates/form-filterplant.html');


require_once('./templates/families-filter.html');


require_once('./templates/foot.html');
