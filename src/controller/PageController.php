<?php

namespace App\Controller;

class PageController 
{


    public function displayHomePage()
    {
    
        include "src/view/homeView.php";

    }

    public function displayLoginPage()
    {
        include "src/view/editorView.php";
    }

}
