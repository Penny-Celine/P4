<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Billet pour l'Alaska</title>
    <meta name= "description" content= "Blog de l'écrivain fictif Jean Forteroche appelé Billet pour l'Alaska réalisé pour un projet OpenClassrooms sur le langage PHP" />
    <?php
      include 'headTemplate.php';
    ?>
  </head>

  <body>
    <?php 
      include "headerTemplate.php";
    ?>

    <div class ="row welcome-container">
      <div class="offset-1 col-10 col-lg-10">
        <blockquote class="blockquote">Soyez les bienvenu.e.s sur ce blog un peu particulier. Je me présente : Jean Forteroche, écrivain.<br/>
          Ici, je vais publier en temps réel les chapitres de mon futur roman : "Billet pour l'Alaska"<br/>
          Vous trouverez plus bas sur cette page le dernier chapitre paru. En haut de l'écran dans la barre de navigation vous pouvez accéder à la connexion au site si vous êtes déjà membre, voir tous les chapitres parus ou vous inscrire sur ce site.<br/>
          Ce site autorise les commentaires sur son contenu. Vous pouvez commenter mes chapitres si vous êtes membre.<br/>
          Pour devenir membre, inscrivez-vous ! Bonne lecture !<br/>
          <small>Jean Forteroche</small><br/>
        </blockquote>
      </div>
    </div>
    <div class="container last-chapter-container">
      <div class = "row">
        <div class = "col-12 col-lg-12 last-chapter">
          <div class = "row">
            <h2 class= "offset-3 col-6 last-chapter-title">
              <?php 
                $lastChapterTitle = "Titre du dernier chapitre";
                echo $lastChapterTitle;
              ?>
            </h2>
            <span class="col-3 col-lg-3">Paru le 12/05/2020</span>
          </div>
          <div class="row">
            <p class="offset-1 col-10 col-lg-10">
              <?php 
                $lastChapterContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
                echo $lastChapterContent;
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <footer class= "row footer">
      <p class="col-12 col-lg-12">
      Site développé par Céline Maupoux pour <a class="btn-dark" href="https://www.openclassrooms.com">OpenClassrooms</a> | <a class="btn-dark" href="siteMap.php">Plan du site</a> | <a class="btn-dark" href="legalNotice.php">Mentions légales</a>
      </p>
    </footer>
  </body>

</html>
