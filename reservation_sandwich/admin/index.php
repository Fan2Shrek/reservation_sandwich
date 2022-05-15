<?php

session_start();

if ($_SESSION['role']=='e' && $_SESSION['ifco']){
    header('Location: ../bvEleve.php');
}
else if (!$_SESSION['ifco']){
    header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Gestion des élève</title>
        <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width , invalid=scale=1">            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
            <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="../css/styles.css">
            <script src="js/script.js"></script>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@700&family=Oswald:wght@200&family=Quicksand:wght@600&display=swap" rel="stylesheet">
    </head>
<?php
    require('../php/header.php');
?>
    
                <section id="section1" style='margin-top:150px'>
                    <!--tableau-->
                    <section class='tableau'>
                        <!--colonne tableau-->    
                        <table class="table table-bordered">
                            <tr>
                                <th>Id</th>
                                <th>Rôle</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Activation</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                                
                        <?php
                            require '../php/connexion.php';

                                $db = connect();

                                $statement = $db -> query("SELECT * FROM utilisateur");

                                while ($row = $statement -> fetch()) 
                                {
                                echo"<div class='col-lg-12 col-md-12 col-sm-12'>
                                        <tr>
                                         <td>".$row['id_user']."</td>
                                         <td>".$row['role_user']."</td>
                                         <td>".$row['email_user']."</td>
                                         <td>".$row['password_user']."</td>
                                         <td>".$row['nom_user']."</td>
                                         <td>".$row['prenom_user']."</td>
                                         <td>".$row['active_user']."</td>
                                         <td><a href='update.php?id=".$row['id_user']."'class='btn btn-primary'>Modifier</a></td>
                                         <td><a href='delete.php?id=".$row['id_user']."' class='btn btn-danger'>Supprimer</a></td>
                                        </tr>
                                    
                                    </div>";    
                                    
                                }
                                   
                        ?>

                                <?php

                                ?>

                            
                        </table>
                        
                        
                    <a id="btnretour" href="insert.php" class="btn btn-primary">Ajouter</a>
                        
                                                                                                       
                </section>
        </section>
    
    <?php
    require('../php/footer.php');
?>

</html>
