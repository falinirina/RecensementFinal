<?php
    class Personne
    {
        public static function default($bdd,$index=1)
        {
            $offset=($index==1?null:"OFFSET ".(($index - 1) * 20));
            $data = $bdd->query("SELECT * FROM personne ORDER BY idPersonne DESC LIMIT 20 $offset");
            // var_dump($data->fetchAll());
            return $data->fetchAll();
        }
        public static function dataCount($bdd,$filtre=null,$search=null)
        {
            if ($search!=null){
                $nbr=$bdd->query("SELECT * FROM personne WHERE  (nomPersonne LIKE '$search%') OR (prenomPersonne LIKE '$search%') ORDER BY idPersonne DESC");
                return $nbr->rowCount();
            } else {
                $nbr=$bdd->query("SELECT count(*) FROM personne");
                $nbr=$nbr->fetch();
                return $nbr[0];
            }
        }
        public static function search($bdd,$word,$index=1)
        {
            $offset=($index ==1 ?null:"OFFSET ".(($index - 1) * 20));
            $data=$bdd->query("SELECT * FROM personne WHERE  (nomPersonne LIKE '$word%') OR (prenomPersonne LIKE '$word%') ORDER BY idPersonne DESC LIMIT 20 $offset");
            return $data->fetchAll();
        }
        public static function pages($bdd,$filtre=null,$search=null)
        {
            $nbr=Personne::dataCount($bdd,$filtre=null,$search);

            $page=$nbr/20;
            $nbrpage=($page <= ((int)$page)? ((int)$page) : ((int)$page) + 1);
            return $nbrpage;
        }
        public static function affiche($bdd,$data,$nbrpage,$index=1,$find="")
        {
            // var_dump($data);
            if ($find != "")
            {
                $find= "find=".$find."&";
            }
            foreach ($data as $tokantrano)
            {
                ?>
                <div class="mpiangona bg-color">
                    <div class="photo">
                        <?php
                            if ($tokantrano['sexePersonne'] == 'M')
                            {
                                $photo = "user-profile.png";
                            } else {
                                $photo = "user-profile-woman.png";
                            }
                        ?>
                        <img src="../../Pictures/<?= $photo; ?>" alt="">
                        <div class="idMpiangona">
                            <b><?= $tokantrano['idPersonne'] ?></b>
                        </div>
                    </div>
                    <div class="info">
                        <div>
                            <div class="nom-etudiant">
                                <div><?=$tokantrano["nomPersonne"];?></div>
                                <div><?=$tokantrano["prenomPersonne"];?></div>
                                <div><?=$tokantrano["numeroPersonne"];?></div>
                            </div>
                            <div class="info2">
                                <div>Vita Batisa: <?= $tokantrano['batisaPersonne'] ?></div>
                                <div>Mpandray: <?= $tokantrano['mpandrayPersonne'] ?></div>
                            </div>
                        </div>
                        <div class="lIcon">
                            <div><a href="viewMpiangona.php?id=<?=$tokantrano["idPersonne"];?>"><i class="ui icon eye"></i></a></div>
                        </div>
                    </div>
                    <div></div>
                </div>
                <?php
            }
            ?>
            <?php
            if ($nbrpage>1){
                if ($index != 1)
                {
                    $prev = "mpiangona.php?".$find."p=" . $index - 1;
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
                            else {echo "<a href='mpiangona.php?".$find."p=$i'>$i</a>";}
                        }
                    } else {
                        if ($index <= 5)
                        {
                            for ($i= 1;$i<=9;$i++)
                            {
                                if ($index == $i) {echo "<a id='active'>$i</a>";}
                                else {echo "<a href='mpiangona.php?".$find."p=$i'>$i</a>";}
                            }
                            echo "<a href='#'>...</a>";
                            echo "<a href='mpiangona.php?".$find."p=$nbrpage'>$nbrpage</a>";
                        }
                        else {
                            echo "<a href='mpiangona.php?".$find."p=1'>1</a>";
                            echo "<a href='#'>...</a>";
                            if (($nbrpage - $index) < 5)
                            {
                                $begin = 8 - ($nbrpage - $index);
                                $begin = $index - $begin;
                                while ($begin < $index)
                                {
                                    echo "<a href='mpiangona.php?".$find."p=$begin'>$begin</a>";
                                    $begin++;
                                }
                                echo "<a id='active'>$index</a>";
                            } else {
                                $begin = $index - 3;
                                while ($begin < $index)
                                {
                                    echo "<a href='mpiangona.php?".$find."p=$begin'>$begin</a>";
                                    $begin++;
                                }
                                echo "<a id='active'>$index</a>";
                            }
                            if (($nbrpage - $index) < 5)
                            {
                                for ($i= $index + 1;$i<$nbrpage;$i++)
                                {
                                    echo "<a href='mpiangona.php?".$find."p=$i'>$i</a>";
                                }
                            } else {
                                $last = $index + 3;
                                for ($i= $index + 1;$i<=$last;$i++)
                                {
                                    echo "<a href='mpiangona.php?".$find."p=$i'>$i</a>";
                                }
                                echo "<a href='#'>...</a>";
                            } if ($index != $nbrpage)
                            {
                                echo "<a href='mpiangona.php?".$find."p=$nbrpage'>$nbrpage</a>";
                            }
                        }
                    }
                ?>
                <?php
                    if ($nbrpage>1){
                        if ($index < $nbrpage)
                        {
                            $next = "mpiangona.php?".$find."p=" . $index + 1;
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