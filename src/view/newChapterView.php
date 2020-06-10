
    <div clas='row'>
        
        <form action="" method="post">
            <h3 class='offset-3 col-6'>Nouveau chapitre</h3><br/>
            <p>
                <label for="title">Titre du Chapitre : </label><input type="text" name="title" maxlength="255" required/></br>
                <label for="content">Contenu : </label><textarea name="content"></textarea><br/>
                <input type="submit" value="Enregistrer ce chapitre" name="save-chapter" />
            </p>
        </form>
    </div>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name'
    });
  </script>

