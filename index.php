<?php

require('vendor/autoload.php');

use App\Controller\PageController;

$page = new PageController();


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
        default:
            throw new \Exception('404 : Page non trouvée');
    
    }
}
else {
    $page->displayHomePage();
}


?>