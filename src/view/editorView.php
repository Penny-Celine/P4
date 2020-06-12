

    <div class="row">
      <form method='post'>
        <section class="col-12 col-lg-12 table-responsive">
          <table class="table table-dark table-bordered table-striped">
            <caption class="top-caption">
              <h4>Liste des Chapitres</h4>
            </caption>
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Auteur</th>
                <th scope="col">Titre</th>
                <th scope="col">Contenu</th>
                <th scope="col">Date de Création</th>
                <th scope="col">Modifié le</th>
                <th scope="col">Commentaires Activés</th>
              </tr>
            </thead>
            <tbody>
              <?php
              
              for ($i=0; isset($chapters[$i]); $i ++)
              {
                  if ($chapters[$i]->isDeleted() === 'Non')
                  {
                      echo  '<tr>
                          <td><input type="radio" name="id" value=' . $chapters[$i]->id() .' />';

                  } else
                  {
                      echo '<tr class="table-danger">
                          <td> Supprimé </td>';
                        
                  }
                  echo '<td>' . $chapters[$i]->id() . '</td>
                    <td>' . $chapters[$i]->userId() . '</td>
                    <td>' . $chapters[$i]->title() . '</td>
                    <td>' . $chapters[$i]->content() . '</td>
                    <td>' . $chapters[$i]->creationDate() . '</td>
                    <td>' . $chapters[$i]->modifiedDate() . '</td>
                    <td>' . $chapters[$i]->enableComments() . '</td>
                  </tr>';
              }
              
              ?>
            </tbody>
          </table>
          <input type="submit" value="Modifier" name="update" /> <input type="submit" value="Supprimer" name="delete"/><br/>
        </section>
      </form>
      <div class="row">
        <section class="col-12 col-lg-12">
          <div clas='row'>
            <p>Message : <?= $message ?? ''?></p>  
            <form action="" method="post">
                <h3 class='offset-3 col-6'>Modifier Chapitre :</h3><br/>
                <p>
                    <label for="title">Titre du Chapitre : </label><input type="text" name="title" maxlength="255" value="<?= $chapterTitle ?? ''?>"/><br/>
                    <label for="content">Contenu : </label><textarea name="content"><?= $chapterContent ?? ''?></textarea><br/>
                    <input type="submit" value="Enregistrer ce chapitre" name="save-change" />
                </p>
            </form>
          </div>
        </section>
      </div>  
    </div>
      



    