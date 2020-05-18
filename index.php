<?php

require('controller/homeController.php');

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
    
        case 'connexion' :
            displayLoginPage();
            break;
        case 'inscription' :
            displaySubscribePage();
            break;
        case 'chapitres':
            displayChaptersList();
            break;
        default:
            throw new Exception('404 : Page non trouvée');
    
    }
}
else {
    displayHomePage();
}


?>