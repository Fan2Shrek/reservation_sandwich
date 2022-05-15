<!DOCTYPE html>
<html>
    <head>
        <title>register</title>
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

            require('../php/connexion.php');

            /* déclaration des variables php */

            $prenom_user = $nom_user = $email_user = $password_user = $role_user = "";
            $prenomError = $nomError = $emailError = $passwordError = $emailExiste = $roleError = $activeError = "";
            $active_user = "+0";
            $isSuccess = false;

            /* contrôle des champs du formulaire */

            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $role_user       = verifyInput($_POST["role"]);
                $email_user      = verifyInput($_POST["email"]);
                $password_user   = verifyInput($_POST["password"]);
                $nom_user        = verifyInput($_POST["nom"]);
                $prenom_user     = verifyInput($_POST["prenom"]);
                $active_user     = verifyInput($_POST["active"]);
                $isSuccess = true;

                /* vérification champs */

                if(empty($role_user))
                {
                    $roleError = "Veuillez saisir le role.";
                    $isSuccess = false;
                }

                if(empty($prenom_user))
                {
                    $prenomError = "Veuillez saisir votre prénom.";
                    $isSuccess = false;
                }

                if(empty($nom_user))
                {
                    $nomError = "Veuillez saisir votre nom.";
                    $isSuccess = false;
                }

                if(!isEmail($email_user))
                {
                    $emailError = "Veuillez saisir un e-mail valide.";
                    $isSuccess = false;
                }

                if(empty($active_user))
                {
                    $activeError = "Veuillez saisir l'active.";
                    $isSuccess = false;
                }

                if(empty($password_user))
                {
                    $passwordError = "Veuillez saisir un mot de passe."; 


                    echo"<script type='text/javascript'>";


                    $isSuccess = false;
                } 

                /* insert et select dans la base de donnée */

                if($isSuccess) 
                {
                    $db = connect();

                    $req = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE email_user = :email_user");
                    $req->execute(array('email_user' => $email_user));
                    $results = $req->fetch();

                    if($results[0] == 0)
                    {
                        $statement = $db->prepare("INSERT INTO utilisateur (role_user, email_user, password_user, nom_user, prenom_user, active_user) values (?, ?, ?, ?, ?, ?)");
                        $statement->execute(array($role_user, $email_user, $password_user, $nom_user, $prenom_user, $active_user));                    }
                    else
                    {
                        $emailExiste = "Erreur : l'email a déjà été utilisé.";
                        $isSuccess = false;
                    }

                }
            }

            ?>

            <script type="text/javascript">

            function validate()
            { 
                var msg; 
                var str = document.getElementById("password").value; 
                if (str.match( /[0-9]/g) && str.match( /[^a-zA-Z\d]/g) && str.length >= 8) 
                    msg = "<p style='color:green'>Le mot de passe est correct.</p>"; 
                else 
                    msg = "<p style='color:red'>Le mot de passe est incorrect.</p>"


                $isSuccess=false; 

                document.getElementById("msg").innerHTML= msg; 
            } 

            </script>

            <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">

              <div class='col-lg-12 col-md-12 col-sm-12'>

                  <!--formulaire -->

                <h1>S'inscrire</h1>

                <input type="text" id="role" name="role" placeholder="Role" value="<?php echo $role_user; ?>">
                <p style="color:black; font-style:italic;"><?php echo $roleError; ?></p>

                <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo $prenom_user; ?>">
                <p style="color:black; font-style:italic;"><?php echo $prenomError; ?></p>

                <input type="text" id="nom" name="nom" placeholder="Nom d'utilisateur" value="<?php echo $nom_user; ?>">
                <p style="color:black; font-style:italic;"><?php echo $nomError; ?></p>

                <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email_user; ?>">
                <p style="color:black; font-style:italic;"><?php echo $emailError; ?></p>
                <p style="color:black; font-style:italic;"><?php echo $emailExiste; ?></p>


                <input type="password" id="password" name="password" placeholder="Mot de passe" value="<?php echo $password_user; ?>">
                <p style="color:black; font-style:italic;"><?php echo $passwordError; ?></p>
                <span id="msg"></span>

                 <input type="text" id="active" name="active" placeholder="Active" value="<?php echo $active_user; ?>">
                <p style="color:black; font-style:italic;"><?php echo $activeError; ?></p>

                <button type="submit" name="submit" onclick="validate()">S'inscire</button>

                <p class="box-register">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
                  
             </div>

            </form>

        <a id="btnretour" href="index.php" class="btn btn-primary">Retour</a>
        
    </body>
</html>