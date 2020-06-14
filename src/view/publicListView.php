<section class="col-12 col-lg-12 table-responsive">
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
            </tr>
        </thead>
        <tbody>
            <?php
            
            for ($i=0; isset($chapters[$i]); $i ++)
                {
                    if ($chapters[$i]->isDeleted() === 'Non')
                    {
                        echo  '<tr>
                            <td>' . $chapters[$i]->id() . '</td>
                            <td>' . $chapters[$i]->userId() . '</td>
                            <td>' . $chapters[$i]->title() . '</td>
                            <td>' . $chapters[$i]->content() . '</td>
                            <td>' . $chapters[$i]->creationDate() . '</td>
                            <td>' . $chapters[$i]->modifiedDate() . '</td>
                        </tr>';
                    }
                }
            
            ?>
        </tbody>
    </table>
          
</section>