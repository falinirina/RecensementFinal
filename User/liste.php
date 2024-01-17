<?php
    if (isset($_GET["categorie"]) && isset($_GET["faritra"]) && isset($_GET["type"]))
    {
        $categorie = htmlspecialchars($_GET["categorie"]);
        $faritra = htmlspecialchars($_GET["faritra"]);
        $type = htmlspecialchars($_GET["type"]);
        require_once "../Configurations/config.php";

        $faritraData = $bdd->query("SELECT * FROM faritra WHERE idFaritra = $faritra");
        $faritraData = $faritraData->fetch();

        if ($categorie == "mpandray")
        {    
            ?>
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../Styles/Semantic_UI/semantic.css">
                    <link rel="stylesheet" href="Styles/light.css">
                    <link rel="stylesheet" href="Styles/liste.css">
                    <title>Liste Mpandray Faritra <?= $faritraData["nomFaritra"] ?></title>
                </head>
                <body>
                    <div id="contenue">
                        <?php
                                if ($type == "all")
                                {
                                    $dataMpiangona = $bdd->query("SELECT * FROM personne INNER JOIN parcelle ON personne.parcelleMpandrayPersonne = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
                                    INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE personne.mpandrayPersonne = 'eny' AND faritra.idFaritra = $faritra ORDER BY nomPersonne, prenomPersonne");
                                    $total = $dataMpiangona->rowCount();
                                    $dataMpiangona = $dataMpiangona->fetchAll();
                                    $count = 1;
                                    // var_dump($dataMpiangona);
                                    ?>
                                    <div class="bg-color gTitle">Liste Mpandray Faritra <?= $faritraData["nomFaritra"] ?> / Total: <?= $total ?></div>
                                    <div class="listeDiv">
                                        <table class="ui table">
                                            <tr>
                                                <th>Numero</th>
                                                <th>Nom</th>
                                                <th>Prenoms</th>
                                                <th>Zana-Paritra</th>
                                            </tr>
                                            <?php
                                            foreach ($dataMpiangona as $mpiangona)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $mpiangona['nomPersonne'] ?></td>
                                                    <td><?= $mpiangona['prenomPersonne'] ?></td>
                                                    <td><?= $mpiangona['nomZanaParitra'] ?></td>
                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <?php
                                }
                            ?>
                    </div>
                </body>
                </html>
            <?php
        }
    } else {
        header("Location: index.php");
    }
    
    ?>