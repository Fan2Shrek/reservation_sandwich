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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
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

                    //Nom du sandwich
                    $statement2 = $db->prepare('SELECT nom_sandwich FROM sandwich where id_sandwich=?');
                    $statement2->execute(array($item['fk_sandwich_id']));
                    $temp = $statement2 ->fetch();

                    echo '<td>' .$temp['nom_sandwich'] . '</td>';

                    //Nom de la boisson
                    $statement2 = $db->prepare('SELECT nom_boisson FROM boisson where id_boisson=?');
                    $statement2->execute(array($item['fk_boisson_id']));
                    $temp = $statement2 ->fetch();

                    echo '<td>' .$temp['nom_boisson'] . '</td>';


                    //Nom du dessert
                    $statement2 = $db->prepare('SELECT nom_dessert FROM dessert where id_dessert=?');
                    $statement2->execute(array($item['fk_dessert_id']));
                    $temp = $statement2 ->fetch();

                    echo '<td>' .$temp['nom_dessert'] . '</td>';

                    if ($item['chips_com']==1){
                      echo '<td><i class="fa fa-check" aria-hidden="true" ></i></td>';
                    }
                    else{
                      echo '<td>X</td>';
                    }

                    
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