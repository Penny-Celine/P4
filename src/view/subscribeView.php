<div class='row'>
            <div class="container">    
                <form class="form subscribe" action="" method="post">
                    <p>Message : <?= $message ?? ''?></p>
                    <p class="col-12 col-lg-12">
                        <label class="col-6 col-lg-6" for="name">Votre Nom : </label><input class="col-6 col-lg-6" type="text" name="name" maxlength="255" required/><br/>
                        <label class="col-6 col-lg-6" for="email">Votre Email : </label><input class="col-6 col-lg-6" type="email" name="email" required/><br/>
                        <label class="col-6 col-lg-6" for="pseudo">Choisissez un Pseudo : </label><input class="col-6 col-lg-6" type="text" name="pseudo" maxlength="255" required/><br/>
                        <label class="col-6 col-lg-6" for="password">Choisissez votre Mot de passe : </label><input class="col-6 col-lg-6" type="password" name="password" maxlength="255" required/><br/>
                        <label class="col-6 col-lg-6" for="password2">Confirmez votre Mot de passe : </label><input class="col-6 col-lg-6" type="password" name="password2" maxlength="255" required/><br/>
                        <input class="button" type="submit" value="S'inscrire" name="subscribe" />
                    </p>
                </form>
            </div>
        </div>