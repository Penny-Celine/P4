        <div class='row'>
            <div class="container">    
                <form class="form subscribe" action="" method="post">
                    <p>Message : <?= $errorMessage ?? ''?></p>
                    <p class="col-12 col-lg-12">
                        <label class="col-6 col-lg-6" for="name">Votre Nom : </label><input class="col-6 col-lg-6" type="text" name="name" maxlength="255" required/><br/>
                        <label class="col-6 col-lg-6" for="email">Votre Email : </label><input class="col-6 col-lg-6" type="email" name="email" required/><br/>
                        <label class="col-6 col-lg-6" for="message">Votre Message : </label><input class="col-6 col-lg-6" type="textarea" name="message"/>
                        <input class="button" type="submit" value="Envoyer" name="contact" />
                    </p>
                </form>
            </div>
        </div>