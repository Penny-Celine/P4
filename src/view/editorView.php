
    <header class='jumbotron'>
      <div class = "row">
        <img src="public/images/logo-header.png" alt="" class = "header-logo offset-2 col-2 col-lg-2 justify-content-end"/>
        <h1 class = "col-8 col-lg-8">Edition de Chapitres</h1>
      </div>
      <nav class ="row navbar">
        <div class="container">
          <ul class="nav navbar-nav col-12 col-lg-12">
            <li> <a href="index.php" class="btn-dark col-4 col-lg-4">Retour à l'Accueil
              <svg class="bi bi-house-door-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.5 10.995V14.5a.5.5 0 01-.5.5H2a.5.5 0 01-.5-.5v-7a.5.5 0 01.146-.354l6-6a.5.5 0 01.708 0l6 6a.5.5 0 01.146.354v7a.5.5 0 01-.5.5h-4a.5.5 0 01-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
              <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z" clip-rule="evenodd"/>
              </svg>
            </a></li>
            <li> <a href="?page=deconnexion" class="btn-dark col-4 col-lg-4">Déconnexion
            </a></li>
            <li> <a href="?page=nouveau_chapitre" class="btn-dark col-4 col-lg-4">Nouveau Chapitre
            </a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="row">
        <section class="col-sm-12 table-responsive">
          <table class="table table-dark table-bordered table-striped">
            <caption class="top-caption">
              <h4>Liste des Chapitres</h4>
            </caption>
            <thead>
              <tr>
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
                  echo  '<tr>
                          <td>' . $chapters[$i]->id() . '</td>
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
    </div>
      



    