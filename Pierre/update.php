<?php 


require 'connexion.php';
 
if (!empty($_GET['id'])){
    $id = $_GET['id'];
}

#Récupération du formulaire
if(!empty($_POST)) {
    $sandwich = checkInput($_POST['sandwich']);
    $boisson = checkInput($_POST['boisson']);
    $dessert = checkInput($_POST['dessert']);
    $heure = $_POST['heure'];
    $heure = $heure . ':00';

    $isSuccess= true;

    if (is_null($_POST['chips'])){
        $chips=0;
    }
    else{
        $chips = 1;
    }
    
    #Vérification    
    if($isSuccess) { 
        //Vérification de la date
        $db = connect();
        $statement=$db->prepare('SELECT date_heure_livraison_com FROM commande WHERE id_com = ?');
        $statement->execute(array($id));
        $row = $statement->fetch();
        $date = $row['date_heure_livraison_com'];
        $check_date = ($date > date('Y-m-d H:i:s')) ? True: False;

        if ($check_date){
            $statement = $db->prepare("UPDATE commande set fk_sandwich_id=?, fk_boisson_id =?, fk_dessert_id =?, chips_com=? 
            WHERE id_com=?");
            $statement->execute(array($sandwich,$boisson,$dessert,$chips,$id));
            $db = null;
            #header("Location: historique.php");
        }
        else{
            echo'<h1><strong>Impossible de modifier la commande (commande déjà passée) </strong></h1>'; 
        }

    }
}
else{
    $id = $_GET['id'];
    $db =connect();
    $statement = $db -> prepare("SELECT * FROM commande where id_com = ?"); 
    $statement->execute(array($id));
    $item = $statement->fetch();
    $date = $item['date_heure_livraison_com'];

    $temp = str_split($date, 2);

    var_dump($temp);

    $id_sandwich = $item['fk_sandwich_id'];
    $id_boisson = $item['fk_boisson_id'];
    $id_dessert = $item['fk_dessert_id'];
    $chips = $item['chips_com'];
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
        <title>Modifier une commande</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    
    <body>

    <!-- Fomrulaire -->
    <div id='form-ajout'>
        <form class='form' action='<?php echo "update.php?id=".$id ?>' id='contact-form' method='post' action='' classe='form'>

            <!-- Select sandwich -->
            <div class='form-group'>
                <label for='classe'>Sandwich :</label>
                <select class='form-control' id='sandwich' name='sandwich'>
                <?php 
                foreach ($db->query('SELECT * FROM sandwich') as $row) 
                {
                    if ($row['id_sandwich']== $id_sandwich){
                        echo '<option selected="selected" value="'. $row['id_sandwich'] .'">'. $row['nom_sandwich'] . '</option>';
                    }
                    else{
                        echo '<option value="'. $row['id_sandwich'] .'">'. $row['nom_sandwich'] . '</option>';
                    }
                    
                }
                ?>
                </select>
            </div>
            
            <!-- Select boison -->
            <div class='form-group'>
                <label for='classe'>Boisson :</label>
                <select class='form-control' id='boisson' name='boisson'>
                <?php 
                foreach ($db->query('SELECT * FROM boisson') as $row) 
                {
                    if ($row['id_boisson']== $id_boisson){
                        echo '<option selected="selected" value="'. $row['id_boisson'] .'">'. $row['nom_boisson'] . '</option>';
                    }
                    else{
                        echo '<option value="'. $row['id_boisson'] .'">'. $row['nom_boisson'] . '</option>';
                    }
                    
                }
                ?>
                </select>
            </div>

            <!-- Select dessert -->
            <div class='form-group'>
                <label for='classe'>Dessert :</label>
                <select class='form-control' id='dessert' name='dessert'>
                <?php 
                foreach ($db->query('SELECT * FROM dessert') as $row) 
                {
                    if ($row['id_dessert']== $id_dessert){
                        echo '<option selected="selected" value="'. $row['id_dessert'] .'">'. $row['nom_dessert'] . '</option>';
                    }
                    else{
                        echo '<option value="'. $row['id_dessert'] .'">'. $row['nom_dessert'] . '</option>';
                    }
                    
                }
                
                ?>
                </select>
            </div>

            <div>
                <?php
                if ($chips == 1 ){
                    echo '<input type="checkbox" id="chips" name="chips" checked>';
                }
                else{
                    echo '<input type="checkbox" id="chips" name="chips">';
                }
                
                echo '<label for="chips">Chips</label>';
                $db = null;?>
            </div>
            <input type="time" id="heure" name="heure" value="<?php echo $heure;?>">
            <div>


            </div>

            <button type='submit' class='btn btn-sucess'>Envoyer</button>
        </form>  
    </div>
    </body>
</html>