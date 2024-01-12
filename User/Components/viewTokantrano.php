<?php
    $id = htmlspecialchars($_GET['id']);
    require_once "../Configurations/config.php";

    $dataTok = $bdd->query("SELECT * FROM tokantrano WHERE idTokantrano=$id");
    $dataTok = $dataTok->fetch();
    $dataAdresse = $bdd->query("SELECT * FROM parcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra 
    INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE parcelle.idParcelle = ".$dataTok['parcelleTokantrano']);
    $dataAdresse = $dataAdresse->fetch();
    $dataMember = $bdd->query("SELECT * FROM member INNER JOIN personne ON personneMember = idPersonne WHERE tokantranoMember=$id");
    $memberCount = $dataMember->rowCount();
    $dataMember = $dataMember->fetchAll();

    // var_dump($dataTok);
    $zanakaN = 0;
    $dataTemp = array(
        'ray' => '',
        'reny' => '',
        'zanaka' => []
    );
    foreach ($dataMember as $membre) {
        if ($membre['statusMember'] == 'ray')
        {
            $dataTemp['ray'] = $membre;
        }
        else if ($membre['statusMember'] == 'reny')
        {
            $dataTemp['reny'] = $membre;
        } else {
            $zanakaN++;
            $dataTemp['zanaka'][$zanakaN] = $membre;
        }
    }
    // var_dump($dataAdresse);
    // var_dump($dataTemp);

?>
<?php 
    if (is_array($dataTemp['ray']) && is_array($dataTemp['reny']))
    {
        ?>
        <div id="editMariasy">
            <div class="bg-color">
                <div><h5 style="text-align: center"><b>Modifier Information</b></h5></div>
                <form action="Traitements/modMariazy.php" method="POST" class="ui form">
                    <input type="number" name="idTok" style="display: none" value="<?= $dataTok["idTokantrano"]; ?>">
                    <input type="number" name="ray" style="display: none" value="<?= $dataTemp["ray"]["idPersonne"] ?>">
                    <input type="number" name="reny" style="display: none" value="<?= $dataTemp["reny"]['idPersonne'] ?>">
                    <div>
                        <label class="ui label" for="msivilyRAD">Sivily</label>
                        <select id="msivilyRAD" name="msivilyRAD">
                            <option value="tsia">Tsia</option>
                            <option value="eny" <?php if ($dataTemp['ray']['mSivilyPersonne'] == "eny") { echo "selected"; } ?> >Eny</option>
                        </select>
                    </div>
                    <div>
                        <label class="ui label" for="marapinRAD">Ara-pinoana</label>
                        <select id="marapinRAD" name="marapinRAD">
                            <option value="tsia">Tsia</option>
                            <option value="eny" <?php if ($dataTemp['ray']['mAraPinoPersonne'] == "eny") { echo "selected"; } ?>>Eny</option>
                        </select>
                    </div>
                    <div class="buttonDiv">
                        <button type="submit" class="ui button green">Modifier</button>
                        <a class="ui button red" onclick="fermerEditM()">Annuler</a>
                    </div>
                </form>
            </div>    
        </div>
        <?php
    }
?>

<div id="editLogement">
    <div class="bg-color">
        <div><h5 style="text-align: center"><b>Modifier Tokantrano</b></h5></div>
        <form action="Traitements/modLogement.php" method="POST" class="ui form">
            <input type="number" name="idTokantrano" style="display: none" value="<?= $dataTok["idTokantrano"]; ?>">
            <div>
                <div>
                    <label class="ui label" for="lot" required>Nom</label>
                    <input type="text" id="lot" name="lot" value="<?= $dataTok['lotTokantrano'] ?>">
                </div>
            </div>
            <div class="buttonDiv">
                <button type="submit" class="ui button green">Modifier</button>
                <a class="ui button red" onclick="fermerEditL()">Annuler</a>
            </div>
        </form>
    </div>
</div>

<div id="addPersonne">
    <form method="POST" action="Traitements/addMemberTok.php" class="form01 ui form bg-color">
        <input type="number" name="idTok" style="display: none" value="<?= $dataTok["idTokantrano"]; ?>">
        <div style="display:flex;justify-content: space-around;
        align-items: center;
        flex-direction: row;">
            <div class="titleM" id="titleAdd">Ajouter Membre</div>
            <div>
                <select name="type" id="type">
                    <option value="zanaka">Zanaka</option>
                    <option value="zafy">Zafy</option>
                </select>
            </div>
        </div>
        <hr>
        <div>
            <div>
                <div class="divFlexPers">
                    <div>
                        <label class="ui label" for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div>
                        <label class="ui label" for="prenom">Prenom</label>
                        <input type="text" id='prenom' name="prenom">
                    </div>
                </div>
                <div class="divFlexPers">
                    <div style="width: 150px;" id="sexeDiv">
                        <label class="ui label" for="sexe">Sexe</label>
                        <select id="sexe" name="sexe">
                            <option value="M">Lahy</option>
                            <option value="F">Vavy</option>
                        </select>
                    </div>
                    <div>
                        <label class="ui label" for="numero">Numero</label>
                        <input type="text" id='numero' name="numero">
                    </div>
                    <div>
                        <label class="ui label" for="asa">Asa</label>
                        <input type="text" id='asa' name="asa">
                    </div>
                </div>
                
                <div class="divFlexPers">
                    <div>
                        <label class="ui label" for="sampana">Sampana</label>
                        <input type="text" id="sampana" name="sampana">
                    </div>
                    
                    <div>
                        <label class="ui label" for="andraikitra">Andraikitra</label>
                        <input type="text" id="andraikitra" name="andraikitra">
                    </div>
                </div>

                <div>
                    <div class="titleP">
                        <b>Sefala</b>
                    </div>
                    <hr class="horizon">
                    <div class="divFlexPers sefalaDiv">
                        <div>
                            <label class="container">Katekista
                                <input type="checkbox" id="katekista" name="katekista">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="container">Mpiandry
                                <input type="checkbox" id="mpiandry" name="mpiandry">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="container">Mpitoriteny
                                <input type="checkbox" id="mpitoriteny" name="mpitoriteny">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="divFlexPers">
                    <div>
                        <label class="ui label" for="batisa">Batisa</label>
                        <select id="batisa" name="batisa">
                            <option value="tsia">Tsia</option>
                            <option value="eny">Eny</option>
                        </select>
                    </div>

                    <div>
                        <label class="ui label" for="mpandray">Mpandray</label>
                        <select id="mpandray" name="mpandray">
                            <option value="tsia">Tsia</option>
                            <option value="eny">Eny</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="buttonDiv2">
            <button class="ui button green" type="submit">Ajouter</button>
            <i class="ui button red" onclick="fermer()">Annuler</i>
        </div>
</form>
</div>

<div class="topView">
    <div class="idView bg-color">
        <b>
            <?= $dataTok["idTokantrano"]; ?>
        </b>
    </div>
    <div class="detailView bg-color">
        <div>
            <div>Lohany: <?= $dataTok['nomTokantrano'] ?></div>
            <div>Faritra: <?= $dataAdresse['nomFaritra'] ?></div>
            <div>Zana-Paritra: <?= $dataAdresse['nomZanaParitra'] ?></div>
            <div>Fokontany: <?= $dataAdresse['nomFokontany'] ?></div>
            <div>Logement: <?= $dataTok['lotTokantrano'] ?></div>
            <div>Parcelle: <?= $dataAdresse['Parcelle'] ?></div>
        </div>
        <div class="button">
            <i class="edit icon ui" onclick="openEditL()"></i>
        </div>
    </div>
</div>
<div><hr></div>
<div class="bg-color gTitle">
    Les membres du Tokantrano: <?= $memberCount; ?>
</div>
<div class="radDiv">
    <div>
        <div class="rad">
            <?php
                if (is_array($dataTemp['ray']))
                {
                    ?>
                    <div class="photo bg-color">
                        <div>Ray</div>
                        <div>
                            <?= $dataTemp['ray']['sexePersonne'] ?>
                            <?= $dataTemp['ray']['idPersonne'] ?>
                        </div>
                    </div>
                    <div class="infoDiv bg-color">
                        <div>
                            <div class="info">
                                <div><?= $dataTemp['ray']['nomPersonne'] ?></div>
                                <div><?= $dataTemp['ray']['prenomPersonne'] ?></div>
                                <div><?= $dataTemp['ray']['numeroPersonne'] ?></div>
                            </div>
                            <div class="info2">
                                <div>Vita Batisa: <?= $dataTemp['ray']['batisaPersonne'] ?></div>
                                <div>Mpandray: <?= $dataTemp['ray']['mpandrayPersonne'] ?></div>
                            </div>
                        </div>
                        <div class="button">
                            <a href="viewMpiangona.php?id=<?= $dataTemp['ray']['idPersonne']; ?>"><i class="icon ui eye"></i></a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="photo bg-color">
                        <div>Ray</div>
                    </div>
                    <div class="infoDiv bg-color">
                        <div class="noInfo">No information</div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="rad">
            <?php
            if (is_array($dataTemp['reny']))
            {
                ?>
                <div class="photo bg-color">
                    <div>Reny</div>
                    <div>
                        <?= $dataTemp['reny']['sexePersonne'] ?>
                        <?= $dataTemp['reny']['idPersonne'] ?>
                    </div>
                </div>
                <div class="infoDiv bg-color">
                    <div>
                        <div class="info">
                            <div><?= $dataTemp['reny']['nomPersonne'] ?></div>
                            <div><?= $dataTemp['reny']['prenomPersonne'] ?></div>
                            <div><?= $dataTemp['reny']['numeroPersonne'] ?></div>
                        </div>
                        <div class="info2">
                            <div>Vita Batisa: <?= $dataTemp['reny']['batisaPersonne'] ?></div>
                            <div>Mpandray: <?= $dataTemp['reny']['mpandrayPersonne'] ?></div>
                        </div>
                    </div>
                    <div class="button">
                        <a href="viewMpiangona.php?id=<?= $dataTemp['reny']['idPersonne']; ?>"><i class="icon ui eye"></i></a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                    <div class="photo bg-color">
                        <div>Reny</div>
                    </div>
                    <div class="infoDiv bg-color">
                        <div class="noInfo">No information</div>
                    </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="mariasy bg-color">
        <div>Status Mariazy</div>
        <?php
            if (is_array($dataTemp['ray']) && is_array($dataTemp['reny']))
            {
                ?>
                <div>
                    <div class="buttonDiv">
                        <i class="ui icon edit" onclick="openEditM()"></i>
                    </div>
                    <div class='subMariazy'>
                        <div>Sivily:</div>
                        <div>
                            <?php
                                if ($dataTemp['ray']['mSivilyPersonne'] == $dataTemp['reny']['mSivilyPersonne'])
                                {
                                    echo $dataTemp['ray']['mSivilyPersonne'];
                                } else {
                                    echo "data Conflict";
                                }
                            ?>
                        </div>
                    </div>
                    <div class='subMariazy'>
                        <div>Ara-Pinoana:</div>
                        <div>
                            <?php
                                if ($dataTemp['ray']['mAraPinoPersonne'] == $dataTemp['reny']['mAraPinoPersonne'])
                                {
                                    echo $dataTemp['ray']['mAraPinoPersonne'];
                                } else {
                                    echo "data Conflict";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>
<div class="bg-color mTitle" style="
    display: flex;
    width: 100%;
    justify-content: space-between;
    flex-direction: row;
    align-items: center;
    ">
    <div style="width: calc(100% - 150px);">Zanaka: <?= $zanakaN; ?></div>
    <div><button class="ui button blue" style="text-align: center;padding-left: 30px;" onclick="openAdd()"><i class="ui icon add"></i></button></div>
</div>
<?php
    if ($zanakaN > 0) {
        ?>
        <div class='zanakaDiv'>
            <?php
                foreach ($dataTemp['zanaka'] as $zanaka) {
                    ?>
                    <div class="bg-color zanaka">
                        <div class="photo">
                            <?php
                                if ($zanaka['sexePersonne'] == 'M')
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
                                <div class="idZanaka">
                                    ID: <b><?= $zanaka['idPersonne'] ?></b>
                                </div>
                        </div>
                        <div class="zInfo">
                            <div class="info">
                                <div><?= $zanaka['nomPersonne'] ?></div>
                                <div><?= $zanaka['prenomPersonne'] ?></div>
                                <div><?= $zanaka['numeroPersonne'] ?></div>
                            </div>
                            <div class="info2">
                                <div>Vita Batisa: <?= $zanaka['batisaPersonne'] ?></div>
                                <div>Mpandray: <?= $zanaka['mpandrayPersonne'] ?></div>
                            </div>
                        </div>
                        <div class="button">
                            <a href="viewMpiangona.php?id=<?= $zanaka['idPersonne']; ?>"><i class="icon ui eye"></i></a>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <?php
    }

?>
<script>
    function fermer()
    {
        $("#addPersonne").css("display", "none")
    }
    function openAdd()
    {
        $("#addPersonne").css("display", "flex")
    }
    function fermerEditL()
    {
        $("#editLogement").css("display", "none")
    }
    function openEditL()
    {
        $("#editLogement").css("display", "flex")
    }
    function fermerEditM()
    {
        $("#editMariasy").css("display", "none")
    }
    function openEditM()
    {
        $("#editMariasy").css("display", "flex")
    }
    $("#pageNow").text("Tokantrano")
    $("#pageNow2").text("Tokantrano numero <?=$id?>")
</script>