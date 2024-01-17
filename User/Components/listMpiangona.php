

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
                            <a class="ui button" href="" target="_">Definitif</a>
                        </td>
                        <td>
                            <a class="ui button" href="" target="_">Non Definitif</a>
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