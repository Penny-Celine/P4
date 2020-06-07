<?php

namespace App\Controller;

class HomeController 
{


    public function displayHomePage()
    {
    
        include "src/view/homeView.php";

    }

    public function displayLoginPage()
    {
        $loginPage = new EditorController();

    }

    public function displayTextEditor()
    {
        $editorPage = new EditorController();
        $editorPage->createChapter();
    }

}
