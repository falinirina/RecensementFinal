<?php
    
    require_once "../../Configurations/config.php";
    
    $res = $bdd->query("SELECT * FROM personne WHERE mpandrayPersonne='eny'");
    $res = $res->fetchAll();

    foreach ($res as $personne)
    {
        $temp = $bdd->query("SELECT * FROM member INNER JOIN tokantrano on member.tokantranoMember = tokantrano.idTokantrano INNER JOIN parcelle on tokantrano.parcelleTokantrano = parcelle.idParcelle
        INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN
        faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE member.personneMember = ".$personne["idPersonne"]);
        $row = $temp->rowCount();
        $temp = $temp->fetchAll();
        if ($row > 1)
        {
            $count = 0;
            $data = array(
                'parcelle' => null
            );
            foreach ($temp as $tok)
            {
                // var_dump($temp);
                if ($count == 0)
                {
                    // var_dump($tok);
                    $data = array(
                        'parcelle' => $tok['idParcelle']
                    );
                    $count++;
                } else {
                    if ($tok['statusMember'] == 'ray' || $tok['statusMember'] == 'reny')
                    {
                        $data = array(
                            'parcelle' => $tok['idParcelle']
                        );
                    }
                }
            }
        } else {
            foreach ($temp as $tok)
            {
                // var_dump($tok);
                $data = array(
                    'parcelle' => $tok['idParcelle']
                );
            }
        }
        // var_dump($data);
        // Inserer Data
        $bdd->query("UPDATE personne SET parcelleMpandrayPersonne='".$data['parcelle']."' WHERE idPersonne=".$personne['idPersonne']);
    }
    header("Location: configDefinitif.php");

?>