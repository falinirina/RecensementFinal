<?php 
    session_start(); 
    $cpage = 'Mpiangona';
    if(!isset($_SESSION['utilisateur']))
    {
        header("Location:../");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Semantic_UI/semantic.css">
    <link rel="stylesheet" href="../Styles/W3/w3.css">
    <link rel="stylesheet" href="../Styles/W3/w3-theme-teal.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/viewMpiangona.css">
    <title>View Mpiangona Numero <?= $_GET['id'] ?></title>
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <?php
        if (isset($_SESSION['darkMode']))
        {
            if ($_SESSION['darkMode'] == "on"){echo '<link rel="stylesheet" href="Styles/dark.css">'."\n";}
            else{echo '<link rel="stylesheet" href="Styles/light.css">'."\n";}
        }
    ?>
</head>
<body>
    <script src="../Jquery/jquery.js"></script>
    <?php include "Components/navbar.php" ?>
    <div id="contenue">
        <?php include "Components/viewMpiangona.php" ?>
    </div>
</body>
</html>