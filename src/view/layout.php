<!DOCTYPE html>
<html lang='fr'>
    <head>
        <title><?= $pageTitle ?? 'Billet pour l\'Alaska'?></title>
        <meta name= 'description' content= '<?= $pageDescription ?? 'Blog de l\'écrivain fictif Jean Forteroche appelé Billet pour l\'Alaska réalisé pour un projet OpenClassrooms sur le langage PHP' ?>' />
        <meta charset='utf-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'/>
        <meta name='author' content='Céline Maupoux' />
        <link href='https://fonts.googleapis.com/css2?family=Great+Vibes&family=Old+Standard+TT&display=swap' rel='stylesheet'>
        <link href='public/assets/bootstrap/css/bootstrap.css' rel='stylesheet'/>
        <link href='public/assets/css/style.css' rel='stylesheet'/>
        <script src="https://cdn.tiny.cloud/1/luz0l8xqjjreoace2csbqtyqqoilfr7oveqv5o9fdmjdaovh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </head>
    <body>
        <?= 
            $pageContent ?? 'Erreur 404 : Page non trouvée'
        ?>
        <footer class= "row footer">
            <p class="col-12 col-lg-12">
                Site développé par Céline Maupoux pour <a class="btn-dark" href="https://www.openclassrooms.com">OpenClassrooms</a> | <a class="btn-dark" href="siteMap.php">Plan du site</a> | <a class="btn-dark" href="legalNotice.php">Mentions légales</a>
            </p>
        </footer>
    </body>
</html>