<?php

namespace App\Controller;

class HomeController 
{
    private $_chapterDb;
    private $_lastChapter;
    private $_commentDb;



    public function displayHomePage()
    {
        $this->_chapterDb = new \App\Model\PostManager();
        $this->_commentDb = new \App\Model\CommentManager();
        $this->_lastChapter = $this->_chapterDb->getLastPost();
        $lastChapterId = (int)$this->_lastChapter->id();
        ob_start();
        require 'src/view/headerTemplate.php';
        $lastChapterTitle = $this->_lastChapter->title();
        $lastChapterCreationDate = $this->_lastChapter->creationDate();
        $lastChapterContent = $this->_lastChapter->content();
        $orderedComments = $this->_commentDb->getCommentsOrdered($lastChapterId);
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

    public function displayAChapter()
    {
        if (isset($_GET['id']))
        {
            $this->_chapterDb = new \App\Model\PostManager();
            $this->_commentDb = new \App\Model\CommentManager();
            
            ob_start();
            $chapterId = (int)$_GET['id'];
            $orderedComments = $this->_commentDb->getCommentsOrdered($chapterId);
            $chapter = $this->_chapterDb->getPost($chapterId);
            $title = $chapter->title();
            $creationDate = $chapter->creationDate();
            $modifiedDate = $chapter->modifiedDate();
            $content = $chapter->content();
            require 'src/view/headerTemplate.php';                              
            require 'src/view/chapterView.php';
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';
        }
    }



}
