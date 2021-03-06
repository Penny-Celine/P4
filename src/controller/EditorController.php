<?php
    
    namespace App\Controller;

    class EditorController
    {
        private $_manager;
        private $_commentDb;

        //private $_viewRenderer;

        public function __construct() {
            $this->_manager = new \App\Manager\PostManager();
            //$this->_viewRenderer = new \App\Services\ViewRenderer();

            $pageTitle = 'Edition de Chapitres';
            $pageDescription = 'Page réservée au rédacteur du site. Edition de chapitres du livre Billet pour l\'Alaska';
        }

        public function display() {

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update']) || $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']))
            {
               if (isset($_POST['update']))
               {
                   if (isset($_POST['id']))
                   {
                        $selectedChapterId = (int)$_POST['id'];
                        $chapterToChange = $this->_manager->getPost($selectedChapterId);
                        $chapterTitle = $chapterToChange->title();
                        $chapterContent = $chapterToChange->content();
                        $chapterId = $chapterToChange->id();
                        $errorMessage = 'Vous pouvez modifier le chapitre ayant l\'Id : '. $selectedChapterId;

                   } else
                   {
                       $errorMessage = 'Veuillez selectionner le chapitre à modifier avant de valider.';
                   }
               } else if (isset($_POST['delete']))
               {
                    if (isset($_POST['id']))
                    {
                        $chapterId = (int)$_POST['id'];
                        $chapterToDel = $this->_manager->getPost($chapterId);
                        $this->_manager->delete($chapterToDel);
                        $errorMessage = 'Vous avez bien supprimé le chapitre ayant pour Id : '. $chapterId;
                    }
               }
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-change']) && isset($_POST['newTitle']))
            {
                if (isset($_POST['newContent']))
                {
                    $now = date('Y-m-d H:i:s');
                    $newTitle = $_POST['newTitle'];
                    $newContent = $_POST['newContent'];
                    $chapterToChangeId = (int)$_POST['chapterId'];
                    $chapterToChange = $this->_manager->getPost($chapterToChangeId);
                    $chapterToChange->setTitle($newTitle);
                    $chapterToChange->setContent($newContent);
                    $chapterToChange->setModifiedDate($now);
                    $this->_manager->update($chapterToChange);
                    $errorMessage = 'Vos modifications ont bien été enregistrées.';
                } else
                {
                    $errorMessage = 'Le contenu ne peut pas être vide.';
                }
            }
            $chapters = $this->_manager->getList();

            ob_start();
            $bigTitle = 'Edition de Chapitres';
            
            require 'src/view/templates/headerTemplate.php';
            require 'src/view/editorViews/editorView.php';
            //$this->_viewRenderer->render('editorView.php', $chapters);
            $pageContent = ob_get_clean();
            require 'src/view/templates/layout.php';
        }


        public function createChapter() {
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-chapter']) && isset($_POST['content']) && $_POST['content']!='')
            {

                $today = date('Y-m-d');
                $chapter = new \App\Model\Post(['id' => 0,
                    'userId' => 1, 
                    'title' => $_POST['title'], 
                    'content' => $_POST['content'], 
                    'creationDate' => $today, 
                    'modifiedDate' => '', 
                    'enableComments' => "Oui",
                    'isDeleted' => "Non"]);

                if ($this->_manager->exists($_POST['title']))
                {
                    //modif de $errorMessage
                    $errorMessage = 'Ce titre est déjà pris';
                    unset($chapter);
                }
                else
                {
                    $this->_manager->add($chapter);
                    //modif de $errorMessage
                    $errorMessage = 'Votre chapitre a bien été enregistré';
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-chapter']) && isset($_POST['content']) && $_POST['content']=='')
            {
                unset($chapter);
                $errorMessage = 'Vous devez remplir le contenu du chapitre avant de l\'enregistrer.';
            }

            ob_start();
            $bigTitle = 'Nouveau Chapitre';
            require 'src/view/templates/headerTemplate.php';
            require 'src/view/editorViews/newChapterView.php';
            $pageContent = ob_get_clean();
            include 'src/view/templates/layout.php';

        }

        public function moderate() {

            $this->_commentDb = new \App\Manager\CommentManager();


            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update']) || $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']))
            {
               if (isset($_POST['update']))
               {
                   if (isset($_POST['id']))
                   {
                        $selectedCommentId = (int)$_POST['id'];
                        $commentToChange = $this->_commentDb->getComment($selectedCommentId);
                        $commentAuthor = $commentToChange->author();
                        $commentContent = $commentToChange->content();
                        $commentId = $commentToChange->id();
                        $errorMessage = 'Vous pouvez modifier le commentaire ayant l\'Id : '. $selectedCommentId;

                   } else
                   {
                       $errorMessage = 'Veuillez selectionner le commentaire à modifier avant de valider.';
                   }
               } else if (isset($_POST['delete']))
               {
                    if (isset($_POST['id']))
                    {
                        $commentId = (int)$_POST['id'];
                        $commentToDel = $this->_commentDb->getComment($commentId);
                        $this->_commentDb->delete($commentToDel);
                        $errorMessage = 'Vous avez bien supprimé le commentaire ayant pour Id : '. $commentId;
                    }
               }
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-change']))
            {
                if (isset($_POST['newContent']))
                {


                    $newContent = $_POST['newContent'];
                    $commentToChangeId = (int)$_POST['commentId'];
                    $commentToChange = $this->_commentDb->getComment($commentToChangeId);
                    $commentToChange->setContent($newContent);
                    $commentToChange->setIsModerated(true);
                    $this->_commentDb->update($commentToChange);
                    $errorMessage = 'Vos modifications ont bien été enregistrées.';
                } else
                {
                    $errorMessage = 'Le contenu ne peut pas être vide.';
                }  
            }

            $reportedComments = $this->_commentDb->getReportedList();

            ob_start();

            require 'src/view/templates/headerTemplate.php';
            require 'src/view/editorViews/moderationView.php';
            $pageContent = ob_get_clean();
            include 'src/view/templates/layout.php';          
        }
    }