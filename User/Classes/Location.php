<?php
    class Location
    {
        public static function default($bdd,$index=1)
        {
            $offset=($index==1?null:"OFFSET ".(($index - 1) * 20));
            $data=$bdd->query("SELECT parcelle.idParcelle,parcelle.Parcelle,fokontany.nomFokontany,zanaparitra.nomZanaParitra,faritra.nomFaritra,faritra.firaisanaFaritra FROM parcelle INNER JOIN fokontany ON parcelle.fokontanyParcelle=fokontany.idFokontany INNER JOIN zanaparitra ON fokontany.zanaParitraFokontany=zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra=faritra.idFaritra ORDER BY idParcelle DESC LIMIT 20 $offset");
            // var_dump($data->fetchAll());
            return $data->fetchAll();
        }
        public static function dataCount($bdd,$filtre=null,$search=null)
        {
            if ($search!=null){
                $nbr=$bdd->query("SELECT * FROM location INNER JOIN departement ON location.departlocation=departement.idDepartement WHERE  (nomlocation LIKE '$search%' OR prenomlocation LIKE '$search%') AND NOT typeCompte='admin'");
                return $nbr->rowCount();
            } else {
                $nbr=$bdd->query("SELECT count(*) FROM parcelle");
                $nbr=$nbr->fetch();
                return $nbr[0];
            }
        }
        public static function pages($bdd,$filtre=null,$search=null)
        {
            $nbr=Location::dataCount($bdd,$filtre=null,$search);

            $page=$nbr/20;
            $nbrpage=($page <= ((int)$page)? ((int)$page) : ((int)$page) + 1);
            return $nbrpage;
        }
        public static function affiche($bdd,$data,$nbrpage,$index=1)
        {
            foreach ($data as $location)
            {
            ?>
            <div class="location bg-color">
                <div class="contenueLocation">
                    <div><?= $location['Parcelle'] ?></div>
                    <div><?= $location['nomFokontany'] ?></div>
                    <div><?= $location['nomFaritra'] ?></div>
                    <div><?= $location['nomZanaParitra'] ?></div>
                    <div><?= $location['firaisanaFaritra'] ?></div>
                </div>
                <div class="lIcon">
                    <div><i class="ui icon edit" id="etudiant<?=$location["idParcelle"];?>"></i></div>
                </div>
            </div>
            <?php
            }
            ?>
            <?php
            if ($nbrpage>1){
                if ($index != 1)
                {
                    $prev = "location.php?p=" . $index - 1;
                } else {
                    $prev = "#";
                }
            ?>
            <div class="pagination">
                <a href="<?= $prev ?>">&laquo;</a>
                <?php
                    if ($nbrpage < 10)
                    {
                        for ($i=1;$i<=$nbrpage;$i++)
                        {
                            if ($index == $i) {echo "<a id='active'>$i</a>";}
                            else {echo "<a href='location.php?p=$i'>$i</a>";}
                        }
                    } else {
                        if ($index <= 5)
                        {
                            for ($i= 1;$i<=9;$i++)
                            {
                                if ($index == $i) {echo "<a id='active'>$i</a>";}
                                else {echo "<a href='location.php?p=$i'>$i</a>";}
                            }
                            echo "<a href='#'>...</a>";
                            echo "<a href='location.php?p=$nbrpage'>$nbrpage</a>";
                        }
                        else {
                            echo "<a href='location.php?p=1'>1</a>";
                            echo "<a href='#'>...</a>";
                            if (($nbrpage - $index) < 5)
                            {
                                $begin = 8 - ($nbrpage - $index);
                                $begin = $index - $begin;
                                while ($begin < $index)
                                {
                                    echo "<a href='location.php?p=$begin'>$begin</a>";
                                    $begin++;
                                }
                                echo "<a id='active'>$index</a>";
                            } else {
                                $begin = $index - 3;
                                while ($begin < $index)
                                {
                                    echo "<a href='location.php?p=$begin'>$begin</a>";
                                    $begin++;
                                }
                                echo "<a id='active'>$index</a>";
                            }
                            if (($nbrpage - $index) < 5)
                            {
                                for ($i= $index + 1;$i<$nbrpage;$i++)
                                {
                                    echo "<a href='location.php?p=$i'>$i</a>";
                                }
                            } else {
                                $last = $index + 3;
                                for ($i= $index + 1;$i<=$last;$i++)
                                {
                                    echo "<a href='location.php?p=$i'>$i</a>";
                                }
                                echo "<a href='#'>...</a>";
                            } if ($index != $nbrpage)
                            {
                                echo "<a href='location.php?p=$nbrpage'>$nbrpage</a>";
                            }
                        }
                    }
                ?>
                <?php
                    if ($nbrpage>1){
                        if ($index < $nbrpage)
                        {
                            $next = "location.php?p=" . $index + 1;
                        } else {
                            $next = "#";
                        }
                    }
                ?>
                <a href="<?= $next; ?>">&raquo;</a>
            </div>
            <div id="maxPage" style="display: none;"><?= $nbrpage ?></div>
            <?php
            }
            ?>
            </script>
            <style>
                .contenueLocation
                {
                    display: flex;
                }
                .lIcon {
                    display: flex;
                }
                .contenueLocation>div:nth-child(1)
                {
                    width: 80px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .contenueLocation>div:nth-child(2)
                {
                    width: 150px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .contenueLocation>div:nth-child(3)
                {
                    width: 150px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .contenueLocation>div:nth-child(4)
                {
                    width: 150px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .contenueLocation>div:nth-child(5)
                {
                    /* width: 100%; */
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>
            <?php
        }
    }
?>