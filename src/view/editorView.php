<?php
    //require('vendor/autoload.php');
    //use \App\Model;

    $manager = new \App\Model\PostManager();

    if (isset($_POST['save-chapter']) && isset($_POST['title']) && isset($_POST['content']))
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

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edition de Chapitres</title>
    <?php
        include 'headTemplate.php';
    ?>

  </head>
  <body>
    <?php
        include 'headerTemplate.php';
        if (isset($message))
        {
            echo $message;
        }
    ?>
    <form action="" method="post">
      <p>
        <label for="title">Titre du Chapitre : </label><input type="text" name="title" maxlength="255" /></br>
        <label for="content">Contenu : </label><textarea name="content"></textarea></br>
        <input type="submit" value="Enregistrer ce chapitre" name="save-chapter" />
      </p>
    </form>
  </body>
</html>