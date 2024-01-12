<?php
    if (isset($_POST['data']) && isset($_POST['type']))
    {
        $data = htmlspecialchars($_POST['data']);
        $type = htmlspecialchars($_POST['type']);
        require_once "../../Configurations/config.php";
        if ($type == 'f')
        {
            $fokontany = $bdd->query("SELECT idFokontany,nomFokontany FROM fokontany WHERE zanaParitraFokontany=$data");
            $fokontany = $fokontany->fetchAll();
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
                echo '<script>
                    function loadF()
                    {
                    const fokontany = $("#fokontany").val();
                        changeP(fokontany)
                    }
                    loadF()
                </script>';
            }
        } else if ($type == 'f2')
        {
            $fokontany = $bdd->query("SELECT idFokontany,nomFokontany FROM fokontany WHERE zanaParitraFokontany=$data");
            $fokontany = $fokontany->fetchAll();
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
        }
        else if ($type == 'zf')
        {
            $fokontany = $bdd->query("SELECT idZanaParitra,nomZanaParitra FROM zanaparitra WHERE faritraZanaParitra=$data");
            $fokontany = $fokontany->fetchAll();
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
                echo "<option value='".$datum['idZanaParitra']."'  $select>".$datum['nomZanaParitra']."</option>";
                echo '<script>
                    function loadZF()
                    {
                    const zanaparitra = $("#zanaparitra").val();
                    changeF(zanaparitra)
                    }
                    loadZF()
                </script>';
            }
        }
        else if ($type == 'zf2')
        {
            $fokontany = $bdd->query("SELECT idZanaParitra,nomZanaParitra FROM zanaparitra WHERE faritraZanaParitra=$data");
            $fokontany = $fokontany->fetchAll();
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
                echo "<option value='".$datum['idZanaParitra']."'  $select>".$datum['nomZanaParitra']."</option>";
            }
        }
        else if ($type == 'pr')
        {
            $fokontany = $bdd->query("SELECT idParcelle,Parcelle FROM parcelle WHERE fokontanyParcelle=$data");
            $fokontany = $fokontany->fetchAll();
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
                echo "<option value='".$datum['idParcelle']."'  $select>".$datum['Parcelle']."</option>";
            }
        }
    }


?>