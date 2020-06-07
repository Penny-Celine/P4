<?php
    
    namespace App\Controller;

    class EditorController
    {
        private $_manager;
        private $_message;

        public function __construct() {
            $this->_manager = new \App\Model\PostManager();
            
            $pageTitle = 'Edition de Chapitres';
            $pageDescription = 'Page réservée au rédacteur du site. Edition de chapitres du livre Billet pour l\'Alaska';
        }

        public function display() {

            ob_start();
            $chapters = $this->_manager->getList();
            require 'src/view/editorView.php';
            $pageContent = ob_get_clean();
            require_once 'src/view/layout.php';

        }


        public function createChapter() {

            ob_start();
            $chapters = $this->_manager->getList();
            require 'src/view/editorView.php';
            require 'src/view/newChapterView.php';
            echo '<p> Message :' . $this->_message . '</p>';
            $pageContent = ob_get_clean();
            include_once 'src/view/layout.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-chapter']))
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
                    $this->_message = 'Ce titre est déjà pris';
                    unset($chapter);
                    echo 'jusqu\'ici tout va bien';
                }
                else
                {
                    $this->_manager->add($chapter);
                    $this->_message = 'Votre chapitre a bien été enregistré';
                    echo 'pourtant ça marche';
                }
            }
        }
    }

?>