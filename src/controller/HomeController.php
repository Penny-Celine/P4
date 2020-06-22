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
        $this->_chapterDb = new \App\Manager\PostManager();
        $this->_commentDb = new \App\Manager\CommentManager();
        $this->_userDb = new \App\Manager\UserManager();
        $this->_lastChapter = $this->_chapterDb->getLastPost();
        $this->comment();
        $this->reportComment();
        $lastChapterId = (int)$this->_lastChapter->id();
        $orderedComments = $this->_commentDb->getCommentsOrdered($lastChapterId);

        ob_start();
            require 'src/view/templates/headerTemplate.php';
            $lastChapterTitle = $this->_lastChapter->title();
            $lastChapterCreationDate = $this->_lastChapter->creationDate();
            $lastChapterContent = $this->_lastChapter->content();
            $chapterId = $this->_lastChapter->id();
            require 'src/view/publicViews/homeView.php';
        $pageContent = ob_get_clean();
        require 'src/view/templates/layout.php';

    }

    public function displayChaptersList()
    {
        if (isset($_SESSION['privilege']) && $_SESSION['privilege'] === 'admin')
        {
            $editorPage = new EditorController();
            $editorPage->display();
        } else
        {
            $this->_chapterDb = new \App\Manager\PostManager();
            ob_start();
                $chapters = $this->_chapterDb->getList();
                require 'src/view/templates/headerTemplate.php';
                require 'src/view/publicViews/publicListView.php';
            $pageContent = ob_get_clean();
            require 'src/view/templates/layout.php';
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
            $this->_chapterDb = new \App\Manager\PostManager();
            $this->_commentDb = new \App\Manager\CommentManager();
                        
            ob_start();
            $this->reportComment();
            $this->comment();
            $chapterId = (int)$_GET['id'];
            $orderedComments = $this->_commentDb->getCommentsOrdered($chapterId);
            $chapter = $this->_chapterDb->getPost($chapterId);
            $title = $chapter->title();
            $creationDate = $chapter->creationDate();
            $modifiedDate = $chapter->modifiedDate();
            $content = $chapter->content();
            require 'src/view/templates/headerTemplate.php';           
            require 'src/view/publicViews/chapterView.php';
            $pageContent = ob_get_clean();
            require 'src/view/templates/layout.php';
        }
    }

    public function displayCommentList()
    {
        $editorPage = new EditorController();
        $editorPage->moderate();
    }

    public function comment()
    {
        $this->_commentDb = new \App\Manager\CommentManager();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post-comment']) && isset($_POST['content']) && $_POST['content']!='')
        {
            if (isset($_POST['author']) && $_POST['author']!='')
            {
                $this->_userDb = new \App\Manager\UserManager();
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
                    $errorMessage = 'Votre commentaire a été ajouté avec succès !';
                 } else 
                {
                    $errorMessage = 'Un problème est survenu. Veuillez recommencer.';
                }
                    
            } else
            {
                $errorMessage = 'Veuillez entrer votre pseudo.';
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post-comment']) && isset($_POST['content']) && $_POST['content']=='')
        {
            unset($comment);
            $errorMessage = 'Vous ne pouvez pas poster un commentaire vide';
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
                $errorMessage = 'Vous avez bien signalé le commentaire ayant pour Id : '. $commentId;
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
                $this->_userDb = new \App\Manager\UserManager();
                if ($this->_userDb->exists($pseudo))
                {
                    $connectingUser = $this->_userDb->getUser($pseudo);
                    $passToVerif = password_verify($passwordToTest, $connectingUser->password());
                    if ($passToVerif)
                    {
                        $_SESSION['user'] = $pseudo;
                        $_SESSION['privilege'] = $connectingUser->privilege();
                        $this->displayHomePage();
                    }
                    else
                    {
                        ob_start();
                            $errorMessage = 'Identifiant ou mot de passe incorrect';
                            $bigTitle = 'Connexion';
                            require 'src/view/templates/headerTemplate.php';
                            require 'src/view/formViews/loginView.php';
                        $pageContent = ob_get_clean();
                        require 'src/view/templates/layout.php';
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
                require 'src/view/templates/headerTemplate.php';
                require 'src/view/formViews/loginView.php';
            $pageContent = ob_get_clean();
            require 'src/view/templates/layout.php';
        }
    }
    public function displaySubscribePage()
    {
        $this->_userDb = new \App\Manager\UserManager();

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
                        //modif de $errorMessage
                        $errorMessage = 'Ce pseudo est déjà pris';
                        unset($newUser);
                    }
                    else
                    {
                        $this->_userDb->add($newUser);
                        //modif de $errorMessage
                        $errorMessage = 'Votre inscription a bien été enregistrée';
                    }
                } else
                {
                    $errorMessage = 'Les mots de passe ne correspondent pas';
                }

            } else
            {
                $errorMessage = 'Votre adresse mail n\'est pas valide.';
            }

        }


        ob_start();
                   
            $bigTitle = 'Inscription';
            require 'src/view/templates/headerTemplate.php';
            require 'src/view/formViews/subscribeView.php';
        $pageContent = ob_get_clean();
        require 'src/view/templates/layout.php';
    }

    public function displayLegalPage()
    {

        ob_start();
            require 'src/view/templates/headerTemplate.php';
            require 'src/view/publicViews/legalNoticeView.php';
        $pageContent = ob_get_clean();
        require 'src/view/templates/layout.php';

    }

    public function displayContactPage()
    {

        if(isset($_POST['contact']) && isset($_POST['message']))
        {

            $header="MIME-Version: 1.0\r\n";
            $header.='From:"Cmpx.com"<contact@cmpx.com>'."\n";
            $header.='Content-Type:text/html; charset="uft-8"'."\n";
            $header.='Content-Transfer-Encoding: 8bit';

            $message = '<html>
            <body>
                <div align="center">
                    <p>'.$_POST['name'].' vous a envoyé un message. <br/>
                    Son email est '.$_POST['email'].'.<br/>
                    Son message dit : <br/>'
                    .$_POST['message'].'
                </div>
            </body>';


            mail("celine.maupoux@gmail.com", "Message du blog Billet pour l'Alaska", $message, $header);
            mail($_POST['email'], "Accusé de réception", "<html><body><p>Nous avons bien reçu votre message. <br/>Nous vous recontacterons prochainement à ce sujet. <br/> Merci de votre collaboration.</p></body></html>", $header );
            $errorMessage = 'Votre message a bien été envoyé.';
        }

        $bigTitle = 'Contact';
        ob_start();
            require 'src/view/templates/headerTemplate.php';
            require 'src/view/formViews/contactView.php';
        $pageContent = ob_get_clean();
        require 'src/view/templates/layout.php';

    }


}
