<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
  <div class="col-8">
    <h2 style="margin-top:50px;">Menu de réglage de Eu-disclaimer</h2>
    <br/>
    <h3>Configuration</h3>
    <br/>
    <form method="POST" action=""  novalidate="novalidate">
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Message du Disclaimer:</label>
      <textarea class="form-control" name="message_disclaimer" id="exampleFormControlTextarea1" rows="6"></textarea>
    </div>
    <div class="form-group">
      <label for="urlDeRedirection">Url de redirection :</label>
      <input type="url" class="form-control" name="url_redirection" id="urlDeRedirection" rows="1"></textarea>
    </div>
    <div>
      <input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
    </div>
    <br/>
    <p>Exemple : la légilsation nous impose de vous informer sur la nocivité des produits à base de nicotine, vous devez avoir plus de 18 ans pour consulter ce site!</p>
    <h3>Centre AFPA / session DWWM</h3>
    <img src="<?php echo plugin_dir_url(dirname(__FILE__)).'assets/img/layout_set_logo.png';?>width="10%">
  </div>
</form>
</body>

<?php
if(!empty($_POST['message_disclaimer']) && !empty($_POST['url_redirection'])){
  $text=new DisclaimerOptions();
  $text->setMessageDisclaimer($_POST['message_disclaimer']);
  $text->setRedirectionko($_POST['url_redirection']);
  DisclaimerGestionTable::insererDansTable(
  $text->getMessageDisclaimer(),
  $text->getRedirectionko()
  );
}
?>