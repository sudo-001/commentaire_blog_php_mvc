<?php
  //Le contrôleur global
  include_once('/opt/lampp/htdocs/blog_commentaire/modele/blog/get_billets.php');

  if(!isset($_GET['section']) OR $_GET['section'] == 'index')
  {
    include_once('/opt/lampp/htdocs/blog_commentaire/controle/blog/index.php');
  }
