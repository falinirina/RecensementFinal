<?php
    // var_dump($_POST);
    if (isset($_POST["idTokantrano"]) && isset($_POST["lot"]))
    {
        require_once("../../Configurations/config.php");

        $id = htmlspecialchars($_POST['idTokantrano']);	
        $lot = htmlspecialchars($_POST['lot']);	
        
        if (strlen($lot) > 1)
        {
            $query = $bdd->query("UPDATE tokantrano SET lotTokantrano='$lot' WHERE idTokantrano=$id");
            if ($query)
            {
                header("Location: ../viewTokantrano.php?id=$id&act=modL&res=done");
            } else {
                header("Location: ../viewTokantrano.php?id=$id&act=modL&res=len");
            }
        } else {
            header("Location: ../viewTokantrano.php?id=$id&act=modL&res=err");
        }
    }
?>