<?php

    require '../php/connexion.php';

 $active = $id = "";

    if(!empty($_GET['id'])) 
    {
        $id_user = verifyInput($_GET['id']);
    }

    /* requete delete */

    if(!empty($_POST['id_user'])) 
    {
        $id_user = verifyInput($_POST['id_user']);
        
        $db = connect();

        $query = $db->prepare("SELECT active_user FROM utilisateur WHERE id_user=?");

        
        if(!empty($_POST['active_user']) == 1)
        {
            header("Location: aled.php"); 
        }

        else
        {
           $sql = "DELETE FROM utilisateur WHERE id_user = ? AND active_user = 0";
            $statement= $db->prepare($sql);
            $statement->execute(array($id_user));
            header("Location: index.php"); 
        }

    
        
    }
    


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un utilisateur</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
        <section id="delete">
             <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="">Supprimer un utilisateur</h1>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form class="form" action="" role="form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" value="<?php echo $id_user;?>"/>
                            <p class="alert alert-danger">Êtes-vous sur de vouloir supprimer le projet ?</p>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-danger">Oui</button>
                                <a class="btn btn-danger" href="index.php">Non</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>