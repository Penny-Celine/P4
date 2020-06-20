<div class='row'>
            <div class="container">    
                <form action="" method="post">
                    <p>Message : <?= $message ?? ''?></p>
                    <p class="col-12 col-lg-12">
                        <label for="name">Votre Nom : </label><input type="text" name="name" maxlength="255" required/><br/>
                        <label for="email">Votre Email : </label><input type="email" name="email" required/><br/>
                        <label for="pseudo">Choisissez un Pseudo : </label><input type="text" name="pseudo" maxlength="255" required/><br/>
                        <label for="password">Choisissez votre Mot de passe : </label><input type="password" name="password" maxlength="255" required/><br/>
                        <label for="password2">Confirmez votre Mot de passe : </label><input type="password" name="password2" maxlength="255" required/><br/>
                        <input type="submit" value="S'inscrire" name="subscribe" />
                    </p>
                </form>
            </div>
        </div>