    <section class="container">
        <div class="row">
            <h2 class="col-12 col-lg-12"><?= $title ?? '' ?></h2>
        </div>
        <div class="row">
            <span class="col-4 col-lg-4">Créé le <?= $creationDate ?? '' ?></span>
            <span class="offset-4 col-4 col-lg-4">Modifié le <?= $modifiedDate ?? '' ?></span>
        </div>
        <div clas="row">
            <block class="col-12 col-lg-12"><?= $content ?? ''?></block>
        </div>
    </section>
    <section class="container">
        <div class="row">
            <h3 class="col-12 col-lg-12">Commentaires</h3><br/>
        </div>
        <div class="row">
            <p col-12 col-lg-12>
            <?php
                for ($i=0; isset($orderedComments[$i]); $i ++)
                {
                echo '<form action="" method="post">';
                echo '<div class="container comment">Id :' .$orderedComments[$i]->id(). ' ';
                echo 'Auteur :' .$orderedComments[$i]->author(). '<br/> ';
                echo 'Commentaire :' .$orderedComments[$i]->content(). '<br/> ';
                echo 'Ecrit le :' .$orderedComments[$i]->creationDate(). ' </div>';
                //echo 'Déjà modéré ?' .$orderedComments[$i]->isModified(). ' ';
                //echo 'Reporté ?' .$orderedComments[$i]->isReported(). ' ';
                echo '<input type="hidden" name="commentId" value="'.$orderedComments[$i]->id().'"/>';
                echo '<input type="submit" name="report" value="Signaler"/></form>';
                }
            ?>
            </p>
        </div>
        <div class='row'>
            <div class="container">    
                <form action="" method="post">
                    <h3 class='offset-3 col-6'>Commenter :</h3><br/>
                    <?php
                    if (isset($message))
                    {
                        echo '<p> Message :' . $message . '</p>';
                    }
                    ?>
                    <p class="col-12 col-lg-12">
                        <label for="author">Votre pseudo : </label><input type="text" name="author" maxlength="255" required/><br/>
                        <label for="content">Message : </label><textarea name="content"></textarea><br/>
                        <input type="hidden" name="chapterId" value="<?= $chapterId ?? ''?>"/>
                        <input type="submit" value="Enregistrer" name="post-comment" />
                    </p>
                </form>
            </div>
        </div>
    </section>