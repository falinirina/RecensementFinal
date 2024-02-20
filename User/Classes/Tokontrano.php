<?php
    class Tokantrano
    {
        public static function default($bdd,$index=1)
        {
            $offset=($index==1?null:"OFFSET ".(($index - 1) * 10));
            $data = $bdd->query("SELECT * FROM tokantrano INNER JOIN parcelle on tokantrano.parcelleTokantrano=parcelle.idParcelle INNER JOIN fokontany on parcelle.fokontanyParcelle=fokontany.idFokontany 
            INNER JOIN zanaparitra on fokontany.zanaParitraFokontany=zanaparitra.idZanaParitra INNER JOIN faritra ON zanaparitra.faritraZanaParitra=faritra.idFaritra ORDER BY idTokantrano DESC LIMIT 10 $offset");
            // var_dump($data->fetchAll());
            return $data->fetchAll();
        }
        public static function dataCount($bdd,$filtre=null,$search=null)
        {
            if ($search!=null){
                $nbr=$bdd->query("SELECT * FROM tokantrano WHERE (nomtokantrano LIKE '%$search%') ORDER BY idTokantrano DESC");
                return $nbr->rowCount();
            } else {
                $nbr=$bdd->query("SELECT count(*) FROM tokantrano");
                $nbr=$nbr->fetch();
                return $nbr[0];
            }
        }
        public static function search($bdd,$word,$index=1)
        {
            $offset=($index ==1 ?null:"OFFSET ".(($index - 1) * 10));
            $data=$bdd->query("SELECT * FROM tokantrano WHERE  (nomTokantrano LIKE '%$word%') ORDER BY idTokantrano DESC");
            return $data->fetchAll();
        }
        public static function pages($bdd,$filtre=null,$search=null)
        {
            $nbr=Tokantrano::dataCount($bdd,$filtre=null,$search);

            $page=$nbr/10;
            $nbrpage=($page <= ((int)$page)? ((int)$page) : ((int)$page) + 1);
            return ($nbrpage - 1);
        }
        public static function affiche($bdd,$data,$nbrpage,$index=1)
        {
            foreach ($data as $tokantrano)
            {
            ?>
            <div class="tokantrano bg-color" style="justify-content: space-between;">
                <div class="idTokantrano"><?= $tokantrano['idTokantrano'] ?></div>
                <div class="tokantranoTitle">
                    <div><?= $tokantrano['nomTokantrano'] ?></div><div> / </div><div>Adresse: <?= $tokantrano['lotTokantrano'] ?></div>
                </div>
                <div style="display: flex;
                width: 180px;
                justify-content: space-between;"><div><?= $tokantrano['nomFaritra'] ?></div><div> / </div><div><?= $tokantrano['nomZanaParitra'] ?></div></div>
                <div class="actionDiv">
                    <div><a href="viewTokantrano.php?id=<?=$tokantrano["idTokantrano"];?>"><i class="ui icon eye"></i></a></div>
                </div>
            </div>
            <?php
            }
            if ($nbrpage>1){
                if ($index != 1)
                {
                    $prev = "tokantrano.php?p=" . $index - 1;
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
                            else {echo "<a href='tokantrano.php?p=$i'>$i</a>";}
                        }
                    } else {
                        if ($index <= 5)
                        {
                            for ($i= 1;$i<=9;$i++)
                            {
                                if ($index == $i) {echo "<a id='active'>$i</a>";}
                                else {echo "<a href='tokantrano.php?p=$i'>$i</a>";}
                            }
                            echo "<a href='#'>...</a>";
                            echo "<a href='tokantrano.php?p=$nbrpage'>$nbrpage</a>";
                        }
                        else {
                            echo "<a href='tokantrano.php?p=1'>1</a>";
                            echo "<a href='#'>...</a>";
                            if (($nbrpage - $index) < 5)
                            {
                                $begin = 8 - ($nbrpage - $index);
                                $begin = $index - $begin;
                                while ($begin < $index)
                                {
                                    echo "<a href='tokantrano.php?p=$begin'>$begin</a>";
                                    $begin++;
                                }
                                echo "<a id='active'>$index</a>";
                            } else {
                                $begin = $index - 3;
                                while ($begin < $index)
                                {
                                    echo "<a href='tokantrano.php?p=$begin'>$begin</a>";
                                    $begin++;
                                }
                                echo "<a id='active'>$index</a>";
                            }
                            if (($nbrpage - $index) < 5)
                            {
                                for ($i= $index + 1;$i<$nbrpage;$i++)
                                {
                                    echo "<a href='tokantrano.php?p=$i'>$i</a>";
                                }
                            } else {
                                $last = $index + 3;
                                for ($i= $index + 1;$i<=$last;$i++)
                                {
                                    echo "<a href='tokantrano.php?p=$i'>$i</a>";
                                }
                                echo "<a href='#'>...</a>";
                            } if ($index != $nbrpage)
                            {
                                echo "<a href='tokantrano.php?p=$nbrpage'>$nbrpage</a>";
                            }
                        }
                    }
                ?>
                <?php
                    if ($nbrpage>1){
                        if ($index < $nbrpage)
                        {
                            $next = "tokantrano.php?p=" . $index + 1;
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
            <?php
        }
    }
?>