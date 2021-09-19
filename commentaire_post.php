<?php
  //on se connecte à la table commentaire et on ajoute le commentaire
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=blogdb;charset=UTF8', 'root', '');
  }
  catch(exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

  $req = $bdd->prepare('INSERT INTO commentaire(id_billet,auteur,contenu_commentaire,date_creation) VALUES( :get, :post_nom,:post_texte, NOW())');
  $req->execute(array('get'=>$_POST['hidden_number'],
                      'post_nom'=>$_POST['name'],
                      'post_texte'=>$_POST['commentaire'] ));
  //On se redirige directement vers la page commentaire.php
  header('location:index.php');
?>
