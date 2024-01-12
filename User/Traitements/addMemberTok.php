<?php
    if (isset($_POST["idTok"]) && isset($_POST['type']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['sexe'])
    && isset($_POST['numero']) && isset($_POST['asa']) && isset($_POST['sampana'])  && isset($_POST['andraikitra']) && isset($_POST['batisa']) && isset($_POST['mpandray']))
    {
        $type = htmlspecialchars($_POST['type']);
        $katekista = false;
        $mpiandry = false;
        $mpitoriteny = false;
        $idPersonne = 0;
        if (isset($_POST['katekista']))
        {
            if ($_POST['katekista'] == 'on')
            {
                $katekista = true;
            }
        }
        if (isset($_POST['mpiandry']))
        {
            if ($_POST['mpiandry'] == 'on')
            {
                $mpiandry = true;
            }
        }
        if (isset($_POST['mpitoriteny']))
        {
            if ($_POST['mpitoriteny'] == 'on')
            {
                $mpitoriteny = true;
            }
        }
        $data = array(
            'idTok'=> htmlspecialchars($_POST['idTok']),
            'nom'=> htmlspecialchars($_POST['nom']),
            'prenom'=> htmlspecialchars($_POST['prenom']),
            'sexe'=> htmlspecialchars($_POST['sexe']),
            'numero'=> htmlspecialchars($_POST['numero']),
            'asa'=> htmlspecialchars($_POST['asa']),
            'sampana'=> htmlspecialchars($_POST['sampana']),
            'andraikitra'=> htmlspecialchars($_POST['andraikitra']),
            'katekista'=> $katekista,
            'mpiandry'=> $mpiandry,
            'mpitoriteny'=> $mpitoriteny,
            'batisa'=> htmlspecialchars($_POST['batisa']),
            'mpandray'=> htmlspecialchars($_POST['mpandray'])
       );
    }
    require_once ("../../Configurations/config.php");
    $check = $bdd->query("SELECT * FROM personne WHERE nomPersonne='".$data['nom']."' AND prenomPersonne='".$data['prenom']."'");
    $res = $check->fetch();
    $row = $check->rowCount();
    // echo $row;
    if ($row == 0)
    {
        $insert = $bdd->prepare('INSERT INTO personne(nomPersonne,prenomPersonne,sexePersonne,numeroPersonne,asaPersonne,sampanaPersonne,katekistaPersonne,mpiandryPersonne,mpitoritenyPersonne,andraikitraPersonne,batisaPersonne,mpandrayPersonne)
        VALUES (:nom,:prenom,:sexe,:numero,:asa,:sampana,:katekista,:mpiandry,:mpitoriteny,:andraikitra,:batisa,:mpandray)');
        $result = $insert->execute(array(
            'nom'=> $data['nom'],
            'prenom'=> $data['prenom'],
            'sexe'=> $data['sexe'],
            'numero'=> $data['numero'],
            'asa'=> $data['asa'],
            'sampana'=> $data['sampana'],
            'andraikitra'=> $data['andraikitra'],
            'katekista'=> $data['katekista'],
            'mpiandry'=> $data['mpiandry'],
            'mpitoriteny'=> $data['mpitoriteny'],
            'batisa'=> $data['batisa'],
            'mpandray'=> $data['mpandray']
        ));
        if ($result)
        {
            $check = $bdd->query("SELECT idPersonne FROM personne WHERE nomPersonne='".$data['nom']."' AND prenomPersonne='".$data['prenom']."'");
            $check = $check->fetch();
            $idPersonne = $check["idPersonne"];
        }
    } else {
        $idPersonne = $res["idPersonne"];
    }
    if ($data['idTok'])
    {
        $check = $bdd->query("SELECT * FROM member WHERE personneMember=$idPersonne");
        $row = $check->rowCount();
        if ($row == 0)
        {
            $insert = $bdd->query("INSERT INTO member(personneMember, tokantranoMember, statusMember) VALUES ($idPersonne,".$data["idTok"].", '$type')");
            if ($insert->rowCount() > 0)
            {
                header("Location: ../viewTokantrano.php?id=".$data['idTok']."&act=addMbr&res=done");
            }
        } else {
            header("Location: ../viewTokantrano.php?id=".$data['idTok']."&act=addMbr&res=exi");
        }
    }
    echo $idPersonne;

?>