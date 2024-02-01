<?php
    require_once "../../Configurations/config.php";
    $data = $bdd->query("SELECT * FROM personne");
    $data = $data->fetchAll();

    $res = [];
    $count = 0;
    foreach ($data as $row) {
        $id = $row["idPersonne"];
        $nom = $row['nomPersonne'];
        $prenom = $row['prenomPersonne'];
        $temp = $bdd->query("SELECT * FROM personne WHERE nomPersonne=\"$nom\" AND prenomPersonne=\"$prenom\"");
        $row = $temp->rowCount();
        if ($row > 1) {
            $res[$count] = $temp->fetchAll();
            // $count = $row;
            $count++;
        }
    }
    echo $count;
    var_dump($res);
?>
