<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=beteladb', "root", "root");
        // $bdd = new PDO('mysql:host=192.168.88.49;dbname=betelaproject', "falyApp", "falyApp");
    }catch(Exception $e)
    {
        echo "Erreur de la connection a la base de donnee";
    }
?>