<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Blog de Jean Forteroche</title>
    <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name= "description" content= "Blog de l'écrivain fictif Jean Forteroche appelé Billet pour l'Alaska réalisé pour un projet OpenClassrooms sur le langage PHP" />
    <meta name="author" content="Céline Maupoux" />
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Old+Standard+TT&display=swap" rel="stylesheet">
    <link href="public/assets/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link href="public/assets/css/style.css" rel="stylesheet"/>
  </head>

  <body>
    <header class = "jumbotron">

      <div class = "row">
        <img src="public/images/logo-header.png" alt="" class = "header-logo offset-2 col-2 col-lg-2 justify-content-end"/>
        <h1 class = "col-8 col-lg-8">Billet pour l'Alaska</h1>
      </div>

      <nav class ="row navbar">
        <div class="container">
          <ul class="nav navbar-nav col-12 col-lg-12">
            <li> <a href="index.php" class="btn-dark col-3 col-lg-3">Accueil
              <svg class="bi bi-house-door-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.5 10.995V14.5a.5.5 0 01-.5.5H2a.5.5 0 01-.5-.5v-7a.5.5 0 01.146-.354l6-6a.5.5 0 01.708 0l6 6a.5.5 0 01.146.354v7a.5.5 0 01-.5.5h-4a.5.5 0 01-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
               <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z" clip-rule="evenodd"/>
              </svg>
            </a></li>
            <li> <a href="index.php?page=chapitres" class="btn-dark col-3 col-lg-3">Chapitres parus
              <svg class="bi bi-book" width="1em" height="1em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.214 1.072C4.813.752 6.916.71 8.354 2.146A.5.5 0 018.5 2.5v11a.5.5 0 01-.854.354c-.843-.844-2.115-1.059-3.47-.92-1.344.14-2.66.617-3.452 1.013A.5.5 0 010 13.5v-11a.5.5 0 01.276-.447L.5 2.5l-.224-.447.002-.001.004-.002.013-.006a5.017 5.017 0 01.22-.103 12.958 12.958 0 012.7-.869zM1 2.82v9.908c.846-.343 1.944-.672 3.074-.788 1.143-.118 2.387-.023 3.426.56V2.718c-1.063-.929-2.631-.956-4.09-.664A11.958 11.958 0 001 2.82z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M12.786 1.072C11.188.752 9.084.71 7.646 2.146A.5.5 0 007.5 2.5v11a.5.5 0 00.854.354c.843-.844 2.115-1.059 3.47-.92 1.344.14 2.66.617 3.452 1.013A.5.5 0 0016 13.5v-11a.5.5 0 00-.276-.447L15.5 2.5l.224-.447-.002-.001-.004-.002-.013-.006-.047-.023a12.582 12.582 0 00-.799-.34 12.96 12.96 0 00-2.073-.609zM15 2.82v9.908c-.846-.343-1.944-.672-3.074-.788-1.143-.118-2.387-.023-3.426.56V2.718c1.063-.929 2.631-.956 4.09-.664A11.956 11.956 0 0115 2.82z" clip-rule="evenodd"/>
              </svg>
            </a></li>
            <li> <a href="index.php?page=connexion" class="btn-dark col-3 col-lg-3">Connexion
              <svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
              </svg>
            </a></li>
            <li> <a href="index.php?page=inscription" class="btn-dark col-3 col-lg-3">S'inscrire
              <svg class="bi bi-person-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM6 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zm4.5 0a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
              </svg>
            </a></li>
          </ul>
        </div>
      </nav>

    </header>

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
