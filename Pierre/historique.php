<!DOCTYPE html>
<html>
    <head>
        <title>Votre historique de commande</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="container site">
           
            <h1 class="text-logo">Votre historique de commande</h1>

            <?php
				require 'connexion.php';
			 
                echo '<nav>
                        <ul class="nav nav-pills" role="tablist">';

                $db = connect();
                $statement = $db->query('SELECT * FROM commande');
                ?>
                <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th>Sandwich</th>
                  <th>Boisson</th>
                  <th>Dessert</th>
                  <th>Chips</th>
                  <th>Date de livraison</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $statement=$db->query('SELECT *
                FROM commande 
                ORDER BY date_heure_com DESC');
                while($item = $statement->fetch()){
                    echo '<tr>';
                    echo '<td>' .$item['fk_sandwich_id'] . '</td>';
                    echo '<td>' .$item['fk_boisson_id'] . '</td>';
                    echo '<td>' .$item['fk_dessert_id'] . '</td>';
                    echo '<td>' .$item['chips_com'] . '</td>';
                    echo '<td>' .$item['date_heure_livraison_com'] . '</td>';
                    echo '<td width=340>';
                      echo '<a class="btn btn-primary" href="update?id='. $item['id_com'] .'"><span class="bi-at"></span> Modifier</a>';
                      echo' ';
                      echo '<a class="btn btn-danger" href="delete.php?id='. $item['id_com'] .'&amp;type=mail"><span class="bi-x"></span> Supprimer</a>';
                    echo'</td>';
                  echo'</tr> ';
                }
              echo "                  
                </tbody>
              </table>
        </div>
    </body>
</html>";
?>