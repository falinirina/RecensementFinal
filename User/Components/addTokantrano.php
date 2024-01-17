<?php
    require_once "../Configurations/config.php";
    require_once "../Configurations/sampana.php";

    $faritra = $bdd->query("SELECT idFaritra,nomFaritra FROM faritra ORDER BY idFaritra");
    $faritra = $faritra->fetchAll();
    $zanaparitra = $bdd->query("SELECT idZanaParitra,nomZanaParitra FROM zanaparitra WHERE faritraZanaParitra=".$faritra[0][0]);
    $zanaparitra = $zanaparitra->fetchAll();
    $fokontany = $bdd->query("SELECT idFokontany,nomFokontany FROM fokontany WHERE zanaParitraFokontany=".$zanaparitra[0][0]);
    $fokontany = $fokontany->fetchAll();
    $parcelle = $bdd->query("SELECT idParcelle,Parcelle FROM parcelle WHERE fokontanyParcelle=".$fokontany[0][0]);
    $parcelle = $parcelle->fetchAll();
?>
<form action="Traitements/addTokantrano.php" method="POST">
    <div class="topView ui form">
        <div class="idView bg-color">
            <b>
                Tokantrano
            </b>
        </div>
        <div class="detailView bg-color">
            <div class="view">
                <div class="view1">
                    <div>
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
                    <div>
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
                <div class="view1">
                    <div>
                        <label for="fokontany" class="ui label">Fokontany<b class="sexeLbl"></b></label>
                        <select id="fokontany">
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
                    <div>
                        <label for="parcelle" class="ui label">Parcelle<b class="sexeLbl"></b></label>
                        <select name="parcelle" id="parcelle">
                            <?php
                                $first = true;
                                foreach ($parcelle as $datum)
                                {
                                    if ($first)
                                    {
                                        $select = "selected";
                                        $first = false;
                                    } else {
                                        $select = "";
                                    }
                                    echo "<option value='".$datum['idParcelle']."'  $select>".$datum['Parcelle']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="text" name="data" id="data" style="display: none">
            <div class="lastDiv">
                <label for="lot" class="ui label">Logement<b class="sexeLbl"></b></label>
                <input type="text" name="lot" id="lot" required placeholder="Logement" style="width: 100%;">
            </div>
            <button type="submit" id="confirm" class="ui button green" disabled><i class="ui icon add circle"></i></button>
        </div>
    </div>
</form>
<hr>
<div class="mTitle bg-color">
    <div>Ray aman-dReny</div>
</div>
<div class="radDiv">
    <div>
        <div class="rad" id="ray">
            <div class="photo bg-color">
                <div>Ray</div>
            </div>
            <div class="infoDiv bg-color">
                <div class="noInfo" id="rayInfo">No information</div>
                <div class="button">
                    <a onclick="ajouterRay()"><i class="icon ui plus circle"></i></a>
                    <a onclick="modifier('ray')" style="display: none"><i class="icon ui edit"></i></a>
                </div>
            </div>
        </div>
        <div class="rad" id="reny">
            <div class="photo bg-color">
                <div>Reny</div>
            </div>
            <div class="infoDiv bg-color">
                <div class="noInfo" id="renyInfo">No information</div>
                <div class="button">
                    <a onclick="ajouterReny()"><i class="icon ui plus circle"></i></a>
                    <a onclick="modifier('reny')" style="display: none"><i class="icon ui edit"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="mariasy bg-color">
        <div>Mariazy</div>
        <div id="matyVadyDiv">
            <label for="matyVady">Maty Vady?</label>
            <input type="checkbox" name="matyVady" id="matyVady">
        </div>
        <div class="mariazyDiv ui form" id="mDivRAD">
            <div>
                <label class="ui label" for="msivilyRAD">Sivily</label>
                <select id="msivilyRAD">
                    <option value="tsia">Tsia</option>
                    <option value="eny">Eny</option>
                </select>
            </div>
            <div>
                <label class="ui label" for="marapinRAD">Ara-pinoana</label>
                <select id="marapinRAD">
                    <option value="tsia">Tsia</option>
                    <option value="eny">Eny</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div id="zanakaDiv">
    <div class="mTitle bg-color" style="justify-content: space-between;">
        <div>Les Autres membres</div>
        <div class="buttonz">
            <button class="ui green button" id="zanaka" onclick="ajouterZanaka()">Zanaka</button>
            <button class="ui green button" id="zafy" style="display: none">Zafy</button>
        </div>
    </div>
    <div id="zanakaDiv2"></div>
</div>



<div id="selectSampana">
    <div class="bg-color ui form">
        <div class="title">Selectionner Sampana</div>
        <table class="ui table">
            <?php
                foreach ($sampana as $one)
                {
                    ?>
                    <tr>
                        <td><label for="<?= $one[2] ?>"><?= $one[1] ?></label></td>
                        <td><input type="checkbox" id="<?= $one[2] ?>"></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        <div class="buttonDiv">
            <button class="ui button green" onclick="confirmSA()">Confirmer</button>
            <a class="ui button red" onclick="closeSA()">Annuler</a>
        </div>
    </div>
</div>

<div id="addPersonne">
    <div class="form01 ui form bg-color">
        <div style="display:flex;justify-content: space-around;
        align-items: center;
        flex-direction: row;">
            <div class="titleM" id="titleAdd">Title</div>
            <div class="status" style="display: flex;">
                <label class="container" style="display: flex;">Status
                    <input type="checkbox" id="maty">
                    <span class="checkmark"></span>
                </label>
                <select id="statusAdd" style="width: 170px;;">
                    <!-- <option value="noInfo">No information</option> -->
                    <option value="maty">Efa maty</option>
                </select>
            </div>
        </div>
        <hr>
        <div>
            <div>
                <div class="divFlexPers">
                    <div>
                        <label class="ui label" for="nom">Nom</label>
                        <input type="text" id="nom">
                    </div>
                    <div>
                        <label class="ui label" for="prenom">Prenom</label>
                        <input type="text" id='prenom'>
                    </div>
                </div>
                <div class="divFlexPers">
                    <div style="width: 150px;" id="sexeDiv">
                        <label class="ui label" for="sexe">Sexe</label>
                        <select id="sexe">
                            <option value="M">Lahy</option>
                            <option value="F">Vavy</option>
                        </select>
                    </div>
                    <div>
                        <label class="ui label" for="numero">Numero</label>
                        <input type="text" id='numero'>
                    </div>
                    <div id="asaDiv">
                        <label class="ui label" for="asa">Asa</label>
                        <input type="text" id='asa'>
                    </div>
                    <div id="zanakaAsa" style="display: none">
                        <label class="ui label" for="asaZanaka">Sokajy</label>
                        <select id="asaZanaka">
                            <option value="Mpianatra">Mpianatra</option>
                            <option value="Manambady">Manambady</option>
                            <option value="Tsisy">Tsisy</option>
                        </select>
                    </div>
                </div>
                
                <div class="divFlexPers">
                    <div>
                        <label class="ui label" for="sampana">Sampana</label>
                        <input type="text" id="sampana" disabled>
                        <i class="ui icon edit" id="editSampana" onclick="openSA()"></i>
                    </div>
                    
                    <div>
                        <label class="ui label" for="andraikitra">Andraikitra</label>
                        <input type="text" id="andraikitra">
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
                                <input type="checkbox" id="katekista">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="container">Mpiandry
                                <input type="checkbox" id="mpiandry">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="container">Mpitoriteny
                                <input type="checkbox" id="mpitoriteny">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="divFlexPers">
                    <div>
                        <label class="ui label" for="batisa">Batisa</label>
                        <select id="batisa">
                            <option value="tsia">Tsia</option>
                            <option value="eny">Eny</option>
                        </select>
                    </div>

                    <div>
                        <label class="ui label" for="mpandray">Mpandray</label>
                        <select id="mpandray">
                            <option value="tsia">Tsia</option>
                            <option value="eny">Eny</option>
                        </select>
                    </div>
                </div>

                <!-- <div id="mariazyDiv">
                    <div class="titleP">
                        <b>Mariazy</b>
                    </div>
                    <hr class="horizon">
                    <div class="divFlexPers">
                        <div>
                            <label class="ui label" for="msivily">Sivily</label>
                            <select id="msivily">
                                <option value="tsia">Tsia</option>
                                <option value="eny">Eny</option>
                            </select>
                        </div>
                        <div>
                            <label class="ui label" for="marapin">Ara-pinoana</label>
                            <select id="marapin">
                                <option value="tsia">Tsia</option>
                                <option value="eny">Eny</option>
                            </select>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
        <hr>
        <div class="buttonDiv2">
            <button class="ui button green" onclick="ajouterFnc()">Ajouter</button>
            <button class="ui button red" onclick="fermer()">Annuler</button>
        </div>
    </div>
</div>

<script>
    $("#pageNow").text("Tokantrano")
    $("#pageNow2").text("Ajout Tokantrano")
    
    $("#faritra").change(function (){
        const faritra = $("#faritra").val()
        changeZF(faritra)
    })
    $("#zanaparitra").change(function (){
        const zanaparitra = $("#zanaparitra").val()
        changeF(zanaparitra)
    })
    $("#fokontany").change(function (){
        const fokontany = $("#fokontany").val()
        changeP(fokontany)
    })
    function changeP(idFokontany)
    {
        $.post('Traitements/changeLocationVal.php',{data:idFokontany,type:"pr"},function(data){
            $('#parcelle').html(data)
        })
    }
    function changeZF(idFaritra)
    {
        $.post('Traitements/changeLocationVal.php',{data:idFaritra,type:"zf"},function(data){
            $('#zanaparitra').html(data)
        })
    }
    function changeF(idZanaparitra)
    {
        $.post('Traitements/changeLocationVal.php',{data:idZanaparitra,type:"f"},function(data){
            $('#fokontany').html(data)
        })
    }

    var dataFinal = {
        mariazy: {
            matyVady: 'tsia',
            sivily: 'tsia',
            araPinoana: 'tsia'
        },
        ray: {},
        reny: {},
        zanaka: {},
        zafy: {},
        nombre: 0
    }
    var statusApp = {
        operation: "none",
        additional: "none",
        idOpt: "none",
        zanaka: 0
    }
    function ajouterRay()
    {
        $("#addPersonne .ui.button.green").text('Ajouter')
        $("#titleAdd").text("Ajouter Raim-pianakaviana")
        $("#sexeDiv").css('display','none')
        $("#addPersonne").css('display','flex')
        statusApp.operation = "add"
        statusApp.additional = "ray"
    }
    function modifier(getId)
    {
        if (getId == "ray" || getId == "reny")
        {
            $("#titleAdd").text("Modifier Raim-pianakaviana")
            $("#nom").val(dataFinal[getId].nom)
            $("#prenom").val(dataFinal[getId].prenom)
            $("#numero").val(dataFinal[getId].numero)
            $("#asa").val(dataFinal[getId].asa)
            $("#sampana").val(dataFinal[getId].sampana)
            $("#andraikitra").val(dataFinal[getId].andraikitra)
            document.getElementById('katekista').checked = dataFinal[getId].sefala.katekista
            document.getElementById('mpiandry').checked = dataFinal[getId].sefala.mpiandry
            document.getElementById('mpitoriteny').checked = dataFinal[getId].sefala.mpitoriteny
            document.getElementById('maty').checked = dataFinal[getId].stats.check
            $("#batisa").val(dataFinal[getId].batisa)
            $("#mpandray").val(dataFinal[getId].mpandray)
            $("#addPersonne .ui.button.green").text('Modifier')
            $("#sexeDiv").css('display','none')
            $("#addPersonne").css('display','flex')
            statusApp.operation = "mod"
            statusApp.additional = getId
        } else {
            $("#titleAdd").text("Modifier Zanaka")
            $("#nom").val(dataFinal.zanaka[getId].nom)
            $("#prenom").val(dataFinal.zanaka[getId].prenom)
            $("#numero").val(dataFinal.zanaka[getId].numero)
            $("#asaZanaka").val(dataFinal.zanaka[getId].asa)
            $("#sampana").val(dataFinal.zanaka[getId].sampana)
            $("#andraikitra").val(dataFinal.zanaka[getId].andraikitra)
            document.getElementById('katekista').checked = dataFinal.zanaka[getId].sefala.katekista
            document.getElementById('mpiandry').checked = dataFinal.zanaka[getId].sefala.mpiandry
            document.getElementById('mpitoriteny').checked = dataFinal.zanaka[getId].sefala.mpitoriteny
            document.getElementById('maty').checked = dataFinal.zanaka[getId].stats.check
            $("#batisa").val(dataFinal.zanaka[getId].batisa)
            $("#mpandray").val(dataFinal.zanaka[getId].mpandray)
            $("#addPersonne .ui.button.green").text('Modifier')
            $("#addPersonne").css('display','flex')
            $("#zanakaAsa").css("display", "block")
            $("#asaDiv").css("display", "none")
            statusApp.operation = "mod"
            statusApp.additional = "zanaka"
            statusApp.idOpt = getId
        }
    }
    function openSA()
    {
        var data = $("#sampana").val()

        var sampana = []
        <?php
            foreach ($sampana as $one)
            {
                ?>
                document.getElementById("<?= $one[2] ?>").checked = false
                <?php
            }
        ?>
        if (data.length > 0)
        {
            sampana = data.split("-")
        }
        var count = sampana.length
        for (var i = 0; i < count; i++)
        {
            document.getElementById(sampana[i]).checked = true
        }

        console.log(sampana)
        $("#selectSampana").css("display", "flex")
    }
    function closeSA()
    {
        $("#selectSampana").css("display", "none")
    }
    function confirmSA()
    {
        var sampana = []
        var sampanaFinal = ""
        var count = 0
        <?php
            foreach ($sampana as $one)
            {
                ?>
                if (document.getElementById("<?= $one[2] ?>").checked == true)
                {
                    sampana[count] = "<?= $one[2] ?>"
                    count++
                }
                <?php
            }
        ?>
        if (count > 0)
        {
            sampanaFinal = sampana[0]
            if (count > 1)
            {
                for (var i = 1; i < count; i++)
                {
                    sampanaFinal += "-" + sampana[i]
                }
            }
        }
        $("#sampana").val(sampanaFinal)
        closeSA()
    }
    function ajouterReny()
    {
        $("#addPersonne .ui.button.green").text('Ajouter')
        $("#titleAdd").text("Ajouter Renim-pianakaviana")
        $("#sexeDiv").css('display','none')
        $("#addPersonne").css('display','flex')
        statusApp.operation = "add"
        statusApp.additional = "reny"
    }
    function ajouterZanaka()
    {
        $("#addPersonne .ui.button.green").text('Ajouter')
        $("#titleAdd").text("Ajouter Zanaka")
        $("#addPersonne").css('display','flex')
        $("#sexeDiv").css('display','block')
        $("#zanakaAsa").css("display", "block")
        $("#asaDiv").css("display", "none")
        statusApp.operation = "add"
        statusApp.additional = "zanaka"
    }
    function fermer()
    {
        $("#addPersonne").css('display','none')
        $("#sexeDiv").css('display','none')
        $("#zanakaAsa").css("display", "none")
        $("#asaDiv").css("display", "block")
        refresh()
        statusApp.operation = "none"
        statusApp.additional = "none"
    }
    function refresh()
    {
        $("#nom").val('')
        $("#prenom").val('')
        $("#numero").val('')
        $("#asa").val('')
        $("#sampana").val('')
        $("#andraikitra").val('')
        document.getElementById('katekista').checked = false
        document.getElementById('mpiandry').checked = false
        document.getElementById('mpitoriteny').checked = false
        document.getElementById('maty').checked = false
        $("#batisa").val('tsia')
        $("#mpandray").val('tsia')
        $("#statusAdd").val('maty')
        $("#asaZanaka").val('Mpianatra')
    }
    function ajouterFnc()
    {
        var sexeT = "M"
        var dataTemp = {}
        var idTemp = ""
        var asa = ""
        if (statusApp.additional == "ray")
        {
            idTemp = "ray"
            sexeT = "M"
            asa = $("#asa").val()
        } else if (statusApp.additional == "reny")
        {
            idTemp = "reny"
            sexeT = "F"
            asa = $("#asa").val()
        } else if (statusApp.additional == "zanaka")
        {
            sexeT = $("#sexe").val()
            asa = $("#asaZanaka").val()
            if (statusApp.operation == "add")
            {
                idTemp = "zan" + (statusApp.zanaka + 1)
            } else {
                idTemp = statusApp.idOpt
            }
        }
        var finalNom = ""
        var nomTemp = []
        var count = 0
        var nom = ($("#nom").val().trim()).toUpperCase()
        nom = nom.split(" ")
        for (x in nom)
        {
            if ((nom[x]).length > 0)
            {
                nomTemp[count] = nom[x]
                count++
            }
        }
        for (x in nomTemp)
        {
            if (x == 0)
            {
                finalNom = nomTemp[x]
            } else {
                finalNom += " " + nomTemp[x]
            }
        }

        var finalPrenom = ""
        var nomTemp = []
        count = 0
        nom = ($("#prenom").val().trim()).toLowerCase()
        nom = nom.split(" ")

        for (x in nom)
        {
            if ((nom[x]).length > 0)
            {
                var teste = nom[x][0].toUpperCase()
                var teste2 = nom[x].slice(1)
                nomTemp[count] = teste+teste2
                count++
            }
        }
        for (x in nomTemp)
        {
            if (x == 0)
            {
                finalPrenom = nomTemp[x]
            } else {
                finalPrenom += " " + nomTemp[x]
            }
        }

        var dataTemp = {
            id: idTemp,
            nom: finalNom,
            prenom: finalPrenom,
            sexe: sexeT,
            numero: $("#numero").val(),
            asa: asa,
            sampana: $("#sampana").val(),
            andraikitra: $("#andraikitra").val(),
            sefala: {
                katekista: document.getElementById('katekista').checked,
                mpiandry: document.getElementById('mpiandry').checked,
                mpitoriteny: document.getElementById('mpitoriteny').checked
            },
            batisa: $("#batisa").val(),
            mpandray: $("#mpandray").val(),
            stats: {
                check: document.getElementById('maty').checked,
                data: $("#statusAdd").val()
            }
        }
         
        console.log(dataTemp)
        if (dataTemp.nom.length > 1)
        {
            if (statusApp.additional == "ray")
            {
                dataFinal.ray = dataTemp
                if (statusApp.operation == "add")
                {
                    dataFinal.nombre++
                    $("#zanakaDiv").css('display', 'block')
                    $("#confirm").removeAttr("disabled")
                    afficheRay()
                } else if (statusApp.operation == "mod")
                {
                    afficheRay()
                }
                $("#addPersonne").css('display','none')
                $("#ray .button>a:first-child").css('display', 'none')
                $("#ray .button>a:last-child").css('display', 'block')
                $("#data").val(JSON.stringify(dataFinal))
                if (dataFinal.reny.nom)
                {
                    $("#mDivRAD").css('display', 'block')
                    $("#matyVadyDiv").css("display", "none")
                } else {
                    $("#matyVadyDiv").css("display", "flex")
                    $("#mDivRAD").css('display', 'none')
                }
                refresh()
                
            } else if (statusApp.additional == "reny")
            {
                dataFinal.reny = dataTemp
                if (statusApp.operation == "add")
                {
                    dataFinal.nombre++
                    $("#zanakaDiv").css('display', 'block')
                    $("#mDivRAD").css('display', 'block')
                    $("#confirm").removeAttr("disabled")
                    afficheReny()
                } else if (statusApp.operation == "mod")
                {
                    afficheReny()
                }
                $("#addPersonne").css('display','none')
                $("#data").val(JSON.stringify(dataFinal))
                $("#reny .button>a:first-child").css('display', 'none')
                $("#reny .button>a:last-child").css('display', 'block')

                if (dataFinal.ray.nom)
                {
                    $("#mDivRAD").css('display', 'block')
                    $("#matyVadyDiv").css("display", "none")
                } else {
                    $("#matyVadyDiv").css("display", "flex")
                    $("#mDivRAD").css('display', 'none')
                }
                refresh()
            } else if (statusApp.additional == "zanaka")
            {
                dataFinal.zanaka[idTemp] = dataTemp
                $("#data").val(JSON.stringify(dataFinal))
                if (statusApp.operation == "add")
                {
                    dataFinal.nombre++
                    statusApp.zanaka++
                }
                $("#addPersonne").css('display','none')
                
                afficheZanaka(dataTemp)
                refresh()
            }
        }
    }
    function afficheRay()
    {
        var template = '<div class="radContainer"><div class="info"><div>'+dataFinal.ray.nom+'</div><div>'+dataFinal.ray.prenom+'</div><div>'+dataFinal.ray.numero+'</div></div><div class="info2"><div>Vita Batisa: '+dataFinal.ray.batisa+'</div><div>Mpandray: '+dataFinal.ray.mpandray+'</div></div></div>'
        $("#rayInfo").html(template)
    }
    function afficheReny()
    {
        var template = '<div class="radContainer"><div class="info"><div>'+dataFinal.reny.nom+'</div><div>'+dataFinal.reny.prenom+'</div><div>'+dataFinal.reny.numero+'</div></div><div class="info2"><div>Vita Batisa: '+dataFinal.reny.batisa+'</div><div>Mpandray: '+dataFinal.reny.mpandray+'</div></div></div>'
        $("#renyInfo").html(template)
    }
    function afficheZanaka(zanakaData)
    {
        var profil = ""
        if (statusApp.operation == "add")
        {
            if (zanakaData.sexe == "M")
            {
                profil = "../Pictures/user-profile.png"
            } else {
                profil = "../Pictures/user-profile-woman.png"
            }
            var template = '<div class="rad" id="'+zanakaData.id+'"> \
                <div class="photo bg-color"><img src="'+profil+'" alt="Profil"></div>\
                <div class="infoDiv bg-color"> \
                    <div class="noInfo"> \
                        <div class="radContainer"><div class="info"><div>'+zanakaData.nom+'</div><div>'+zanakaData.prenom+'</div><div>'+zanakaData.numero+'</div></div><div class="info2"><div>Vita Batisa: '+zanakaData.batisa+'</div><div>Mpandray: '+zanakaData.mpandray+'</div></div></div> \
                    </div> \
                    <div class="button"> \
                        <a onclick="modifier(\''+zanakaData.id+'\')"><i class="icon ui edit"></i></a> \
                    </div> \
                </div> \
            </div>'
            $("#zanakaDiv2").append(template)
        } else if (statusApp.operation == "mod")
        {
            if (zanakaData.sexe == "M")
            {
                profil = "../Pictures/user-profile.png"
            } else {
                profil = "../Pictures/user-profile-woman.png"
            }
            var template = '<div class="photo bg-color"><img src="'+profil+'" alt="Profil"></div>\
            <div class="infoDiv bg-color"> \
                <div class="noInfo"> \
                    <div class="radContainer"><div class="info"><div>'+zanakaData.nom+'</div><div>'+zanakaData.prenom+'</div><div>'+zanakaData.numero+'</div></div><div class="info2"><div>Vita Batisa: '+zanakaData.batisa+'</div><div>Mpandray: '+zanakaData.mpandray+'</div></div></div> \
                </div> \
                <div class="button"> \
                    <a onclick="modifier(\''+zanakaData.id+'\')"><i class="icon ui edit"></i></a> \
                </div> \
            </div>'
            $("#"+zanakaData.id).html(template)
    }
}
$("#msivilyRAD").change(function () {
    var data = $("#msivilyRAD").val()
    dataFinal.mariazy.sivily = data
    $("#data").val(JSON.stringify(dataFinal))
})
$("#marapinRAD").change(function () {
    var data = $("#marapinRAD").val()
    dataFinal.mariazy.araPinoana = data
    $("#data").val(JSON.stringify(dataFinal))
})
$("#matyVady").change(function () {
    var data = document.getElementById('matyVady').checked
    dataFinal.mariazy.matyVady = data
    $("#data").val(JSON.stringify(dataFinal))
})
</script>
