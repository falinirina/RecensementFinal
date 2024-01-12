<?php
    // var_dump($_POST);
    if (isset($_POST["idPersonne"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["numero"]) && isset($_POST["asa"]))
    {
        require_once("../../Configurations/config.php");

        $id = htmlspecialchars($_POST['idPersonne']);	
        $nom = htmlspecialchars($_POST['nom']);	
        $prenom = htmlspecialchars($_POST['prenom']);	
        $numero = htmlspecialchars($_POST['numero']);	
        $asa = htmlspecialchars($_POST['asa']);	
        
        if (strlen($nom) > 1)
        {
            $query = $bdd->query("UPDATE personne SET nomPersonne='$nom', prenomPersonne='$prenom', numeroPersonne='$numero', asaPersonne='$asa' WHERE idPersonne=$id");
            if ($query)
            {
                header("Location: ../viewMpiangona.php?id=$id&act=modI&res=done");
            } else {
                header("Location: ../viewMpiangona.php?id=$id&act=modI&res=len");
            }
        } else {
            header("Location: ../viewMpiangona.php?id=$id&act=modI&res=err");
        }
    } else if (isset($_POST["idPersonneFanamasinana"]) && isset($_POST["batisa"]) && isset($_POST["mpandray"]))
    {
        require_once("../../Configurations/config.php");
        $id = htmlspecialchars($_POST['idPersonneFanamasinana']);
        $batisa = htmlspecialchars($_POST['batisa']);
        $mpandray = htmlspecialchars($_POST['mpandray']);
        
        $query = $bdd->query("UPDATE personne SET mpandrayPersonne='$mpandray', batisaPersonne='$batisa' WHERE idPersonne=$id");
        if ($query)
        {
            header("Location: ../viewMpiangona.php?id=$id&act=modF&res=done");
        } else {
            header("Location: ../viewMpiangona.php?id=$id&act=modF&res=err");
        }
    }
?>