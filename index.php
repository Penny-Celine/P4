<?php

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
        default:
            throw new \Exception('404 : Page non trouvée');
    
    }
}
else {
    $page->displayHomePage();
}


?>