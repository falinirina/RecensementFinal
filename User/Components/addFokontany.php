<?php
    require_once "../Configurations/config.php";

    $faritra = $bdd->query("SELECT idFaritra,nomFaritra FROM faritra ORDER BY idFaritra");
    $faritra = $faritra->fetchAll();
    $zanaparitra = $bdd->query("SELECT idZanaParitra,nomZanaParitra FROM zanaparitra WHERE faritraZanaParitra=".$faritra[0][0]);
    $zanaparitra = $zanaparitra->fetchAll();
?>
<form id="form-ajouter" method="POST" action="Traitements/addLocationFokontany.php" class="form01 ui form bg-color">
    <div class="leftLocationForm">
        <div class="ajouter-label">
            <h4>Ajouter un<b class="sexeLbl"></b> Fokontany<b class="sexeLbl"></b></h4>
        </div>
        <div class="info-locations">
            <div class="locationFlexBox">
                <input type="text" name="fokontany" id="fokontanyF" required placeholder="Fokontany" style="width: 100%;">
            </div>
            <div class="locationFlexBox">
                <div class="locationFlexBoxDiv">
                    <label class="ui label" for="faritraF">Faritra<b class="sexeLbl"></b></label>
                    <select name="faritra" id="faritraF">
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
                    <label class="ui label" for="zanaparitraF">Zana-Paritra<b class="sexeLbl"></b></label>
                    <select name="zanaparitra" id="zanaparitraF">
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
        </div>
    </div>
    <div>
      <button type="reset" onclick="hideAddFokF()" class="ui red button">Annuler</button>
      <button type="submit" class="ui blue button">Ajouter</button>
    </div>
</form>
<script>
    $("#faritraF").change(function (){
        const faritra = $("#faritraF").val()
        changeZF2(faritra)
    })
    function changeZF2(idFaritra)
    {
        $.post('Traitements/changeLocationVal.php',{data:idFaritra,type:"zf2"},function(data){
            $('#zanaparitraF').html(data)
        })
    }
    function hideAddFokF()
    {
        $("#addFok").css("display", "none")
    }
</script>