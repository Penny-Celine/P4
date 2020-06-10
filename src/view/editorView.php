

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
              var_dump($chapters);
              
              for ($i=0; isset($chapters[$i]); $i ++)
              {
                  if (!$chapters[$i]->isDeleted() || $chapters[$i]->isDeleted() === 0)
                  {
                      echo  '<tr>
                          <td><input type="submit" value="Modifier" name="change-chapter' . $chapters[$i]->id() .'" />';

                  } else 
                  {
                      echo '<tr class=\'deleted\'>
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
          
        </section>
      </form>
      <div class="row">
        <section class="col-12 col-lg-12">
          <div clas='row'>
            <form action="" method="post">
                <h3 class='offset-3 col-6'>Modifier Chapitre :</h3><br/>
                <p>
                    <label for="title">Titre du Chapitre : </label><input type="text" name="title" maxlength="255" value="<?= $chapterTitle ?? ''?>"/></br>
                    <label for="content">Contenu : </label><textarea name="content"><?= $chapterContent ?? ''?></textarea><br/>
                    <input type="submit" value="Enregistrer ce chapitre" name="save-change" />
                </p>
                <script>
                  tinymce.init({
                    selector: 'textarea',
                    plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                    toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
                    toolbar_mode: 'floating',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name'
                  });
                </script>
            </form>
          </div>
        </section>
      </div>  
    </div>
      



    