<?php
    require_once 'config.php';
    if(isset($_POST['pseudo']) && isset($_POST['email']) && 
        isset($_POST['password']) && isset($_POST['password_retype']))//on verifie si pseudo email password password_retype exitent
    {
        //on va stocker les POST dans un htmlspecialchars poureviter que les données fournies par lutilisateur contiennent des balises html
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        //on vérifie si la personne a été bien inscrite dans notre base de donnée
        $check =  $conn ->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');//check permet de savoir si la personne est bien inscrite dans la base de donnée
        $check ->execute(array($email));//on va mettre ces données dans un tableau
        $data = $check->fetch();//on va stocker les données dans data et rechercher avec fetch
        $row = $check->rowCount(); //on verifie si les donnees existent dans la table ou pas 

        if ($row == 0)//cela signifie que la personne nexiste pas dans la base de donnée
        {
            if(strlen($pseudo) <= 100)// on fait des verifications sur le pseudo 
            {
                if (strlen($email) <= 100)//verifications email
                {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL))//pour verifier que ladresse email est valide
                    {
                        if($password == $password_retype)
                        {
                            $password = hash('sha256', $password);//hasher pour plus de securite
                            $ip = $_SERVER['REMOTE_ADDR'];//stockage adresse ip dans un server
                            $insert =  $conn ->prepare('INSERT into utilisateurs(pseudo, email, password, ip) VALUES (:pseudo, :email, :password, :ip)');//insertion des donnes dans la base de donnée
                            $insert ->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'ip' => $ip
                            ));//un tableau associative
                            header('Location:inscription.php?reg_err=success');
                        }else header('Location:inscription.php?reg_err=password');
                    }else header('Location:inscription.php?reg_err=email');
                }else header('Location:inscription.php?reg_err=email_lenght');
            }else header('Location: inscription.php?reg_err=pseudo_lenght');
        }else header('Location:inscription.php?reg_err=already');// on le redirige sur la page dinscription pour quelle sinscrite car la personne existe deja dans la BD

    }
?>