<?php 

session_start();

if ($_SESSION['role']=='e' && $_SESSION['ifco']){
    header('Location: bvEleve.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="images/logo.png">
        <title>Accès administrateur | Lycée privé Saint-Vincent</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <!-- section accès administrateur -->
        
        <section class="choix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        
                        <!--- titre section-->

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h2 class="hChoix">Bienvenue en tant qu'administrateur</h2>
                            <h3 class="hChoix">Que souhaitez-vous faire ?</h3>
                        </div>
                        
                        <!-- accès vers les 2 sections -->
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                
                                <!-- lien 1 -->
                                
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="thumbnailChoix">
                                        <a class="thumbnail" href="updateIndex.php">
                                            <img src="images/logo.png" alt="photosSectionKevin">
                                            <h4 class="h4Choix">Modifier la page d'accueil</h4>
                                        </a>
                                    </div>
                                </div>
                            
                                <!-- lien 2 -->

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="thumbnailChoix">
                                        <a class="thumbnail" href="yannis.php">
                                            <img src="images/logo.png" alt="photosSectionYannis">
                                            <h4 class="h4Choix">Gérer les utilisateurs</h4>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <!-- bouton retour -->
                            
                            <a href="logout.php" class="btn btn-primary">Retour</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </body>
</html>