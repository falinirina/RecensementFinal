<?php
    $id = htmlspecialchars($_GET['id']);
    require_once "../Configurations/config.php";

    $dataMpiangona = $bdd->query("SELECT * FROM personne WHERE idPersonne = $id");
    $dataMpiangona = $dataMpiangona->fetch();
    $dataTok = $bdd->query("SELECT * FROM member INNER JOIN tokantrano ON member.tokantranoMember = tokantrano.idTokantrano INNER JOIN parcelle on tokantrano.parcelleTokantrano = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra 
    INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE personneMember = $id");
    $dataTok = $dataTok->fetchAll();

    // var_dump($dataMpiangona);
    // var_dump($dataTok);

?>

<div id="editInfo">
    <div class="bg-color">
        <div><h5 style="text-align: center"><b>Modifier Information</b></h5></div>
        <form action="Traitements/modMpiangona.php" method="POST" class="ui form">
            <input type="number" name="idPersonne" style="display: none" value="<?= $dataMpiangona["idPersonne"] ?>">
            <div>
                <div>
                    <label class="ui label" for="nom" required>Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= $dataMpiangona["nomPersonne"] ?>">
                </div>
                <div>
                    <label class="ui label" for="prenom">Prenom</label>
                    <input type="text" id='prenom' name="prenom" value="<?= $dataMpiangona["prenomPersonne"] ?>">
                </div>
            </div>
            <div>
                <div>
                    <label class="ui label" for="numero">Numero</label>
                    <input type="text" id='numero' name="numero" value="<?= $dataMpiangona["numeroPersonne"] ?>">
                </div>
                <div>
                    <label class="ui label" for="asa">Asa</label>
                    <input type="text" id='asa' name="asa" value="<?= $dataMpiangona["asaPersonne"] ?>">
                </div>
            </div>
            <div class="buttonDiv">
                <button type="submit" class="ui button green">Modifier</button>
                <a class="ui button red" onclick="fermerEditI()">Annuler</a>
            </div>
        </form>
    </div>
</div>

<div id="editFanamasinana">
    <div class="bg-color">
        <div><h5 style="text-align: center"><b>Modifier Information</b></h5></div>
        <form action="Traitements/modMpiangona.php" method="POST" class="ui form">
            <input type="number" name="idPersonneFanamasinana" style="display: none" value="<?= $dataMpiangona["idPersonne"] ?>">
            <div>
                <label class="ui label" for="batisa">Batisa</label>
                <select id="batisa" name="batisa">
                    <option value="tsia">Tsia</option>
                    <option value="eny" <?php if ($dataMpiangona["batisaPersonne"] == "eny") { echo "selected"; }  ?>>Eny</option>
                </select>
            </div>

            <div>
                <label class="ui label" for="mpandray">Mpandray</label>
                <select id="mpandray" name="mpandray">
                    <option value="tsia">Tsia</option>
                    <option value="eny" <?php if ($dataMpiangona["mpandrayPersonne"] == "eny") { echo "selected"; }  ?>>Eny</option>
                </select>
            </div>
            <div class="buttonDiv">
                <button type="submit" class="ui button green">Modifier</button>
                <a class="ui button red" onclick="fermerEditF()">Annuler</a>
            </div>
        </form>
    </div>    
</div>

<div class="topView">
    <div class="idView">
        <?php
            if ($dataMpiangona['sexePersonne'] == 'M')
            {
                ?>
                    <img src="../Pictures/user-profile.png" alt="Sary Lahy">
                    <?php
            } else {
                ?>
                    <img src="../Pictures/user-profile-woman.png" alt="Sary Vavy">
                    <?php
            } 
            ?>
        <div class="idMpiangona">
            <b><?= $dataMpiangona['idPersonne'] ?></b>
        </div>
    </div>
    <div class="infoDiv bg-color">
        <div class="info">
            <div>
                <div><?= $dataMpiangona['nomPersonne'] ?></div>
                <div><?= $dataMpiangona['prenomPersonne'] ?></div>
            </div>
            <div>
                <div>Numero: <?php
                    if (strlen($dataMpiangona['numeroPersonne']) > 0)
                    {
                        echo $dataMpiangona['numeroPersonne'];
                    } else {
                        echo "Non defini";
                    }
                ?></div>
                <div>Asa atao: <?php 
                    if (strlen($dataMpiangona["asaPersonne"]) > 0)
                    {
                        echo $dataMpiangona['asaPersonne'];
                    } else {
                        echo "Non defini";
                    }
                ?></div>
            </div>
        </div>
        <div class="button">
            <i class="ui icon edit" onclick="openEditI()"></i>
        </div>
    </div>
</div>
<hr>
<div class="middleView">
    <div class="bg-color">
        <div class="sefalaTitle">
            <div><b>Sefala</b></div>
            <div><i class="ui icon edit"></i></div>
        </div>
        <div>
            <div>Katekista: <?php echo ($dataMpiangona['katekistaPersonne']) ? "tsia" : "eny" ?></div>
            <div>Mpiandry: <?php echo ($dataMpiangona['mpiandryPersonne']) ? "tsia" : "eny" ?></div>
            <div>Mpitoriteny: <?php echo ($dataMpiangona['mpitoritenyPersonne']) ? "tsia" : "eny" ?></div>
        </div>
    </div>
    <div class="bg-color">
        <div class="sefalaTitle">
            <div><b>Fanamasinana</b></div>
            <div><i class="ui icon edit" onclick="openEditF()"></i></div>
        </div>
        <div>
            <div>Vita batisa: <?= $dataMpiangona['batisaPersonne'] ?></div>
            <div>Mpandray: <?= $dataMpiangona['mpandrayPersonne'] ?></div>
        </div>
    </div>
    <div class="bg-color">
        <div class="sefalaTitle">
            <div><b>Mariazy</b></div>
            <div><i class="ui icon edit"></i></div>
        </div>
        <div>
            <div>Sivily: <?= $dataMpiangona["mSivilyPersonne"] ?></div>
            <div>Ara-Pinoana: <?= $dataMpiangona["mAraPinoPersonne"] ?></div>
        </div>
    </div>
</div>
<div class="bg-color mTitle">
    Information Additionnelle
</div>
<div class="middleView">
    <div class="bg-color">
        <div class="sefalaTitle">
            <div><b>Sampana</b></div>
            <div><i class="ui icon edit"></i></div>
        </div>
        <div>
            <div><?php echo (strlen($dataMpiangona['sampanaPersonne']) > 0) ? $dataMpiangona['sampanaPersonne'] : "Tsisy" ?></div>
        </div>
    </div>
    <div class="bg-color">
        <div><b>Andraikitra</b></div>
        <div>
            <div><?php echo (strlen($dataMpiangona['andraikitraPersonne']) > 0) ? $dataMpiangona['andraikitraPersonne'] : "Tsisy" ?></div>
        </div>
    </div>
    <div class="bg-color">
        <div><b>Date d'ajout</b></div>
        <div>
            <div><?php echo (strlen($dataMpiangona['ajoutPersonne']) > 0) ? $dataMpiangona['ajoutPersonne'] : "Tsisy" ?></div>
        </div>
    </div>
</div>
<div class="bg-color mTitle">
    Affiliation Tokantrano
</div>
<div class="tokantrano">
    <?php
        foreach ($dataTok as $tokantrano)
        {
            // var_dump($tokantrano);
            ?>
            <div class="tokDiv">
                <div class="idView bg-color">
                    <b>
                        <?= $tokantrano["idTokantrano"]; ?>
                    </b>
                </div>
                <div class="detailView bg-color">
                    <div>
                        <div>Lohany: <?= $tokantrano['nomTokantrano'] ?></div>
                        <div>Faritra: <?= $tokantrano['nomFaritra'] ?></div>
                        <div>Zana-Paritra: <?= $tokantrano['nomZanaParitra'] ?></div>
                        <div>Fokontany: <?= $tokantrano['nomFokontany'] ?></div>
                        <div>Logement: <?= $tokantrano['lotTokantrano'] ?></div>
                        <div>Parcelle: <?= $tokantrano['Parcelle'] ?></div>
                    </div>
                    <div>
                        Status: <?= $tokantrano['statusMember'] ?>
                    </div>
                    <div class="button">
                        <a href="viewTokantrano.php?id=<?= $tokantrano['idTokantrano'] ?>"><i class="edit icon eye"></i></a>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
</div>

<script>
    function fermerEditI()
    {
        $("#editInfo").css('display', 'none')
    }
    function openEditI()
    {
        $("#editInfo").css('display', 'flex')
    }
    function fermerEditF()
    {
        $("#editFanamasinana").css('display', 'none')
    }
    function openEditF()
    {
        $("#editFanamasinana").css('display', 'flex')
    }
</script>