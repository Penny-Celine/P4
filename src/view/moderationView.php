<section class="container">
    <div class="row">
      <div class="col-12 col-lg-12">
        <p>Message : <?= $message ?? ''?></p>
      </div>
      <div class="row">
        <div class="col-12 col-lg-12">
          <form action="" method="post">
            <h3 class='offset-3 col-6'>Modifier Commentaire :</h3><br/>
            <p> <?php
                if (!isset($commentId))
                {
                  echo '<span>Sélectionnez le Commentaire à modifier dans la liste plus bas</span><br/>';
                }
                ?>
                <label for="newContent">Contenu : </label><textarea name="newContent"><?= $commentContent ?? ''?></textarea><br/>
                <input type="hidden" name="commentId" value="<?= $commentId ?? '' ?>"/>
                <input type="submit" value="Enregistrer les modifications" name="save-change" />
              </p>
          </form>
        </div>
      </div>
    </div>  
    
    <div class="row">
      <form method='post'>
        <section class="container">
          <table class="table-sm table-dark table-bordered table-striped">
            <caption class="top-caption">
              <h4>Liste des Commentaires signalés</h4>
            </caption>
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Auteur</th>
                <th scope="col">Contenu</th>
                <th scope="col">Date de Création</th>
                <th scope="col">Déjà modifié</th>
              </tr>
            </thead>
            <tbody>
              <?php
              
              for ($i=0; isset($reportedComments[$i]); $i ++)
              {
                  if ($reportedComments[$i]->isModerated() === false)
                  {
                      echo  '<tr>
                          <td><input type="radio" name="id" value=' . $reportedComments[$i]->id() .' />';

                  } else
                  {
                      echo '<tr class="table-danger">
                          <td><input type="radio" name="id" value=' . $reportedComments[$i]->id() .' /></td>';
                        
                  }
                  echo '<td>' . $reportedComments[$i]->id() . '</td>
                    <td>' . $reportedComments[$i]->author() . '</td>
                    <td>' . $reportedComments[$i]->content() . '</td>
                    <td>' . $reportedComments[$i]->creationDate() . '</td>
                    <td>' . $reportedComments[$i]->isModerated() . '</td>
                  </tr>';
              }
              
              ?>
            </tbody>
          </table>
          <input type="submit" value="Modifier" name="update" /> <input type="submit" value="Supprimer" name="delete"/><br/>
        </section>
      </form>
    </div>
  </section>
      