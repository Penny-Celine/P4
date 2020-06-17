  <section class="container">
    <div class="row">
      <div class="col-12 col-lg-12">
        <p>Message : <?= $message ?? ''?></p>
      </div>
      <div class="row">
        <div class="col-12 col-lg-12">
          <form action="" method="post">
            <h3 class='offset-3 col-6'>Modifier Chapitre :</h3><br/>
            <p> <?php
                if (!isset($chapterId))
                {
                  echo '<span>Sélectionnez le Chapitre à modifier dans la liste plus bas</span><br/>';
                }
                ?>
                <label for="newTitle">Titre du Chapitre : </label><input type="text" name="newTitle" maxlength="255" value="<?= $chapterTitle ?? ''?>"/><br/>
                <label for="newContent">Contenu : </label><textarea name="newContent"><?= $chapterContent ?? ''?></textarea><br/>
                <input type="hidden" name="chapterId" value="<?= $chapterId ?? '' ?>"/>
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
              <h4>Liste des Chapitres</h4>
            </caption>
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Auteur</th>
                <th scope="col">Titre du Chapitre</th>
                <th scope="col">Contenu</th>
                <th scope="col">Date de Création</th>
                <th scope="col">Modifié le</th>
                <th scope="col">Comment. Activés</th>
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
                          <td><input type="radio" name="id" value=' . $chapters[$i]->id() .' />Suppr.</td>';
                        
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
    </div>
  </section>
      



    