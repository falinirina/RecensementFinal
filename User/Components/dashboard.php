<?php
  require_once "../Configurations/config.php";
  $nbrTokantrano=$bdd->query("SELECT idTokantrano FROM tokantrano");
  $nbrTokantrano=$nbrTokantrano->rowCount();

  $nbrPersonnel=$bdd->query("SELECT idPersonne FROM personne");
  $nbrPersonnel=$nbrPersonnel->rowCount();

  $nbrEcole=$bdd->query("SELECT idParcelle FROM parcelle");
  $nbrEcole=$nbrEcole->rowCount();
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

<script>
  $("#pageNow").text("Tableau de bord")
  $("#pageNow2").text("Tableau de bord")
</script>