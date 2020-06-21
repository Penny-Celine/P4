<?php

namespace App\Controller;

class HomeController 
{
    private $_chapterDb;
    private $_lastChapter;
    private $_commentDb;
    private $_userDb;



    public function displayHomePage()
    {
        $this->_chapterDb = new \App\Model\PostManager();
        $this->_commentDb = new \App\Model\CommentManager();
        $this->_userDb = new \App\Model\UserManager();
        $this->_lastChapter = $this->_chapterDb->getLastPost();
        $this->comment();
        $this->reportComment();
        $lastChapterId = (int)$this->_lastChapter->id();
        $orderedComments = $this->_commentDb->getCommentsOrdered($lastChapterId);

        ob_start();
            require 'src/view/headerTemplate.php';
            $lastChapterTitle = $this->_lastChapter->title();
            $lastChapterCreationDate = $this->_lastChapter->creationDate();
            $lastChapterContent = $this->_lastChapter->content();
            $chapterId = $this->_lastChapter->id();
            require 'src/view/homeView.php';
        $pageContent = ob_get_clean();
        require 'src/view/layout.php';

    }

    public function displayChaptersList()
    {
        if (isset($_SESSION['privilege']) && $_SESSION['privilege'] === 'admin')
        {
            $editorPage = new EditorController();
            $editorPage->display();
        } else
        {
            $this->_chapterDb = new \App\Model\PostManager();
            ob_start();
                $chapters = $this->_chapterDb->getList();
                require 'src/view/headerTemplate.php';
                require 'src/view/publicListView.php';
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';
        }

    }

    public function displayLoginPage()
    {
 
        $this->connect();   

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
            $this->comment();
            $this->reportComment();
            
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
                $this->_userDb = new \App\Model\UserManager();
                if (isset($_SESSION['user']) && $_SESSION['user'] === $_POST['author'] && $this->_userDb->exists($_POST['author']))
                {
                    $author = $this->_userDb->getUser($_POST['author']);
                    $userId = $author->id();
                } else
                {
                    $userId = 2;
                }
                if (isset($_POST['chapterId']) && $_POST['chapterId']!='')
                {
                    $today = date('Y-m-d');
                    $comment = new \App\Model\Comment(['id' => 0,
                        'userId' => $userId, 
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

    public function connect()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connect']))
        {
            if (isset($_POST['pseudo']) && isset($_POST['password']))
            {
                $pseudo = htmlSpecialChars($_POST['pseudo']);
                $passwordToTest = $_POST['password'];
                $this->_userDb = new \App\Model\UserManager();
                if ($this->_userDb->exists($pseudo))
                {
                    $connectingUser = $this->_userDb->getUser($pseudo);
                    $passToVerif = password_verify($passwordToTest, $connectingUser->password());
                    if ($passToVerif)
                    {
                        $_SESSION['user'] = $pseudo;
                        $_SESSION['privilege'] = $connectingUser->privilege();
                        $message = 'Connexion réussie ! Bienvenue '.$pseudo.' !';
                        $this->displayHomePage();
                    }
                    else
                    {
                        //Seul le "echo" est récupéré pour l'instant
                        $message =  'Identifiant ou mot de passe incorrect';
                        echo 'Identifiant ou mot de passe incorrect';
                        ob_start();
                            $bigTitle = 'Connexion';
                            require 'src/view/headerTemplate.php';
                            require 'src/view/loginView.php';
                        $pageContent = ob_get_clean();
                        require 'src/view/layout.php';
                    }
                }
            }
        } else if (isset($_SESSION['user']) && isset($_SESSION['privilege']))
        {
            $this->displayHomePage();
        } else        
        {
            ob_start();
                $bigTitle = 'Connexion';
                require 'src/view/headerTemplate.php';
                require 'src/view/loginView.php';
            $pageContent = ob_get_clean();
            require 'src/view/layout.php';
        }
    }
    public function displaySubscribePage()
    {
        $this->_userDb = new \App\Model\UserManager();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subscribe']))
        {
            if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $_POST['email']))
            {
                if ($_POST['password'] === $_POST['password2'])
                {
                    $today = date('Y-m-d');
                    $newUser = new \App\Model\User(['id' => 0,
                        'name' => $_POST['name'], 
                        'pseudo' => $_POST['pseudo'],
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'email' => $_POST['email'], 
                        'privilege' => '', 
                        'subscribeDate' => $today,
                        'isDeleted' => false]);

                    if ($this->_userDb->exists($_POST['pseudo']))
                    {
                        //modif de $message
                        $message = 'Ce pseudo est déjà pris';
                        unset($newUser);
                    }
                    else
                    {
                        $this->_userDb->add($newUser);
                        //modif de $message
                        $message = 'Votre inscription a bien été enregistrée';
                    }
                } else
                {
                    $message = 'Les mots de passe ne correspondent pas';
                }

            } else
            {
                $message = 'Votre adresse mail n\'est pas valide.';
            }

        }


        ob_start();
                   
            $bigTitle = 'Inscription';
            require 'src/view/headerTemplate.php';
            require 'src/view/subscribeView.php';
        $pageContent = ob_get_clean();
        require 'src/view/layout.php';
    }

}
