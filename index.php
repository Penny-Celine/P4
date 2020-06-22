<?php

session_start();
require('vendor/autoload.php');
require('src/config/dev.php');

$page = new App\Controller\HomeController();
$editorPage = new App\Controller\EditorController();


if (isset($_GET['page'])) {
    switch ($_GET['page']) {

        case 'connexion' :
            $page->connect();
            break;
        case 'inscription' :
            $page->displaySubscribePage();
            break;
        case 'chapitres':
            $page->displayChaptersList();
            break;
        case 'nouveau_chapitre' :
            if (isset($_SESSION['privilege']) && $_SESSION['privilege']==='admin')
            {
                $editorPage->createChapter();
            } else 
            {
                header('Location : http://localhost/P4_Maupoux_Celine/index.php');
                exit();
                //$page->displayHomePage();
            }
            break;
        case 'chapitre':
            $page->displayAChapter();
            break;
        case 'moderation' :
            if (isset($_SESSION['privilege']) && $_SESSION['privilege']==='admin')
            {
                $editorPage->moderate();
            } else
            {
                header('Location: http://localhost/P4_Maupoux_Celine/');
                exit();
                //$page->displayHomePage();
            }
            //$page->displayCommentList();
            break;
        case 'deconnexion' :
            session_destroy();
            header('Location: http://localhost/P4_Maupoux_Celine/');
            exit();
            //$page->displayHomePage();
            break;
        case 'mentions' :
            $page->displayLegalPage();
            break;
        case 'contact' :
            $page->displayContactPage();
            break;
        default:
            echo'Page non trouvée';
    
    }
}
else {
    $page->displayHomePage();
}


?>