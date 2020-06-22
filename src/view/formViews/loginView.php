        <div class='row'>
            <div class="container">    
                <form action="" method="post">
                    <p>Message : <?= $errorMessage ?? ''?></p>
                    <p class="col-12 col-lg-12">
                        <label for="pseudo">Pseudo</label><input type="text" id="pseudo" name="pseudo" maxlength="255" required/><br/>
                        <label for="password">Mot de passe </label><input type="password" id="password" name="password" maxlength="255" required/><br/>
                        <input type="submit" value="Valider" name="connect" />
                    </p>
                </form>
            </div>
        </div>
