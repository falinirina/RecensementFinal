<?php
    if (isset($_POST["ray"]) && isset($_POST["reny"]) && isset($_POST["msivilyRAD"]) && isset($_POST["marapinRAD"]) && isset($_POST["idTok"]))
    {
        require_once("../../Configurations/config.php");

        $id = htmlspecialchars($_POST["idTok"]);
        $ray = htmlspecialchars($_POST['ray']);
        $reny = htmlspecialchars($_POST['reny']);	
        $sivily = htmlspecialchars($_POST['msivilyRAD']);	
        $finoana = htmlspecialchars($_POST['marapinRAD']);

        $query = $bdd->query("UPDATE personne SET mSivilyPersonne='$sivily', mAraPinoPersonne='$finoana' WHERE idPersonne=$ray");
        $query2 = $bdd->query("UPDATE personne SET mSivilyPersonne='$sivily', mAraPinoPersonne='$finoana' WHERE idPersonne=$reny");
        
        if ($query && $query2)
        {
            header("Location: ../viewTokantrano.php?id=$id&act=modM&res=done");
        } else {
            header("Location: ../viewTokantrano.php?id=$id&act=modM&res=err");
        }
    }
    echo "	Et";

?>