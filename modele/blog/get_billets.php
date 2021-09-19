<?php
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=blogdb;charset=UTF8' , 'root' , '');
  }
  catch(exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

  function get_billets($offset, $limit)
  {
    global $bdd;

    $offset = (int) $offset;
    $limit = (int) $limit;

    $req = $bdd->prepare('SELECT id,auteur,titre,contenu_billet, DATE_FORMAT(date_creation , \' %d/%m/%Y %Hh%imin%ss \') AS new_creation_date FROM billet ORDER BY date_creation DESC LIMIT :offset , :limit');
    $req->bindParam(':offset' , $offset , PDO::PARAM_INT);
    $req->bindParam(':limit' , $limit , PDO::PARAM_INT);
    $req->execute();

    $data = $req->fetchAll();

    return $data;
  }
