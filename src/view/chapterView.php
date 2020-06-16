        <div class="row">
            <h2 class="col-12 col-lg-12"><?= $title ?? '' ?></h2>
        </div>
        <div class="row">
            <span class="col-4 col-lg-4">Créé le <?= $creationDate ?? '' ?></span>
            <span class="offset-4 col-4 col-lg-4">Modifié le <?= $modifiedDate ?? '' ?></span>
        </div>
        <div clas="row">
            <block class="col-12 col-lg-12"><?= $content ?? ''?></block>
        </div>