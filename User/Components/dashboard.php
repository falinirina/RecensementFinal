<?php
  require_once "../Configurations/config.php";
  $nbrTokantrano=$bdd->query("SELECT idTokantrano FROM tokantrano");
  $nbrTokantrano=$nbrTokantrano->rowCount();

  $nbrPersonnel=$bdd->query("SELECT idPersonne FROM personne");
  $nbrPersonnel=$nbrPersonnel->rowCount();

  $nbrEcole=$bdd->query("SELECT idParcelle FROM parcelle");
  $nbrEcole=$nbrEcole->rowCount();

  $mpandray = $bdd->query("SELECT * FROM personne WHERE mpandrayPersonne='eny' AND statusPersonne='velona'");
  $totalMpandray = $mpandray->rowCount();

  $mpandray = $bdd->query("SELECT * FROM personne WHERE mpandrayPersonne='eny' AND statusPersonne='velona' AND updateMpandrayPersonne IS NULL");
  $totalTaloha = $mpandray->rowCount();

  $mpandray = $bdd->query("SELECT * FROM personne WHERE mpandrayPersonne='eny' AND statusPersonne='velona' AND updateMpandrayPersonne IS NOT NULL");
  $totalVaovao = $mpandray->rowCount();

  $faritra = $bdd->query("SELECT * FROM faritra");
  $faritra = $faritra->fetchAll();
?>
<header class="Top-head">
  <div class="card bg-color">
    <div class="card-header">
    <div class="card-header-title">Tokantrano</div>
      <div class="card-header-body"><br><div><?=$nbrTokantrano;?></div></div>
    </div>
    <hr class="card-hr">
    <div class="card-footer">Tokantrano</div>
  </div>
  <div class="card bg-color">
    <div class="card-header">
        <div class="card-header-title">Mpiangona</div>
        <div class="card-header-body"><br><div><?=$nbrPersonnel;?></div></div>
    </div>
    <hr class="card-hr">
    <div class="card-footer">Mpiangona</div>
  </div>
  <div class="card bg-color">
    <div class="card-header">
        <div class="card-header-title">Toerana</div>
        <div class="card-header-body"><br><div><?=$nbrEcole;?></div></div>
    </div>
    <hr class="card-hr">
    <div class="card-footer">Toerana</div>
  </div>
</header>

<div class="bg-color" id="mpandrayListe">
  <h5>Statistique Mpandray</h5>
</div>

<div id="mpandrayTable">
  <table class="ui table" style="padding: 15px">
    <tr>
      <th>Faritra</th>
      <th>Taloha</th>
      <th>Vaovao</th>
      <th>Total</th>
    </tr>
    <?php
    foreach ($faritra as $daataa)
    {
      $dataMpiangona = $bdd->query("SELECT idPersonne FROM personne INNER JOIN parcelle ON personne.parcelleMpandrayPersonne = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
      INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE personne.mpandrayPersonne = 'eny' AND personne.statusPersonne = 'velona' AND faritra.idFaritra = ".$daataa['idFaritra']);
      $total = $dataMpiangona->rowCount();
      $dataMpiangona = $bdd->query("SELECT idPersonne FROM personne INNER JOIN parcelle ON personne.parcelleMpandrayPersonne = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
      INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE personne.mpandrayPersonne = 'eny' AND personne.statusPersonne = 'velona' AND updateMpandrayPersonne IS NULL AND faritra.idFaritra = ".$daataa['idFaritra']);
      $taloha = $dataMpiangona->rowCount();
      $dataMpiangona = $bdd->query("SELECT idPersonne FROM personne INNER JOIN parcelle ON personne.parcelleMpandrayPersonne = parcelle.idParcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle = fokontany.idFokontany
      INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany = zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra = faritra.idFaritra WHERE personne.mpandrayPersonne = 'eny' AND personne.statusPersonne = 'velona' AND updateMpandrayPersonne IS NOT NULL AND faritra.idFaritra = ".$daataa['idFaritra']);
      $vaovao = $dataMpiangona->rowCount();
      ?>
      <tr>
        <td><?= $daataa['nomFaritra'] ?></td>
        <td><?= $taloha ?></td>
        <td><?= $vaovao ?></td>
        <td><?= $total ?></td>
      </tr>
      <?php
    }
    ?>
    <tr>
      <td>Total</td>
      <td><?= $totalTaloha ?></td>
      <td><?= $totalVaovao ?></td>
      <td><?= $totalMpandray ?></td>
    </tr>
  </table>
</div>

<script>
  $("#pageNow").text("Tableau de bord")
  $("#pageNow2").text("Tableau de bord")
</script>

<style>
  #mpandrayListe
  {
    text-align: center;
    margin-top: 25px;
    margin-bottom: 15px;
    border-radius: 5px;
    padding: 15px;
  }
  #mpandrayListe>h5
  {
    font-size: 25px;
  }
</style>