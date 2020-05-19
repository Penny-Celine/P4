<?php

require('vendor/autoload.php');

use App\PageControl;

$page = new PageControl();


if (isset($_GET['page'])) {
    switch ($_GET['page']) {
    
        case 'connexion' :
            $loginPage = $page->displayLoginPage();
            break;
        case 'inscription' :
            $subscribePage = $page->displaySubscribePage();
            break;
        case 'chapitres':
            $chaptersPage = $page->displayChaptersList();
            break;
        default:
            throw new \Exception('404 : Page non trouvée');
    
    }
}
else {
    displayHomePage();
}


?>