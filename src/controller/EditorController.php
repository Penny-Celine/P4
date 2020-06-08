<?php
    
    namespace App\Controller;

    class EditorController
    {
        private $_manager;
        public $message;

        public function __construct() {
            $this->_manager = new \App\Model\PostManager();

            
            $pageTitle = 'Edition de Chapitres';
            $pageDescription = 'Page réservée au rédacteur du site. Edition de chapitres du livre Billet pour l\'Alaska';
        }

        public function display() {

            ob_start();
            $chapters = $this->_manager->getList();
                ob_start();
                for ($i=0; isset($chapters[$i]); $i ++)
                {
                    if (!$chapters[$i]->isDeleted() || $chapters[$i]->isDeleted() === 0)
                    {
                        echo  '<tr>
                            <td><input type="submit" value="Modifier" name="change-chapter' . $chapters[$i]->id() .'" />
                            <td>' . $chapters[$i]->id() . '</td>
                            <td>' . $chapters[$i]->userId() . '</td>
                            <td>' . $chapters[$i]->title() . '</td>
                            <td>' . $chapters[$i]->content() . '</td>
                            <td>' . $chapters[$i]->creationDate() . '</td>
                            <td>' . $chapters[$i]->modifiedDate() . '</td>
                            <td>' . $chapters[$i]->enableComments() . '</td>
                        </tr>';
                    } else 
                    {
                        echo '<tr class=\'deleted\'>
                            <td> Supprimé </td>
                            <td>' . $chapters[$i]->id() . '</td>
                            <td>' . $chapters[$i]->userId() . '</td>
                            <td>' . $chapters[$i]->title() . '</td>
                            <td>' . $chapters[$i]->content() . '</td>
                            <td>' . $chapters[$i]->creationDate() . '</td>
                            <td>' . $chapters[$i]->modifiedDate() . '</td>
                            <td>' . $chapters[$i]->enableComments() . '</td>
                        </tr>';
                    }
                }
                $listTable = ob_get_clean();              
            require 'src/view/editorView.php';
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';
            var_dump($_POST);

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-chapter']))
            {
                
            }

        }


        public function createChapter() {

            $chapters = $this->_manager->getList();
            ob_start();
            for ($i=0; isset($chapters[$i]); $i ++)
            {
                if (!$chapters[$i]->isDeleted() || $chapters[$i]->isDeleted() === 0)
                {
                    echo  '<tr>
                        <td><input type="submit" value="Modifier" name="change-chapter' . $chapters[$i]->id() .'" />
                        <td>' . $chapters[$i]->id() . '</td>
                        <td>' . $chapters[$i]->userId() . '</td>
                        <td>' . $chapters[$i]->title() . '</td>
                        <td>' . $chapters[$i]->content() . '</td>
                        <td>' . $chapters[$i]->creationDate() . '</td>
                        <td>' . $chapters[$i]->modifiedDate() . '</td>
                        <td>' . $chapters[$i]->enableComments() . '</td>
                    </tr>';
                } else 
                {
                    echo '<tr class=\'deleted\'>
                        <td> Supprimé </td>
                        <td>' . $chapters[$i]->id() . '</td>
                        <td>' . $chapters[$i]->userId() . '</td>
                        <td>' . $chapters[$i]->title() . '</td>
                        <td>' . $chapters[$i]->content() . '</td>
                        <td>' . $chapters[$i]->creationDate() . '</td>
                        <td>' . $chapters[$i]->modifiedDate() . '</td>
                        <td>' . $chapters[$i]->enableComments() . '</td>
                    </tr>';
                }
            }
            $listTable = ob_get_clean();
            require 'src/view/editorView.php';
            require 'src/view/newChapterView.php';
            //récupération de $_message qui ne fonctionne pas actuellement
            echo '<p> Message :' . $this->message . '</p>';
            $pageContent = ob_get_clean();
            include 'src/view/layout.php';

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
                    //modif de $_message
                    $this->message = 'Ce titre est déjà pris';
                    unset($chapter);
                    echo 'jusqu\'ici tout va bien';
                }
                else
                {
                    $this->_manager->add($chapter);
                    //modif de $_message
                    $this->message = 'Votre chapitre a bien été enregistré';
                    echo 'pourtant ça marche';
                }
            }
        }
    }