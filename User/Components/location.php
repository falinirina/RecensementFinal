<div id="addFok">
    <?php
        require_once "addFokontany.php";
    ?>
</div>
<div id="addTok">
    <?php
        require_once "addParcelle.php";
    ?>
</div>
<div class="filtre-location">
    <div class="ajouterForm">
        <div id="ajouterT" onclick="ajouterTok()"><i class="ui icon add circle"></i></div>
        <div id="ajouterFok"><button class="ui button" onclick="ajouterFok()">Ajouter Fokontany</button></div>
    </div>
    <div class="ui form" id="form-search">
        <button class="ui white button">
            <i class="ui icon search"></i>
        </button>
        <input type="text" name="search" placeholder="Recherche location" id="search">
    </div>
</div>

<div class="cont-location">
    <div class="liste-location">
        <?php
        require_once "../Configurations/config.php";
        require_once "Classes/Location.php";

        if (isset($_POST['search']))
        {

        } else {
            // var_dump($bdd);
            $nbrdata=Location::dataCount($bdd);
            if($nbrdata==0){echo nodata();}
            else{
                ?>
                <div class="nbrLocation">
                    <div>Nombre Total de localisation:</div>
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

        function initial($bdd)
        {
            $nbrpage=Location::pages($bdd);
            $index=1;
            if (isset($_GET['p']))
            {
                $index=htmlspecialchars($_GET['p']);
                $locations=Location::default($bdd,$index);
            } else {
                $locations=Location::default($bdd);
            }
            // var_dump($locations);
            Location::affiche($bdd,$locations,$nbrpage,$index);
        }
        function search($bdd,$word)
        {
            $nbrpage=Location::pages($bdd,null,$word);
            $index=1;
            $locations=Location::search($bdd,$word);
            Location::affiche($bdd,$locations,$nbrpage,$index);
        } 
    ?>    
    </div>
</div>

<script>
    $("#pageNow").text("Locations")
    $("#pageNow2").text("Gerer les locations")
    function ajouterTok()
    {
        $("#addTok").css("display", "flex")
    }
    function ajouterFok()
    {
        $("#addFok").css("display", "flex")
    }
</script>


