<?php
    // var_dump($_POST);
    if (isset($_POST["parcelle"]) && isset($_POST["data"]) && isset($_POST["lot"]))
    {
        $parcelle = htmlspecialchars($_POST['parcelle']);
        $lot = htmlspecialchars($_POST['lot']);
        $dataFinal = json_decode($_POST["data"], true);
        // var_dump($dataFinal);

        $familyNumber = 0;
        $statusMbr = array(
            'ray' => 'velona',
            'reny' => 'velona'
        );
        if (count($dataFinal['ray']) > 0)
        {
            $ray = $dataFinal['ray'];
            var_dump($ray);
            $familyNumber++;
        }
        if (count($dataFinal['reny']) > 0)
        {
            $reny = $dataFinal['reny'];
            $familyNumber++;
        }
        $zanaka = $dataFinal['zanaka'];
        $nbrZanaka = count($zanaka);
        $familyNumber += $nbrZanaka;
    
        // echo $familyNumber;
        if ($familyNumber > 0)
        {
            require_once "../../Configurations/config.php";
            $finalMember = array();
            
            if (count($dataFinal['ray']) > 0)
            {
                if (strlen($dataFinal['ray']['nom']) > 1)
                {
                    $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$ray['nom'].'" AND prenomPersonne="'.$ray['prenom'].'"');
                    $rowSearch = $search->rowCount();
                    // var_dump($ray);
                    if ($rowSearch > 0)
                    {
                        $status = 'velona';
                        $statusAdd = null;
                        if ($ray['stats']['check'] == true)
                        {
                            $status = $ray['stats']['data'];
                            $statusMbr['ray'] = $status;
                        }
                        if (count($dataFinal['reny']) > 0)
                        {
                            if ($dataFinal['reny']['stats']['check'] == true)
                            {
                                $statusAdd = 'matyVady';
                            }
                        } else if ($dataFinal['mariazy']['matyVady'] == true)
                        {
                            $statusAdd = 'matyVady';
                        }
                        $data = $search->fetch();
                        $finalMember['ray'] = $data[0];
                        $insert = $bdd->prepare('UPDATE personne SET sexePersonne=:sexe, numeroPersonne=:numero, asaPersonne=:asa, sampanaPersonne=:sampana, katekistaPersonne=:katekista, 
                        mpiandryPersonne=:mpiandry, mpitoritenyPersonne=:mpitoriteny, andraikitraPersonne=:andraikitra, batisaPersonne=:batisa, mpandrayPersonne=:mpandray,mSivilyPersonne=:mSivily, 
                        mAraPinoPersonne=:mAraPino, statusPersonne=:statusP, statusAddPersonne=:statusAdd WHERE idPersonne='.$data[0]);
                        $insert->execute(array(
                            'sexe'=> $ray['sexe'],
                            'numero'=> $ray['numero'],
                            'asa'=> $ray['asa'],
                            'sampana'=> $ray['sampana'],
                            'andraikitra'=> $ray['andraikitra'],
                            'katekista'=> $ray['sefala']['katekista'],
                            'mpiandry'=> $ray['sefala']['mpiandry'],
                            'mpitoriteny'=> $ray['sefala']['mpitoriteny'],
                            'batisa'=> $ray['batisa'],
                            'mpandray'=> $ray['mpandray'],
                            'mSivily'=> $dataFinal['mariazy']['sivily'],
                            'mAraPino'=> $dataFinal['mariazy']['araPinoana'],
                            'statusP'=> $status,
                            'statusAdd' => $statusAdd
                        ));
                        $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$ray['nom'].'" AND prenomPersonne="'.$ray['prenom'].'"');
                        $data = $search->fetch();
                    } else {
                        $status = 'velona';
                        $statusAdd = null;
                        if ($ray['stats']['check'] == true)
                        {
                            $status = $ray['stats']['data'];
                            $statusMbr['ray'] = $status;
                        }
                        if (count($dataFinal['reny']) > 0)
                        {
                            if ($dataFinal['reny']['stats']['check'] == true)
                            {
                                $statusAdd = 'matyVady';
                            }
                        } else if ($dataFinal['mariazy']['matyVady'] == true)
                        {
                            $statusAdd = 'matyVady';
                        }
                        $insert = $bdd->prepare('INSERT INTO personne(nomPersonne,prenomPersonne,sexePersonne,numeroPersonne,asaPersonne,sampanaPersonne,katekistaPersonne,mpiandryPersonne,mpitoritenyPersonne,andraikitraPersonne,batisaPersonne,mpandrayPersonne,mSivilyPersonne,mAraPinoPersonne,statusPersonne,statusAddPersonne)
                        VALUES (:nom,:prenom,:sexe,:numero,:asa,:sampana,:katekista,:mpiandry,:mpitoriteny,:andraikitra,:batisa,:mpandray,:mSivily,:mAraPino,:statusP,:statusAdd)');
                        $insert->execute(array(
                            'nom'=> $ray['nom'],
                            'prenom'=> $ray['prenom'],
                            'sexe'=> $ray['sexe'],
                            'numero'=> $ray['numero'],
                            'asa'=> $ray['asa'],
                            'sampana'=> $ray['sampana'],
                            'andraikitra'=> $ray['andraikitra'],
                            'katekista'=> $ray['sefala']['katekista'],
                            'mpiandry'=> $ray['sefala']['mpiandry'],
                            'mpitoriteny'=> $ray['sefala']['mpitoriteny'],
                            'batisa'=> $ray['batisa'],
                            'mpandray'=> $ray['mpandray'],
                            'mSivily'=> $dataFinal['mariazy']['sivily'],
                            'mAraPino'=> $dataFinal['mariazy']['araPinoana'],
                            'statusP'=> $status,
                            'statusAdd' => $statusAdd
                        ));
                        $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$ray['nom'].'" AND prenomPersonne="'.$ray['prenom'].'"');
                        $data = $search->fetch();
                        $finalMember['ray'] = $data[0];
                        
                    }
                }
            }
            if (count($dataFinal['reny']) > 0)
            {
                if (strlen($dataFinal['reny']['nom']) > 1)
                {
                    $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$reny['nom'].'" AND prenomPersonne="'.$reny['prenom'].'"');
                    $rowSearch = $search->rowCount();
                    // var_dump($reny);
                    if ($rowSearch > 0)
                    {
                        $status = 'velona';
                        $statusAdd = null;
                        if ($ray['stats']['check'] == true)
                        {
                            $status = $reny['stats']['data'];
                            $statusMbr['ray'] = $status;
                        }
                        if (count($dataFinal['ray']) > 0)
                        {
                            if ($dataFinal['ray']['stats']['check'] == true)
                            {
                                $statusAdd = 'matyVady';
                            }
                        } else if ($dataFinal['mariazy']['matyVady'] == true)
                        {
                            $statusAdd = 'matyVady';
                        }
                        $data = $search->fetch();
                        $finalMember['ray'] = $data[0];
                        $insert = $bdd->prepare('UPDATE personne SET sexePersonne=:sexe, numeroPersonne=:numero, asaPersonne=:asa, sampanaPersonne=:sampana, katekistaPersonne=:katekista, 
                        mpiandryPersonne=:mpiandry, mpitoritenyPersonne=:mpitoriteny, andraikitraPersonne=:andraikitra, batisaPersonne=:batisa, mpandrayPersonne=:mpandray,mSivilyPersonne=:mSivily, 
                        mAraPinoPersonne=:mAraPino, statusPersonne=:statusP, statusAddPersonne=:statusAdd WHERE idPersonne='.$data[0]);
                        $insert->execute(array(
                            'sexe'=> $reny['sexe'],
                            'numero'=> $reny['numero'],
                            'asa'=> $reny['asa'],
                            'sampana'=> $reny['sampana'],
                            'andraikitra'=> $reny['andraikitra'],
                            'katekista'=> $reny['sefala']['katekista'],
                            'mpiandry'=> $reny['sefala']['mpiandry'],
                            'mpitoriteny'=> $reny['sefala']['mpitoriteny'],
                            'batisa'=> $reny['batisa'],
                            'mpandray'=> $reny['mpandray'],
                            'mSivily'=> $dataFinal['mariazy']['sivily'],
                            'mAraPino'=> $dataFinal['mariazy']['araPinoana'],
                            'statusP'=> $status,
                            'statusAdd' => $statusAdd
                        ));
                        $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$reny['nom'].'" AND prenomPersonne="'.$reny['prenom'].'"');
                        $data = $search->fetch();
                    } else {
                        $status = 'velona';
                        $statusAdd = null;
                        if ($reny['stats']['check'] == true)
                        {
                            $status = $reny['stats']['data'];
                            $statusMbr['reny'] = $status;
                        }
                        if (isset($dataFinal['ray']))
                        {
                            if ($dataFinal['ray']['stats']['check'] == true)
                            {
                                $statusAdd = 'matyVady';
                            }
                        }
                        $insert = $bdd->prepare('INSERT INTO personne(nomPersonne,prenomPersonne,sexePersonne,numeroPersonne,asaPersonne,sampanaPersonne,katekistaPersonne,mpiandryPersonne,mpitoritenyPersonne,andraikitraPersonne,batisaPersonne,mpandrayPersonne,mSivilyPersonne,mAraPinoPersonne,statusPersonne,statusAddPersonne)
                        VALUES (:nom,:prenom,:sexe,:numero,:asa,:sampana,:katekista,:mpiandry,:mpitoriteny,:andraikitra,:batisa,:mpandray,:mSivily,:mAraPino,:statusP,:statusAdd)');
                        $insert->execute(array(
                            'nom'=> $reny['nom'],
                            'prenom'=> $reny['prenom'],
                            'sexe'=> $reny['sexe'],
                            'numero'=> $reny['numero'],
                            'asa'=> $reny['asa'],
                            'sampana'=> $reny['sampana'],
                            'andraikitra'=> $reny['andraikitra'],
                            'katekista'=> $reny['sefala']['katekista'],
                            'mpiandry'=> $reny['sefala']['mpiandry'],
                            'mpitoriteny'=> $reny['sefala']['mpitoriteny'],
                            'batisa'=> $reny['batisa'],
                            'mpandray'=> $reny['mpandray'],
                            'mSivily'=> $dataFinal['mariazy']['sivily'],
                            'mAraPino'=> $dataFinal['mariazy']['araPinoana'],
                            'statusP'=> $status,
                            'statusAdd' => $statusAdd
                        ));
                        $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$reny['nom'].'" AND prenomPersonne="'.$reny['prenom'].'"');
                        $data = $search->fetch();
                        $finalMember['reny'] = $data[0];
                    }
                }
            }
            if (isset($zanaka))
            {
                $znkCount = 1;
                foreach ($zanaka as $zanak)
                {
                    $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$zanak['nom'].'" AND prenomPersonne="'.$zanak['prenom'].'"');
                    $rowSearch = $search->rowCount();
                    if ($rowSearch > 0)
                    {
                        $data = $search->fetch();
                        $finalMember['znk'.$znkCount] = $data[0];
                    } else {
                        $insert = $bdd->prepare('INSERT INTO personne(nomPersonne,prenomPersonne,sexePersonne,numeroPersonne,asaPersonne,sampanaPersonne,katekistaPersonne,mpiandryPersonne,mpitoritenyPersonne,andraikitraPersonne,batisaPersonne,mpandrayPersonne)
                        VALUES (:nom,:prenom,:sexe,:numero,:asa,:sampana,:katekista,:mpiandry,:mpitoriteny,:andraikitra,:batisa,:mpandray)');
                        $insert->execute(array(
                            'nom'=> $zanak['nom'],
                            'prenom'=> $zanak['prenom'],
                            'sexe'=> $zanak['sexe'],
                            'numero'=> $zanak['numero'],
                            'asa'=> $zanak['asa'],
                            'sampana'=> $zanak['sampana'],
                            'andraikitra'=> $zanak['andraikitra'],
                            'katekista'=> $zanak['sefala']['katekista'],
                            'mpiandry'=> $zanak['sefala']['mpiandry'],
                            'mpitoriteny'=> $zanak['sefala']['mpitoriteny'],
                            'batisa'=> $zanak['batisa'],
                            'mpandray'=> $zanak['mpandray'],
                        ));
                        $search = $bdd->query('SELECT idPersonne FROM personne WHERE nomPersonne="'.$zanak['nom'].'" AND prenomPersonne="'.$zanak['prenom'].'"');
                        $data = $search->fetch();
                        $finalMember['znk'][$znkCount] = $data[0];
                    }
                    $znkCount++;
                }
            }
            // echo count($dataFinal['ray']);
            // var_dump($dataFinal);

            if (count($dataFinal['ray']) > 0)
            {
                if (strlen($dataFinal['ray']['nom']) > 1 && $dataFinal['ray']['stats']['check'] == false)
                {
                    $nomTokantrano = $ray['nom']." ".$ray['prenom'];
                } else {
                    if (count($dataFinal['reny']) > 0)
                    {
                        $nomTokantrano = $reny['nom']." ".$reny['prenom'];
                    }
                }
            } else if (count($dataFinal['reny']) > 0)
            {
                $nomTokantrano = $reny['nom']." ".$reny['prenom'];
            }
            // var_dump($nomTokantrano);
            if ((count($dataFinal['ray']) > 0) || (count($dataFinal['reny']) > 0))
            {
                $stop = false;
                $search = $bdd->query("SELECT idTokantrano FROM tokantrano WHERE nomTokantrano='$nomTokantrano'");
                $rowSearch = $search->rowCount();
                echo $rowSearch;
                if ($rowSearch > 0)
                {
                    $data = $search->fetch();
                    $finalMember['tokantrano'] = $data[0];
                    $stop = true;
                    // header("Location: ../viewTokantrano.php?id=".$finalMember['tokantrano']);
                    // echo "existe";
                } else {
                    $insert = $bdd->prepare('INSERT INTO tokantrano(nomTokantrano,lotTokantrano,parcelleTokantrano) VALUES (:nom,:lot,:parcelle)');
                    $insert->execute(array(
                        'nom'=>$nomTokantrano,
                        'lot'=>$lot,
                        'parcelle'=>$parcelle
                    ));
                    $search = $bdd->query("SELECT idTokantrano FROM tokantrano WHERE nomTokantrano='$nomTokantrano'");
                    $data = $search->fetch();
                    $finalMember['tokantrano'] = $data[0];
                }
                // Insert Member
                if (isset($finalMember['tokantrano']) && !$stop)
                {
                    if (isset($finalMember['ray']))
                    {
                        $bdd->query("INSERT INTO member(tokantranoMember,statusMember,personneMember,statusPersonneMember) VALUES (".$finalMember['tokantrano'].",'ray',".$finalMember['ray'].",'".$statusMbr['ray']."')");
                    } else {
                        $bdd->query("INSERT INTO member(tokantranoMember,statusMember,personneMember,statusPersonneMember) VALUES (".$finalMember['tokantrano'].",'ray','0','noInfo')");
                    }
                    if (isset($finalMember['reny'])) {
                        $bdd->query("INSERT INTO member(tokantranoMember,statusMember,personneMember,statusPersonneMember) VALUES (".$finalMember['tokantrano'].",'reny',".$finalMember['reny'].",'".$statusMbr['reny']."')");
                    } else {
                        $bdd->query("INSERT INTO member(tokantranoMember,statusMember,personneMember,statusPersonneMember) VALUES (".$finalMember['tokantrano'].",'reny','0', 'noInfo')");
                    }
                    if (isset($finalMember["znk"])) {
                        foreach ($finalMember["znk"] as $zanakaA)
                        {
                            $bdd->query("INSERT INTO member(tokantranoMember,statusMember,personneMember) VALUES (".$finalMember['tokantrano'].",'zanaka',".$zanakaA.")");
                        }
                    }
                    echo "done";
                }
                header("Location: ../viewTokantrano.php?id=".$finalMember['tokantrano']);

                // var_dump($finalMember);
            }
        }
    }

?>