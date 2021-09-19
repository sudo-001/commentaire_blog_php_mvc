<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <title> acceuil </title>
</head>

<body>
  <header>
  <h1> MON BLOG </h1>
</header>

<section>

    <?php
    //on se connecte à la base de donnée
    try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=blogdb;charset=UTF8', 'root', '');
    }
    catch(exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }




    //on compte le nombre de billet dans la table billet
    $nbre_billet = $bdd->query('SELECT COUNT(*) AS nbre_billet FROM billet');

    $cont_nbre_billet = $nbre_billet->fetch();

    echo 'Le nombre de billet de la table billet est '.$cont_nbre_billet['nbre_billet'];


    //on recupère les champs de la date grâce à une requête SQL
    $req = $bdd->query('SELECT id,auteur,titre,contenu_billet,DATE_FORMAT(date_creation, \' %d/%m/%Y %Hh%imin%ss \') AS new_creation_date FROM billet ORDER BY date_creation DESC LIMIT 0,5');

    //on crait les billets à partir du dernier en se servant des informations recupérées dans la base de donnée
    while($data = $req->fetch())
    {
      ?>

      <p>
        <h3> <?php echo htmlspecialchars($data['titre']).'. Le'.htmlspecialchars($data['new_creation_date']) ?> </h3>

        <?php echo htmlspecialchars($data['contenu_billet']) ?>

        <br /><a href="commentaire.php?a=<?php echo $data['id'] ?> " >commentaire</a>
      </p>
    <br />

    <?php


      }

      //on trouve le nombre de page a générer en  recupérant l'entier du quotient de la division du nombre total de billet compté par 5 et d'ajouter 1 à ce dernier
      $nbre_page = ((int)$cont_nbre_billet['nbre_billet']/5 ) + 1;
      $i=1;

      echo '<div id="conteneur_lien">';
      echo '<span><u>PAGES</u> : </span>';
      while( $i<=$nbre_page)
      {
        echo '  <a href="index.php?p='.$i.'">'.$i.'</a>';
        $i=$i+1;
      }

      echo '</div>';

      $nbre_billet->closeCursor();

      $req->closeCursor();


      /*
              REPOSETERY

              *how to create the admin pages
              *how to charge pages of ticket or pages of comment after had charged the first page 

      */

    ?>



</section>

</body>
</html>
