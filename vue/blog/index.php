<!DOCTYPE html>
<html>
<head>
  <title>blog_mvc</title>
  <meta charset="utf-8" />
</head>
<body>

  <?php
    foreach($billets as $billet)
    {
    ?>

    <em> <?php echo $billet['titre']; ?> </em><br />

    <h3>Le <?php echo $billet['new_creation_date']; ?> </h3><br />

    <p> <?php echo $billet['contenu_billet']; ?> </p> <br />
    <br />

    <?php
    }
    ?>

  </body>
  </html>
