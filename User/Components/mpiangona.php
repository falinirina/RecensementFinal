<?php
    require_once "../Configurations/config.php";
    require_once "Classes/Personne.php"; 
?>


<div class="filtre-mpiangona">
    <div class="ajouterForm">
        <div><a class="ui button">Filtre</a></div>
        <div><a href="Traitements/configMpandray.php" class="ui button">Liste</a></div>
    </div>
    <form action="mpiangona.php" method="GET" class="ui form" id="form-search">
        <input type="text" name="find" placeholder="Recherche mpiangona" id="search" required>
        <button class="ui white button">
            <i class="ui icon search"></i>
        </button>
    </form>
</div>
<div class="cont-mpiangona">
    <div class="liste-mpiangona">
    <?php
    if (isset($_GET['find']))
    {
        $word = htmlspecialchars($_GET['find']);
        if ($word==""){
            $nbrdata=Personne::dataCount($bdd,'',$word);
            ?>
            <div class="nbrMpiangona">
                <div>Nombre Total de Personne:</div>
                <div><b><?= $nbrdata ?></b></div>
            </div>
            <?php
            initial($bdd);
        }
        else{
            $nbrdata=Personne::dataCount($bdd,'',$word);
            ?>
            <div class="nbrMpiangona">
                <div>Resultat recherche de <b><?= $word ?></b>:</div>
                <div><?= $nbrdata ?></div>
            </div>
            <?php
            if ($nbrdata == 0)
            {
                echo noresult();
            } else {
                search($bdd,$word);
            }
        }
    } else {
        // var_dump($bdd);
        $nbrdata=Personne::dataCount($bdd);
        if($nbrdata==0){echo nodata();}
        else{
            ?>
            <div class="nbrMpiangona">
                <div>Nombre Total de Mpiangona:</div>
                <div><b><?= $nbrdata ?></b></div>
            </div>
            <?php
            initial($bdd);
        }
    }

    function nodata()
    {
        return "<div class='result'>NO DATA</div>";
    }
    function noresult()
    {
        return "<div class='result'>NO RESULT</div>";
    }
    function initial($bdd)
    {
        $nbrpage=Personne::pages($bdd);
        $index=1;
        if (isset($_GET['p']))
        {
            $index=htmlspecialchars($_GET['p']);
            $locations=Personne::default($bdd,$index);
        } else {
            $locations=Personne::default($bdd);
        }
        // var_dump($locations);
        Personne::affiche($bdd,$locations,$nbrpage,$index);
    }
    function search($bdd,$word)
    {
        $nbrpage=Personne::pages($bdd,null,$word);
        $index=1;
        if (isset($_GET['p']))
        {
            $index=htmlspecialchars($_GET['p']);
            $locations=Personne::search($bdd,$word,$index);
        } else {
            $locations=Personne::search($bdd,$word);
        }
        // var_dump($locations);
        Personne::affiche($bdd,$locations,$nbrpage,$index,$word);

    } 
?>
    
    </div>
</div>


<script>
  $("#pageNow").text("Mpiangona")
  $("#pageNow2").text("Gerer les Mpiangona")
</script>