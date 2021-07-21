<?php
    session_start();
    require_once 'config.php';
    if(isset($_POST['email']) && isset($_POST['password']))//on verifie si le mail et password existent dabord
    {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        //on vérifie si la personne a été bien inscrite dans notre base 
        $check =  $conn ->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check ->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount(); //on verifie si les donnees existent dans la table ou pas 

        if ($row == 1)//alors la personne existe dans la base de donnees
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL))//pour verifier que ladresse email est valide
            {
                $password = hash('sha256', $password);
                if ($data['password'] === $password)//on utilise === pour comparer le type et la valeur hors == c pr comparer la valeur only 
                {
                    $_SESSION['user'] = $data['pseudo'];
                    header('Location:landing.php');
                }else header('Location:index.php?login_err=password');
            }else header('Location:index.php?login_err=email');//si ca nexiste pas on le redirige sur la page dacceuil avec un messagederreur comme GET error email
        }else header('Location:index.php?login_err=already');//si ca nexiste pas on le redirige sur la page dacceuil

    }else header('Location:index.php');//si ca nexiste pas on le redirige sur la page dacceuil
?>