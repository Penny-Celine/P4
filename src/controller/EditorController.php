<?php
    
    namespace App\Controller;

    class EditorController
    {
        private $_manager;
        //private $_viewRenderer;

        public function __construct() {
            $this->_manager = new \App\Model\PostManager();
            //$this->_viewRenderer = new \App\Services\ViewRenderer();

            $pageTitle = 'Edition de Chapitres';
            $pageDescription = 'Page réservée au rédacteur du site. Edition de chapitres du livre Billet pour l\'Alaska';
        }

        public function display() {
            $chapters = $this->_manager->getList();
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
                        $message = 'Vous pouvez modifier le chapitre ayant l\'Id : '. $selectedChapterId;

                   } else
                   {
                       $message = 'Veuillez selectionner le chapitre à modifier avant de valider.';
                   }
               } else if (isset($_POST['delete']))
               {
                    if (isset($_POST['id']))
                    {
                        $chapterId = (int)$_POST['id'];
                        $chapterToDel = $this->_manager->getPost($chapterId);
                        $this->_manager->delete($chapterToDel);
                        $message = 'Vous avez bien supprimé le chapitre ayant pour Id : '. $chapterId;
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
                    $message = 'Vos modifications ont bien été enregistrées.';
                } else
                {
                    $message = 'Le contenu ne peut pas être vide.';
                }  
            }

            ob_start();
            $bigTitle = 'Edition de Chapitres';
            
            require 'src/view/headerTemplate.php';
            require 'src/view/editorView.php';
            //$this->_viewRenderer->render('editorView.php', $chapters);
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';
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
                    //modif de $message
                    $message = 'Ce titre est déjà pris';
                    unset($chapter);
                }
                else
                {
                    $this->_manager->add($chapter);
                    //modif de $message
                    $message = 'Votre chapitre a bien été enregistré';
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-chapter']) && isset($_POST['content']) && $_POST['content']=='')
            {
                unset($chapter);
                $message = 'Vous devez remplir le contenu du chapitre avant de l\'enregistrer.';
            }

            ob_start();
            $bigTitle = 'Nouveau Chapitre';
            require 'src/view/headerTemplate.php';
            require 'src/view/newChapterView.php';
            $pageContent = ob_get_clean();
            include 'src/view/layout.php';

        }
    }