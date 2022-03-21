<?php

    require 'connexion.php';
    
    if(!empty($_GET['id'])) 
    {
        //Obtention de la date
        $id = checkInput($_GET['id']);
        $db = connect();
        $statement=$db->prepare('SELECT date_heure_livraison_com FROM commande WHERE id_com = ?');
        $statement->execute(array($id));
        $row = $statement->fetch();
        $date = $row['date_heure_livraison_com'];
        $db=null;
        $check_date = ($date > date('Y-m-d H:i:s')) ? True: False;
    }

    if (!empty($_POST)){
        $id = checkInput($_POST['id']);
        $db= connect();
        $statement = $db->prepare('UPDATE commande SET annule_com = 1 WHERE id_com=?');
        $statement->execute(array($id));
        $db=null;
        header("Location: historique.php");
    }

    function checkInput($var) {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
      }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Supprimer la commande ?</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    
    <body>
        <!-- Petit formulaire pour avoir le post -->
         <div class="container admin">
         <?php 
         if ($check_date){
                    echo '
            <div class="row">
                <h1><strong>Supprimer la commande </strong></h1>
                <br>
                        <form class="form" action="delete.php" role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                        <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Oui</button>
                        <a class="btn btn-default" href="historique.php">Non</a>
                        </div>
                    </form> ';
                }

                else{
                    echo'<h1><strong>Impossible de supprimer la commande (commande déjà passée) </strong></h1>'; 
                }
                ?>
            </div>
        </div>   
    </body>
</html>