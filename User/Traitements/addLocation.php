<?php

    if (isset($_POST['parcelle']) && isset($_POST['fokontany']))
    {
        $parcelle = htmlspecialchars($_POST['parcelle']);
        $fokontany = htmlspecialchars($_POST['fokontany']);
        
        if (strlen($parcelle) > 3)
        {
            require_once "../../Configurations/config.php";

            $data = $bdd->query("SELECT * FROM parcelle WHERE Parcelle='$parcelle' AND fokontanyParcelle=$fokontany");
            $row = $data->rowCount();

            if ($row == 0)
            {
                $insert = $bdd->prepare("INSERT INTO parcelle(Parcelle,fokontanyParcelle) VALUES(:parcelle,:fokontany)");
                $status = $insert->execute(array(
                    'parcelle'=>$parcelle,
                    'fokontany'=>$fokontany
                ));
                if ($status)
                {
                    header("Location: ../location.php?act=prc&res=done&data=$parcelle");
                } else {
                    header("Location: ../location.php?act=prc&res=err&data=$parcelle");
                }
            } else {
                header("Location: ../location.php?act=prc&res=exi&data=$parcelle");
            }
        } else {
            header("Location: ../location.php?act=prc&res=len&data=$parcelle");
        }

    }

?>