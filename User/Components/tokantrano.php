<?php
    require_once "../Configurations/config.php";
    require_once "Classes/Tokontrano.php"; 
?>


<div class="filtre-tokantrano">
    <div class="ajouterForm">
        <a id="ajouterT" href="addTokantrano.php"><i class="ui icon add circle"></i></a>
    </div>
    <div class="ui form" id="form-search">
        <button class="ui white button">
            <i class="ui icon search"></i>
        </button>
        <input type="text" name="search" placeholder="Recherche tokantrano" id="search">
    </div>
</div>
<div class="cont-tokantrano">
    <div class="liste-tokantrano">
    <?php
    if (isset($_POST['search']))
    {

    } else {
        // var_dump($bdd);
        $nbrdata=Tokantrano::dataCount($bdd);
        if($nbrdata==0){echo nodata();}
        else{
            ?>
            <div class="nbrTokantrano">
                <div>Nombre Total de Tokontrano:</div>
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
        $nbrpage=Tokantrano::pages($bdd);
        $index=1;
        if (isset($_GET['p']))
        {
            $index=htmlspecialchars($_GET['p']);
            $locations=Tokantrano::default($bdd,$index);
        } else {
            $locations=Tokantrano::default($bdd);
        }
        // var_dump($locations);
        Tokantrano::affiche($bdd,$locations,$nbrpage,$index);
    }
    function search($bdd,$word)
    {
        $nbrpage=Tokantrano::pages($bdd,null,$word);
        $index=1;
        $locations=Tokantrano::search($bdd,$word);
        Tokantrano::affiche($bdd,$locations,$nbrpage,$index);

    }
    ?>
    </div>
</div>

<script>
    $("#pageNow").text("Tokantrano")
    $("#pageNow2").text("Gerer les tokantrano")
</script>