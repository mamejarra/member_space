<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Inscription</title>
</head>
<body>
    <div class="login-form"> 
         <!-- la on va soccuper de notre systeme derreur DEBUT-->
         <?php
            if(isset($_GET['reg_err']))
            {
                $err = htmlspecialchars($_GET['reg_err']); 
                switch($err)
                {
                    case 'success':
                    ?>
                        <div class="alert alert-danger">  
                            <?php header('Location:success.php'); ?>
                        </div>
                    <?php
                    break;
                    case 'password':
                        ?>
                            <div class="alert alert-danger">  
                                <strong> Erreur </strong>mot de passe différent 
                            </div>
                        <?php
                        break;
    
                    case 'email':
                    ?>
                       <div class="alert alert-danger">  
                            <strong>Erreur </strong> email non valide
                       </div>
                    <?php
                     break;

                     case 'email_lenght':
                        ?>
                           <div class="alert alert-danger">  
                                <strong>Erreur </strong> email trop long
                           </div>
                        <?php
                         break;
                         
                    case 'pseudo_lenght':
                        ?>
                           <div class="alert alert-danger">  
                                <strong>Erreur </strong> pseudo trop long
                           </div>
                        <?php
                         break;
                    case 'already':
                    ?>
                       <div class="alert alert-danger">  
                            <strong>Erreur </strong> compte déja exixtant
                       </div>
                    <?php
                    break;
                }
            }
        ?>
    <!-- la on va soccuper de notre systeme derreur FIN-->

        <form action="treatment_insc.php" method="POST">
            <h2 class="text-center">Inscription</h2>
            <div>
                <input type="text" name="pseudo" class="form-control" placeholder="PSEUDO" required="required" autocomplete="off"> 
            </div>
            <div>
                <input type="text" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off"> 
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off"> 
            </div>
            <div>
                <input type="password" name="password_retype" class="form-control" placeholder="Retapez le mot de passe" required="required" autocomplete="off"> 
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
            </div>
        </form>
    </div>
    <style>
        .login-form {
            width: 340px;
            margin: 50px auto;
        }
        .login-form form {
            background: #f7f7f7;
            margin-bottom: 15px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .login-form, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</body>
</html>