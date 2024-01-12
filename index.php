<?php
    session_start();
    if (isset($_SESSION['administrateur']))
    {
        header("Location: Administrator/");
    } else if (isset($_SESSION['utilisateur'])) {
        header("Location: user/");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/Semantic_UI/semantic.css">
    <link rel="stylesheet" href="Styles/connecter.css">
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <title>Se Connecter</title>
</head>
<body>
    <style>
        #username::placeholder,#password::placeholder{color: grey;}
    </style>
    <div id="container">
        <div class="logoSoratra">
            <div class='logoFJKM'>
                <img src="Pictures/Picture1.png" alt="">
            </div>
            <div class="smasina">
                <div class="word"><b class='bold'>"</b>Tsy hafa ity, fa tranon'Andriamanitra sy vavahadin'ny lanitra<b class='bold'>"</b></div>
                <div class="verset">Genesisy 28: 17<sup>b</sup></div>
                
            </div>
        </div>
        <form action="connection.php" class="ui form" method="post">
            <div id="card-sign">
                <div class="logo">
                    <img src="Pictures/logoBetela.jpg" alt="Logo">
                </div>
            </div>
            <!-- <h2><b>Identifiez-Vous</b></h2> -->
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required <?php 
                if (isset($_GET['us']))
                {
                    echo "value='".$_GET['us']."'";
                }
                ?>><br><br>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required><br><br>
            <div style="width: 100%;text-align: center;">
                <b style="color:red;">
                    <?php
                        if (isset($_GET['err']))
                        {
                            if ($_GET['err'] == 'verif')
                            {
                                echo "Verifier votre login ou mot de passe";
                            }
                        }
                    ?>
                </b>
            </div>
            <button type="submit" class="ui button purple">Se connecter</button><br>
        </form>
    </div>
    <script>
        console.log("<?= hash('sha512','user1');?>")
    </script>
    <style>
        
    </style>
</body>
<footer>
    Version 2.0.1
</footer>
</html>