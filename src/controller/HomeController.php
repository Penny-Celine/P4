<?php

namespace App\Controller;

class HomeController 
{
    private $_chapterDb;
    private $_lastChapter;



    public function displayHomePage()
    {
        $this->_chapterDb = new \App\Model\PostManager();
        $this->_lastChapter = $this->_chapterDb->getLastPost();
        ob_start();
        require 'src/view/headerTemplate.php';
        $lastChapterTitle = $this->_lastChapter->title();
        $lastChapterCreationDate = $this->_lastChapter->creationDate();
        $lastChapterContent = $this->_lastChapter->content();
        require 'src/view/homeView.php';
        $pageContent = ob_get_clean();
        include 'src/view/layout.php';

    }

    public function displayChaptersList()
    {
        $this->_chapterDb = new \App\Model\PostManager();
        ob_start();
            $chapters = $this->_chapterDb->getList();
            require 'src/view/headerTemplate.php';
                          
            require 'src/view/publicListView.php';
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';
    }

    public function displayLoginPage()
    {
        $editorPage = new EditorController();
        $editorPage->display();

    }

    public function displayTextEditor()
    {
        $editorPage = new EditorController();
        $editorPage->createChapter();
    }



}
