<?php
    
    namespace App\Controller;

    class EditorController
    {
        private $_manager;
        public $message;

        public function __construct() {
            $this->_manager = new \App\Model\PostManager();
            $this->_viewRenderer = new \App\Services\ViewRenderer();

            $pageTitle = 'Edition de Chapitres';
            $pageDescription = 'Page réservée au rédacteur du site. Edition de chapitres du livre Billet pour l\'Alaska';
        }

        public function display() {
            ob_start();
            $bigTitle = 'Edition de Chapitres';
            $chapters = $this->_manager->getList();
            require 'src/view/headerTemplate.php';
            $this->_viewRenderer->render('editorView.php', $chapters);
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
               $stringPost = implode("", $_POST);
               if (preg_match('#^save-chapter(\d)+$#', $stringPost))
               {
                   echo 'trouvé'; 
               }
            }

        }


        public function createChapter() {

            ob_start();
            $bigTitle = 'Nouveau Chapitre';
            require 'src/view/headerTemplate.php';
            require 'src/view/newChapterView.php';
            //récupération de $message qui ne fonctionne pas actuellement


            
            $pageContent = ob_get_clean();
            include 'src/view/layout.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-chapter']) && isset($_POST['content']))
            {

                $today = date('Y-m-d');
                $chapter = new \App\Model\Post(['id' => 0,
                    'userId' => 1, 
                    'title' => $_POST['title'], 
                    'content' => $_POST['content'], 
                    'creationDate' => $today, 
                    'modifiedDate' => '', 
                    'enableComments' => true,
                    'isDeleted' => false]);

                if ($this->_manager->exists($_POST['title']))
                {
                    //modif de $message
                    $message = 'Ce titre est déjà pris';
                    unset($chapter);
                    echo 'Message : Ce titre est déjà pris.';
                }
                else
                {
                    $this->_manager->add($chapter);
                    //modif de $message
                    $message = 'Votre chapitre a bien été enregistré';
                    echo 'Message : Votre chapitre a bien été enregistré.';
                }
            }
        }
    }