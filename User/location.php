<?php 
    session_start(); 
    if(!isset($_SESSION['utilisateur']))
    {
        header("Location:../");
    }
    $cpage = 'Locations';
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
    <link rel="stylesheet" href="Styles/location.css">
    <title>Locations</title>
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
        <?php include "Components/location.php" ?>
    </div>
    <?php
        if (isset($_GET['act']) && isset($_GET['res']) && isset($_GET['data']))
        {
            // var_dump($_GET);
            $action = htmlspecialchars($_GET['act']);
            $result = htmlspecialchars($_GET['res']);
            $data = htmlspecialchars($_GET['data']);
            if ($action == "fkt")
            {
                if ($result == "exi")
                {
                    ?>
                    <script>
                        notification("Fokontany '<?= $data; ?>' existante")
                    </script>
                    <?php
                } else if ($result == "len")
                {
                    ?>
                    <script>
                        notification("Nom fokontany '<?= $data; ?>' trop court")
                    </script>
                    <?php
                } else if ($result == "done")
                {
                    ?>
                    <script>
                        notification("Ajout du fokontany '<?= $data; ?>' avec succès")
                    </script>
                    <?php
                } else if ($result == "err")
                {
                    ?>
                    <script>
                        notification("Erreur lors de l'ajout du fokontany '<?= $data; ?>'")
                    </script>
                    <?php
                }
            } else if ($action == "prc")
            {
                if ($result == "exi")
                {
                    ?>
                    <script>
                        notification("Parcelle '<?= $data; ?>' existante")
                    </script>
                    <?php
                } else if ($result == "len")
                {
                    ?>
                    <script>
                        notification("Parcelle '<?= $data; ?>' trop court")
                    </script>
                    <?php
                } else if ($result == "done")
                {
                    ?>
                    <script>
                        notification("Ajout du parcelle '<?= $data; ?>' avec succès")
                    </script>
                    <?php
                } else if ($result == "err")
                {
                    ?>
                    <script>
                        notification("Erreur lors de l'ajout du parcelle '<?= $data; ?>'")
                    </script>
                    <?php
                }
            }
        }
    ?>
</body>
</html>