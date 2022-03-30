<?php 

session_start();
//$user = $_SESSION['username'];
$user = ['joe','biden'];
//$user_id = $_SESSION['user_id'];
$user_id = 1;
$filtre = False;
$heure_apres = $heure_avant ='';

require_once 'connexion.php';

$db = connect();
$statement = $db->prepare('SELECT count(*) FROM historique WHERE fk_user_id=?');
$statement -> execute(array($user_id));
$item = $statement->fetch();

//Si l'utilisateur a déjà fait une recherche
if($item['0']==1){
  $statement = $db->prepare('SELECT dateDebut_hist, dateFin_hist FROM historique WHERE fk_user_id=?');
  $statement -> execute(array($user_id));
  $item = $statement->fetch();
  $date_avant = $item['dateDebut_hist'];
  $date_apres = $item['dateFin_hist'];
}


//En cas de filtre
if (!empty($_POST['heure_avant'])){
  $filtre = True;
  $heure_avant = $_POST['heure_avant'];
  $heure_apres = $_POST['heure_apres'];

  $h1 = $heure_avant;
  $h2 = $heure_apres;

  if ($h2 < $h1 ){
    $h2 = $h1;
  }
  if ($h1 > $h2 ){
    $h1 = $h2;
  }

  //Suppression des anciennes infos
  $db = connect();
  $statement = $db->prepare('DELETE FROM historique where fk_user_id=?');
  $statement -> execute(array($user_id));

  //Historisation des dates
  $statement = $db->prepare('INSERT INTO historique (dateDebut_hist, dateFin_hist, fk_user_id) VALUES (?,?,?)');
  $statement-> execute (array($heure_avant,$heure_apres,$user_id));

  //Mise à jour de la table
  $statement = $db->prepare('SELECT * FROM `commande` WHERE date_heure_livraison_com BETWEEN ? and ?');
  $statement-> execute (array($heure_avant,$heure_apres));
} 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Votre historique de commande</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    </head>

    <body>
        <div class="container site">

            <h1 class="text-logo">Historique de commande de <?php echo $user[0] ,' ', $user[1];?></h1>

            <form class="form" action="" role="form" method="post" id="filtre-form">
              <h3>Filtres : </h3>
              <input type="date" id="heure_avant" name="heure_avant" value="<?php echo $h1;?>">
              <input type="date" id="heure_apres" name="heure_apres" value="<?php echo $h2;?>">
              <button type="submit" class="btn btn-primary" id='filtre-btn'>Filtrer</button>
            </form>
            <form class="form" action="delete.php" role="form" method="post">
                <input type="hidden" name="reset" value="1"/>
                <div class="form-actions">
                <button type="submit" class="btn btn-warning">Réinitialiser</button>
                </div>
            </form> 
            

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
                require_once 'connexion.php';

                $db = connect();

                if (!$filtre){
                  $statement=$db->query('SELECT *
                  FROM commande 
                  ORDER BY date_heure_com DESC');
                }
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

                    //Check des chips
                    if ($item['chips_com']==1){
                      echo '<td><i class="fa fa-check" aria-hidden="true" ></i></td>';
                    }
                    else{
                      echo '<td>X</td>';
                    }

                    
                    echo '<td>' .$item['date_heure_livraison_com'] . '</td>';
                    echo '<td width=340>';
                      echo '<a class="btn btn-primary" href="update.php?id='. $item['id_com'] .'"><span class="bi-at"></span> Modifier</a>';
                      echo' ';
                      echo '<a class="btn btn-danger" href="delete.php?id='. $item['id_com'] .'"><span class="bi-x"></span> Supprimer</a>';
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