<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title> Commentaire </title>
  </head>

  <body>
    <?php
      //on se connecte à la base de donnée
      try
      {
        $bdd = new PDO('mysql:host=localhost;dbname=blogdb;charset=UTF8', 'root', '');
      }
      catch (exception $e)
      {
        die('Erreur : '.$e->getMessage());
      }


      //on recupère les données de la base de donnée billet
      $req = $bdd->prepare('SELECT id,auteur,titre,contenu_billet, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_billet FROM billet WHERE id=?');
      $req->execute(array($_GET['a']));

      $data = $req->fetch();


    ?>

    <header>
      <h1> MON BLOG </h1>
    </header>


    <section>
      <br />
      <a href="index.php">retour  à la liste des billets</a>
      <br />
      <p>
        <h3>
          <?php if(!empty($data))
                      {
                        echo htmlspecialchars($data['titre']).'. Le'.$data['date_creation_billet'];
                      }
                  else
                     {
                       echo '<p><em><blink> LE BILLET PASSE EN PARAMETRE N\'EXISTE PAS </blink></em></p>';
                     }
            ?>
        </h3>

        <?php
        if(!empty($data))
        {
          echo htmlspecialchars($data['contenu_billet']);
        }
        else
        {
          echo '<p><em><blink> LE BILLET PASSE EN PARAMETRE N\'EXISTE PAS </blink></em></p>';
        }
        ?>

      </p>
      <br />
      <br />

      <strong>COMMENTAIRE</strong>
      <br />
      <br />
      <?php
        $req->closeCursor();
        //on recupère les champs de la base de donnée commentaire grâce à une requête SQL
        $req = $bdd->prepare('SELECT id,id_billet,auteur,contenu_commentaire, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date FROM commentaire WHERE id_billet=:dic ORDER BY date_creation');
        $req->execute(array('dic' => $_GET['a']));

        while($donnee = $req->fetch())
        {
          if(!empty($donnee))
          {
            echo '<strong><br />'.htmlspecialchars($donnee['auteur']).'<i> Le '.$donnee['creation_date'].'</i></strong> <br />';
            echo '  '.htmlspecialchars($donnee['contenu_commentaire']).'<br />';
            echo '<br />';
          }
          else
          {
            echo '<p><em><blink> LE BILLET PASSE EN PARAMETRE N\'EXISTE PAS </blink></em></p>';
          }
        }
        $req->closeCursor();

        echo '<br />';
      ?>
      <div><br /><br /><center><i><u><strong>AJOUTER VOTRE COMMENTAIRE</strong></u></i></center></div>
      <form method="POST" action="commentaire_post.php" >
        <div>
          <!--instruction qui suit est pour cacher le champ qui contient l'id du billet à ajouter -->
          <input type="hidden" type="number" name="hidden_number" value=<?php echo $_GET['a'] ?> />

          <br /><i><u><label for="pseudo" >pseudo ou nom</label></u></i> : <input type="text" name="name" id="pseudo" placeholder="Entrez votre pseudo"/>

          <br /> <br /><i><u><label for="commentaire">commentaire</label></u></i><textarea name="commentaire" rows=1 cols=24 id="commentaire" placeholder="Entrez votre commentaire"></textarea>

          <input type="submit" value="Publier" />
        </div>
      </form>

    </section>
  </body>

</html>
