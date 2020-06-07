<?php
    
    namespace App\Controller;

    class EditorController
    {
        public function __construct() {
            $manager = new \App\Model\PostManager();
            $chapters = $manager->getList();
            include 'src/view/editorView.php';
        }



        public function createChapter() {

            include 'src/view/newChapterView.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST')
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

                if ($manager->exists($_POST['title']))
                {
                    $message = "Ce titre est déjà pris";
                    unset($chapter);
                }
                else
                {
                    $manager->add($chapter);
                    $message = "Votre chapitre a bien été enregistré";
                }
            }
        }
    }

?>