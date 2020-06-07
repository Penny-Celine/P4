<?php
    $pageTitle = 'Edition de Chapitres';
    include 'headTemplate.php';
?>

  <body>
    <div clas='row'>
        <?php
    
            if (isset($message))
            {
              echo $message;
            }
        ?>
        <form action="" method="post">
            <h3 class='offset-3 col-6'>Nouveau chapitre</h3><br/>
            <p>
                <label for="title">Titre du Chapitre : </label><input type="text" name="title" maxlength="255" /></br>
                <label for="content">Contenu : </label><textarea name="content"></textarea><br/>
                <input type="submit" value="Enregistrer ce chapitre" name="save-chapter" />
            </p>
        </form>
    </div>

  </body>
</html>
