

<?php
    require_once("../Configurations/config.php");
    $res = $bdd->query("SELECT * FROM faritra");
    $res = $res->fetchAll();
    ?>
<div class="filtre-mpiangona"></div>
<div class="containtDiv">
    <div class="bg-color gTitle">
        Liste des mpandray
    </div>
    <div class="faritraDiv">
        <table class="ui table">
        <?php
            foreach ($res as $row) {
                ?>
                    <tr>
                        <td class="nomfaritra"><?= $row["nomFaritra"] ?></td>
                        <td>
                            <a class="ui button" href="liste.php?categorie=mpandray&faritra=<?= $row["idFaritra"] ?>&type=all" target="_">Tout</a>
                        </td>
                        <td>
                            <a class="ui button" href="liste.php?categorie=mpandray&faritra=<?= $row["idFaritra"] ?>&type=old" target="_">Taloha</a>
                        </td>
                        <td>
                            <a class="ui button" href="liste.php?categorie=mpandray&faritra=<?= $row["idFaritra"] ?>&type=new" target="_">Vaovao</a>
                        </td>
                        <td style="width: 125px;border-left: solid 1px grey;">
                            Mariazy
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropbtn ui button">Sivily</button>
                                <div class="dropdown-content">
                                    <a href="liste.php?categorie=msivily&faritra=<?= $row["idFaritra"] ?>&type=vita" target="_">Vita</a>
                                    <a href="liste.php?categorie=msivily&faritra=<?= $row["idFaritra"] ?>&type=tvita" target="_">Tsy Vita</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropbtn ui button">Ara-pinoana</button>
                                <div class="dropdown-content">
                                    <a href="liste.php?categorie=marapinoana&faritra=<?= $row["idFaritra"] ?>&type=vita" target="_">Vita</a>
                                    <a href="liste.php?categorie=marapinoana&faritra=<?= $row["idFaritra"] ?>&type=tvita" target="_">Tsy Vita</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
            }
        ?>   
        </table>
    </div>
</div>


<script>
  $("#pageNow").text("Mpiangona")
  $("#pageNow2").text("Lister les Mpiangona")
</script>

<style>
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
       display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>