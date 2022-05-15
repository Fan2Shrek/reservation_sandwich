<?php 

require '../php/connexion.php';

$roleError = $emailError = $passwordError = $nomError = $prenomError = $activeError = $role = $email = $password = $nom = $prenom = $active = "";
$isSucces = false;

if(!empty($_GET['id'])) 
{

    $Id             = verifyInput($_GET['id']);
    $db             = connect();
    $statement      = $db->prepare("SELECT * FROM utilisateur WHERE id_user =?;");
    $statement->execute(array($Id));
    $row            = $statement->fetch();
    $role           = $row['role_user'];
    $email          = $row['email_user'];
    $password       = $row['password_user'];
    $nom            = $row['nom_user'];
    $prenom         = $row['prenom_user'];
    $active         = $row['active_user'];
}


if(!empty($_POST['role_user']))
{

    $role       = verifyInput($_POST['role_user']);
    $email      = verifyInput($_POST['email_user']);
    $password   = verifyInput($_POST['password_user']);
    $nom        = verifyInput($_POST['nom_user']);
    $prenom     = verifyInput($_POST['prenom_user']);
    $active     = verifyInput($_POST['active_user']);
    $isSuccess  = true;


    if(empty($role)) 
    {
        $roleError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($email)) 
    {
        $emailError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    } 

    if(empty($password)) 
    {
        $passwordError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($nom)) 
    {
        $nomError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($prenom)) 
    {
        $prenomError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($active)) 
    {
        $activeError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if($isSuccess)
    {
         $co = connect();

        $statement = $co->prepare("UPDATE utilisateur set role_user =?, email_user =?, password_user =?, nom_user =?, prenom_user =?, active_user =? WHERE id_user =?");
        $statement->execute(array($role, $email, $password, $nom, $prenom, $active, $Id));
        
        
    
        header("Location: index.php");

    }



}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update</title>
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

    <body>
        
        <?php
            require('../php/header.php');
        ?>
        <br> <br><br><br><br><br><br>
        <section id="update">
             <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="" >Modifier un projet</h1>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">

                        <form class="form" role="form" action="<?php echo 'update.php?id=' . $Id; ?>" method="post" enctype="multipart/form-data">
                            
                            <!--Formulaire-->

                            <label for="role_user" class="">role :</label>
                            <input type="text" class="form-control" id="role_user" class="form-control" name="role_user" placeholder="role :" value="<?php echo $role;?>">
                            <span class="help-inline"><?php echo $roleError;?></span>

                            <div class="form-group">
                                <label for="email_user">email :</label>
                                <input type="text" class="form-control" id="email_user" class="form-control" name="email_user" placeholder="email  :" value="<?php echo $email;?>">
                                <span class="help-inline"><?php echo $emailError;?></span>
                            </div>
 
                            <div class="form-group">
                                <label for="password" class="">password :</label>
                                <input type="text" class="form-control" id="password_user" class="form-control" name="password_user" placeholder="password :" value="<?php echo $password;?>">
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            </div>

                            <div class="form-group">
                                <label for="nom" class="">nom :</label>
                                <input type="text" class="form-control" id="nom_user" class="form-control" name="nom_user" placeholder="nom :" value="<?php echo $nom;?>">
                                <span class="help-inline"><?php echo $nomError;?></span>
                            </div>

                            <div class="form-group">
                                <label for="prenom" class="">prenom :</label>
                                <input type="text" class="form-control" id="prenom_user" class="form-control" name="prenom_user" placeholder="prenom :" value="<?php echo $prenom;?>">
                                <span class="help-inline"><?php echo $prenomError;?></span>
                            </div>                       

                            <div class="form-group">
                                <label for="active" class="">active : (1 ou 0)</label>
                                <input type="text" class="form-control" id="active_user" class="form-control" name="active_user" placeholder="active :" value="<?php echo $active;?>">
                                <span class="help-inline"><?php echo $activeError;?></span>
                            </div>

                            

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                    <a id="btnretour" href="index.php" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                            
                        </form>    
                    </div>
                </div>
            </div>
        </section>
        <br><br>
        
        <?php
            require('../php/footer.php');
        ?>

    </body>
</html>