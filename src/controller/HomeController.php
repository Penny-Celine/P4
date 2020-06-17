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
        $orderedComments = $this->_commentDb->getCommentsOrdered($lastChapterId);

        ob_start();
        require 'src/view/headerTemplate.php';
        $lastChapterTitle = $this->_lastChapter->title();
        $lastChapterCreationDate = $this->_lastChapter->creationDate();
        $lastChapterContent = $this->_lastChapter->content();
        $this->comment();
        $this->reportComment();

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
            //ajout des commentaires            
            $this->comment();
            $this->reportComment();

            require 'src/view/chapterView.php';
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';
        }
    }

    public function displayCommentList()
    {
        $editorPage = new EditorController();
        $editorPage->moderate();
    }

    public function comment()
    {
        $this->_commentDb = new \App\Model\CommentManager();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post-comment']) && isset($_POST['content']) && $_POST['content']!='')
        {
            if (isset($_POST['author']) && $_POST['author']!='')
            {
                if (isset($_POST['chapterId']) && $_POST['chapterId']!='')
                {
                    $today = date('Y-m-d');
                    $comment = new \App\Model\Comment(['id' => 0,
                        'userId' => 2, 
                        'author' => htmlspecialchars($_POST['author']), 
                        'chapterId' => (int)$_POST['chapterId'],
                        'creationDate' => $today,
                        'content' => $_POST['content'], 
                        'isModerated' => 0, 
                        'isReported' => 0]);    
          
                    $this->_commentDb->add($comment);
                     $message = 'Votre commentaire a été ajouté avec succès !';
                 } else 
                {
                    $message = 'Un problème est survenu. Veuillez recommencer.';
                }
                    
            } else
            {
                $message = 'Veuillez entrer votre pseudo.';
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post-comment']) && isset($_POST['content']) && $_POST['content']=='')
        {
            unset($comment);
            $message = 'Vous ne pouvez pas poster un commentaire vide';
        }
    }

    public function reportComment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['report']))
               {
                    if (isset($_POST['commentId']))
                    {
                        $commentId = (int)$_POST['commentId'];
                        $commentToReport = $this->_commentDb->getComment($commentId);
                        $this->_commentDb->report($commentToReport);
                        $message = 'Vous avez bien signalé le commentaire ayant pour Id : '. $commentId;
                    }
               }
    }



}
