<?php
    require_once "../Configurations/config.php";

    $faritra = $bdd->query("SELECT idFaritra,nomFaritra FROM faritra ORDER BY idFaritra");
    $faritra = $faritra->fetchAll();
    $zanaparitra = $bdd->query("SELECT idZanaParitra,nomZanaParitra FROM zanaparitra WHERE faritraZanaParitra=".$faritra[0][0]);
    $zanaparitra = $zanaparitra->fetchAll();
    $fokontany = $bdd->query("SELECT idFokontany,nomFokontany FROM fokontany WHERE zanaParitraFokontany=".$zanaparitra[0][0]);
    $fokontany = $fokontany->fetchAll();
?>

<form id="form-ajouter2" method="POST" action="Traitements/addLocation.php" class="form01 ui form bg-color">
    <div class="leftLocationForm">
        <div class="ajouter-label">
            <h4>Ajouter un<b class="sexeLbl"></b> localisation<b class="sexeLbl"></b></h4>
        </div>
        <div class="info-locations">
            <div class="locationFlexBox">
                <input type="text" name="parcelle" id="parcelle" required placeholder="Parcelle" style="width: 100%;">
            </div>
            <div class="locationFlexBox">
                <div class="locationFlexBoxDiv">
                    <label class="ui label" for="faritra">Faritra<b class="sexeLbl"></b></label>
                    <select name="faritra" id="faritra">
                        <?php
                            $first = true;
                            foreach ($faritra as $datum)
                            {
                                if ($first)
                                {
                                    $select = "selected";
                                    $first = false;
                                } else {
                                    $select = "";
                                }
                                echo "<option value='".$datum['idFaritra']."'  $select>".$datum['nomFaritra']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="locationFlexBoxDiv">
                    <label class="ui label" for="zanaparitra">Zana-Paritra<b class="sexeLbl"></b></label>
                    <select name="zanaparitra" id="zanaparitra">
                        <?php
                            $first = true;
                            foreach ($zanaparitra as $datum)
                            {
                                if ($first)
                                {
                                    $select = "selected";
                                    $first = false;
                                } else {
                                    $select = "";
                                }
                                echo "<option value='".$datum['idZanaParitra']."'  $select>".$datum['nomZanaParitra']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="locationFlexBox departement">
                <label for="fokontany" class="ui label">Fokontany<b class="sexeLbl"></b></label>
                <select name="fokontany" id="fokontany">
                    <?php
                        $first = true;
                        foreach ($fokontany as $datum)
                        {
                            if ($first)
                            {
                                $select = "selected";
                                $first = false;
                            } else {
                                $select = "";
                            }
                            echo "<option value='".$datum['idFokontany']."'  $select>".$datum['nomFokontany']."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div>
      <button type="reset" class="ui red button" onclick="hideAddFok()">Annuler</button>
      <button type="submit" class="ui blue button">Ajouter</button>
    </div>
</form>
<script>
    $("#faritra").change(function (){
        const faritra = $("#faritra").val()
        changeZF(faritra)
    })
    $("#zanaparitra").change(function (){
        const zanaparitra = $("#zanaparitra").val()
        changeF(zanaparitra)
    })
    function changeZF(idFaritra)
    {
        $.post('Traitements/changeLocationVal.php',{data:idFaritra,type:"zf"},function(data){
            $('#zanaparitra').html(data)
        })
    }
    function changeF(idZanaparitra)
    {
        $.post('Traitements/changeLocationVal.php',{data:idZanaparitra,type:"f2"},function(data){
            $('#fokontany').html(data)
        })
    }
    function hideAddFok()
    {
        $("#addTok").css("display", "none")
    }
</script>