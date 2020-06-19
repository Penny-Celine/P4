<?php

session_start();
require('vendor/autoload.php');
require('src/config/dev.php');

use App\Controller\HomeController;

$page = new HomeController();


if (isset($_GET['page'])) {
    switch ($_GET['page']) {
    
        case 'connexion' :
            $page->displayLoginPage();
            break;
        case 'inscription' :
            $page->displaySubscribePage();
            break;
        case 'chapitres':
            $page->displayChaptersList();
            break;
        case 'nouveau_chapitre' :
            $page->displayTextEditor();
            break;
        case 'chapitre':
            $page->displayAChapter();
            break;
        case 'moderation' :
            $page->displayCommentList();
            break;
        default:
            echo'Page non trouvée';
    
    }
}
else {
    $page->displayHomePage();
}


?>