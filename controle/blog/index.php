<?php
  include_once('/opt/lampp/htdocs/blog_commentaire/modele/blog/get_billets.php');

  $billets = get_billets(0 , 5);

  //on effectue les modifications sur les données reçus en les sécurisant à l'aide
  //>>d'une copie '$billet' de l'intervale [auteur - new_creation_date] du tableau '$billets'
  foreach($billets as $cle => $billet)
  {
    $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
    $billets[$cle]['contenu_billet'] = htmlspecialchars($billet['contenu_billet']);
  }

  //on affiche le contenu à l'écran
  include_once('/opt/lampp/htdocs/blog_commentaire/vue/blog/index.php');
