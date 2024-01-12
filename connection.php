<?php
    if (isset($_POST['username']) && isset($_POST['password']))
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        if($password != '' && $password != '')
        {
            require_once "Configurations/config.php";
            $employe = $bdd->query("SELECT * FROM account WHERE loginAccount='".$username."'");
            $row = $employe->rowCount();
            if ($row == 1)
            {
                $employe = $employe->fetch();
                $password=hash('sha512',$password);
                
                if ($employe['passwordAccount'] == $password)
                {
                    if ($employe['typeAccount'] == "admin")
                    {
                        session_start();
                        $_SESSION['administrateur'] = $employe['loginAccount'];
                        if($employe['darkMode'] == "off") { $_SESSION["darkMode"]=false; } else { $_SESSION["darkMode"]=true; }
                        header("Location:Administrator/");
                        
                    } else if ($employe['typeAccount'] == "user") {
                        session_start();
                        if ($employe["darkMode"] == "on")
                        {
                            $darkMode = true;
                        } else {
                            $darkMode = false;
                        }
                        $_SESSION['utilisateur'] = $employe["loginAccount"];
                        $_SESSION['infoUtilisateur'] = array(
                            'id'=> $employe['id'],
                            'nom'=> $employe['nameAccount'],
                            'darkMode'=>$darkMode
                        );
                        if($employe['darkMode'] == "off") { $_SESSION["darkMode"]=false; } else { $_SESSION["darkMode"]=true; }
                        header("Location:user/");
                    } else {
                        header("Location:./");
                    }
                } 
                else {
                    header("Location:./?err=verif&us=$username");
                }
            } 
            else {
                header("Location:./?err=verif");
            }
        } 
        else {
            header("Location:./?err=vide");
        }
    } 
    else {
        header("Location:./");
    }

?>