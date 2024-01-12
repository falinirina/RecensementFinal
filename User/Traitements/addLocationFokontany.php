<?php

    if (isset($_POST['fokontany']) && isset($_POST['zanaparitra']))
    {
        $fokontany = htmlspecialchars($_POST['fokontany']);
        $zanaparitra = htmlspecialchars($_POST['zanaparitra']);
        
        if (strlen($fokontany) > 3)
        {
            require_once "../../Configurations/config.php";
            // var_dump($_POST);
            $data = $bdd->query("SELECT * FROM fokontany WHERE nomFokontany='$fokontany' AND zanaParitraFokontany=$zanaparitra");
            $row = $data->rowCount();

            if ($row == 0)
            {
                $insert = $bdd->prepare("INSERT INTO fokontany(nomFokontany,zanaParitraFokontany) VALUES(:nom,:zanaparitra)");
                $status = $insert->execute(array(
                    'nom'=>$fokontany,
                    'zanaparitra'=>$zanaparitra
                ));
                if ($status)
                {
                    header("Location: ../location.php?act=fkt&res=done&data=$fokontany");
                } else {
                    header("Location: ../location.php?act=fkt&res=err&data=$fokontany");
                }
            } else {
                header("Location: ../location.php?act=fkt&res=exi&data=$fokontany");
            }
        } else {
            header("Location: ../location.php?act=fkt&res=len&data=$fokontany");
        }

    }

?>