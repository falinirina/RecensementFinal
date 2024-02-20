<?php
    function tableMpandray($data)
    {
        $count = 1;
        ?>
        <div class="listeDiv">
            <table class="ui table">
                <tr>
                    <th>Numero</th>
                    <th>Nom</th>
                    <th>Prenoms</th>
                    <th>Zana-Paritra</th>
                </tr>
                <?php
                foreach ($data as $mpiangona)
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
    function tableMariazy($data)
    {
        ?>
        <div class="listeDiv">
            <table class="ui table">
                <tr>
                    <th>NumeroTokantrano</th>
                    <th>Nom</th>
                    <th>Prenoms</th>
                    <th>Zana-Paritra</th>
                </tr>
                <?php
                foreach ($data as $tokantrano)
                {
                    if (count($tokantrano) == 2)
                    {
                        // var_dump($tokantrano);
                        ?>
                        <tr>
                            <td rowspan="2"><?= $tokantrano['ray']['idTokantrano']; ?></td>
                            <td><?= $tokantrano['ray']['nomPersonne']; ?></td>
                            <td><?= $tokantrano['ray']['prenomPersonne']; ?></td>
                            <td rowspan="2"><?= $tokantrano['ray']['nomZanaParitra']; ?></td>
                        </tr>
                        <tr>
                            <td><?= $tokantrano['reny']['nomPersonne']; ?></td>
                            <td><?= $tokantrano['reny']['prenomPersonne']; ?></td>
                        </tr>
                        <?php
                    } else if (count($tokantrano) == 1) {
                        if (isset($tokantrano['ray']))
                        {
                            ?>
                            <tr>
                                <td rowspan="2"><?= $tokantrano['ray']['idTokantrano']; ?></td>
                                <td><?= $tokantrano['ray']['nomPersonne']; ?></td>
                                <td><?= $tokantrano['ray']['prenomPersonne']; ?></td>
                                <td rowspan="2"><?= $tokantrano['ray']['nomZanaParitra']; ?></td>
                            </tr>
                            <tr style="color: red; font-weight: bold">
                                <td>Non définie</td>
                                <td>Non définie</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }

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
                                // var_dump($dataMpiangona);
                                ?>
                                <div class="bg-color gTitle">Liste Mpandray Faritra <?= $faritraData["nomFaritra"] ?> / Total: <?= $total ?></div>
                                <?php
                                tableMpandray($dataMpiangona);
                            } else if ($type == "old")
                            {
                                $dataMpiangona = $bdd->query("SELECT * FROM personne INNER JOIN parcelle ON personne.parcelleMpandrayPersonne = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
                                INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE personne.mpandrayPersonne = 'eny' AND faritra.idFaritra = $faritra AND updateMpandrayPersonne IS NULL ORDER BY nomPersonne, prenomPersonne");
                                $total = $dataMpiangona->rowCount();
                                $dataMpiangona = $dataMpiangona->fetchAll();
                                $count = 1;
                                // var_dump($dataMpiangona);
                                ?>
                                <div class="bg-color gTitle">Liste Mpandray Faritra <?= $faritraData["nomFaritra"] ?> Taloha / Total: <?= $total ?></div>
                                <?php
                                tableMpandray($dataMpiangona);
                            } else if ($type == "new")
                            {
                                $dataMpiangona = $bdd->query("SELECT * FROM personne INNER JOIN parcelle ON personne.parcelleMpandrayPersonne = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
                                INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE personne.mpandrayPersonne = 'eny' AND faritra.idFaritra = $faritra AND updateMpandrayPersonne IS NOT NULL ORDER BY nomPersonne, prenomPersonne");
                                $total = $dataMpiangona->rowCount();
                                $dataMpiangona = $dataMpiangona->fetchAll();
                                $count = 1;
                                // var_dump($dataMpiangona);
                                ?>
                                <div class="bg-color gTitle">Liste Mpandray Faritra <?= $faritraData["nomFaritra"] ?> Vaovao / Total: <?= $total ?></div>
                                <?php
                                tableMpandray($dataMpiangona);
                            }
                        ?>
                    </div>
                </body>
                </html>
            <?php
        } else if ($categorie == "msivily")
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
                    <title>Mariazy Sivily Faritra <?= $faritraData["nomFaritra"] ?></title>
                </head>
                <body>
                    <div id="contenue">
                        <?php
                            if ($type == "vita")
                            {
                                $myData = $bdd->query("SELECT idTokantrano, statusMember, nomPersonne, prenomPersonne, nomZanaParitra FROM member INNER JOIN tokantrano ON member.tokantranoMember=tokantrano.idTokantrano INNER JOIN personne ON member.personneMember=personne.idPersonne INNER JOIN parcelle ON tokantrano.parcelleTokantrano = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
                                INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE (statusMember='ray' OR statusMember='reny') AND personne.statusPersonne='velona' AND faritra.idFaritra = $faritra AND personne.mSivilyPersonne='eny' ORDER BY tokantranoMember, statusMember");
                                $myData = $myData->fetchAll();
                                $result = array();
                                $nowId = 0;
                                foreach ($myData as $datum)
                                {
                                    if ($nowId == 0) {
                                        $nowId = $datum['idTokantrano'];
                                        $result[$nowId][$datum['statusMember']] = $datum;
                                    } else {
                                        if ($nowId == $datum['idTokantrano'])
                                        {
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        } else {
                                            $nowId = $datum['idTokantrano'];
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        }
                                    }
                                }
                                // var_dump($result);
                                ?>
                                <div class="bg-color gTitle">Liste vita mariazy sivily Faritra <?= $faritraData["nomFaritra"] ?> </div>
                                <?php
                                tableMariazy($result);
                            } else if ($type == "tvita")
                            {
                                $myData = $bdd->query("SELECT idTokantrano, statusMember, nomPersonne, prenomPersonne, nomZanaParitra FROM member INNER JOIN tokantrano ON member.tokantranoMember=tokantrano.idTokantrano INNER JOIN personne ON member.personneMember=personne.idPersonne INNER JOIN parcelle ON tokantrano.parcelleTokantrano = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
                                INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE (statusMember='ray' OR statusMember='reny') AND personne.statusPersonne='velona' AND faritra.idFaritra = $faritra AND personne.mSivilyPersonne='tsia' ORDER BY tokantranoMember, statusMember");
                                $myData = $myData->fetchAll();
                                $result = array();
                                $nowId = 0;
                                foreach ($myData as $datum)
                                {
                                    if ($nowId == 0) {
                                        $nowId = $datum['idTokantrano'];
                                        $result[$nowId][$datum['statusMember']] = $datum;
                                    } else {
                                        if ($nowId == $datum['idTokantrano'])
                                        {
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        } else {
                                            $nowId = $datum['idTokantrano'];
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        }
                                    }
                                }
                                // var_dump($result);
                                ?>
                                <div class="bg-color gTitle">Liste tsy vita mariazy sivily Faritra <?= $faritraData["nomFaritra"] ?> </div>
                                <?php
                                tableMariazy($result);
                            }
                        ?>
                    </div>
                </body>
                </html>
            <?php
        } else if ($categorie == "marapinoana")
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
                    <title>Mariazy ara-pinoana Faritra <?= $faritraData["nomFaritra"] ?></title>
                </head>
                <body>
                    <div id="contenue">
                        <?php
                            if ($type == "vita")
                            {
                                $myData = $bdd->query("SELECT idTokantrano, statusMember, nomPersonne, prenomPersonne, nomZanaParitra FROM member INNER JOIN tokantrano ON member.tokantranoMember=tokantrano.idTokantrano INNER JOIN personne ON member.personneMember=personne.idPersonne INNER JOIN parcelle ON tokantrano.parcelleTokantrano = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
                                INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE (statusMember='ray' OR statusMember='reny') AND personne.statusPersonne='velona' AND faritra.idFaritra = $faritra AND personne.mAraPinoPersonne='eny' ORDER BY tokantranoMember, statusMember");
                                $myData = $myData->fetchAll();
                                $result = array();
                                $nowId = 0;
                                foreach ($myData as $datum)
                                {
                                    if ($nowId == 0) {
                                        $nowId = $datum['idTokantrano'];
                                        $result[$nowId][$datum['statusMember']] = $datum;
                                    } else {
                                        if ($nowId == $datum['idTokantrano'])
                                        {
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        } else {
                                            $nowId = $datum['idTokantrano'];
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        }
                                    }
                                }
                                // var_dump($result);
                                ?>
                                <div class="bg-color gTitle">Liste vita mariazy ara-pinoana Faritra <?= $faritraData["nomFaritra"] ?> </div>
                                <?php
                                tableMariazy($result);
                            } else if ($type == "tvita")
                            {
                                $myData = $bdd->query("SELECT idTokantrano, statusMember, nomPersonne, prenomPersonne, nomZanaParitra FROM member INNER JOIN tokantrano ON member.tokantranoMember=tokantrano.idTokantrano INNER JOIN personne ON member.personneMember=personne.idPersonne INNER JOIN parcelle ON tokantrano.parcelleTokantrano = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
                                INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE (statusMember='ray' OR statusMember='reny') AND personne.statusPersonne='velona' AND faritra.idFaritra = $faritra AND personne.mAraPinoPersonne='tsia' ORDER BY tokantranoMember, statusMember");
                                $myData = $myData->fetchAll();
                                $result = array();
                                $nowId = 0;
                                foreach ($myData as $datum)
                                {
                                    if ($nowId == 0) {
                                        $nowId = $datum['idTokantrano'];
                                        $result[$nowId][$datum['statusMember']] = $datum;
                                    } else {
                                        if ($nowId == $datum['idTokantrano'])
                                        {
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        } else {
                                            $nowId = $datum['idTokantrano'];
                                            $result[$nowId][$datum['statusMember']] = $datum;
                                        }
                                    }
                                }
                                // var_dump($result);
                                ?>
                                <div class="bg-color gTitle">Liste tsy vita mariazy ara-pinoana Faritra <?= $faritraData["nomFaritra"] ?> </div>
                                <?php
                                tableMariazy($result);
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