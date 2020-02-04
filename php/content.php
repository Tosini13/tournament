<div class="myContent">
    <?php
    $result = $db->query('select * from tournament where start_date < ' . date('YmdHis') . ' and finish_date > ' . date('YmdHis'));
    if ($result->rowCount()) {
        ?>
        <div id="live">
            <h3><li>LIVE</li></h3>
            <?php
            while ($data = $result->fetch()) {
                $url = '_logos/' . $data['logo'];
                ?>
                <a href="#<?php echo $data['id']; ?>"><div class="tournament">
                        <h5><?php echo $data['name']; ?></h5>
                        <div>
                            <?php
                            if ($data['logo']) {
                                ?>
                                <div style = "background-image: url(<?php echo $url ?>)">
                                </div>
                                <?php
                            }
                            ?>
                            <p><?php echo $data['start_date'] ?></p>
                        </div>
                    </div></a>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
    <div class="tournaments">
        <div>
            <h3>DZISIAJ</h3>
            <div>
                <?php
                $result = $db->query('select * from tournament where start_date > ' . date('YmdHis') . ' and start_date < ' . date('Ymd', strtotime('+1day')));
                if ($result->rowCount()) {
                    while ($data = $result->fetch()) {
                        $url = '_logos/' . $data['logo'];
                        ?>
                        <a href="#<?php echo $data['id']; ?>"><div class="tournament">
                                <h5><?php echo $data['name']; ?></h5>
                                <div>
                                    <?php
                                    if ($data['logo']) {
                                        ?>
                                        <div style = "background-image: url(<?php echo $url ?>)">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <p><?php echo $data['start_date'] ?></p>
                                </div>
                            </div></a>
                        <?php
                    }
                } else {
                    echo '<h4>BRAK</h4>';
                }
                ?>
            </div>
        </div>
        <div>
            <h3>WKRÓTCE</h3>
            <div>
                <?php
                $result = $db->query('select * from tournament where start_date > ' . date('Ymd', strtotime('+1day')));
                if ($result->rowCount()) {
                    while ($data = $result->fetch()) {
                        $url = '_logos/' . $data['logo'];
                        ?>
                        <a href="#<?php echo $data['id']; ?>"><div class="tournament">
                                <h5><?php echo $data['name']; ?></h5>
                                <div>
                                    <?php
                                    if ($data['logo']) {
                                        ?>
                                        <div style = "background-image: url(<?php echo $url ?>)">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <p><?php echo $data['start_date'] ?></p>
                                </div>
                            </div></a>
                        <?php
                    }
                } else {
                    echo '<h4>BRAK</h4>';
                }
                ?>
            </div>
        </div>
        <div>
            <h3>PRZESZŁE</h3>
            <div>
                <?php
                $result = $db->query('select * from tournament where finish_date < ' . date('YmdHis') . ' order by start_date desc');
                if ($result->rowCount()) {
                    while ($data = $result->fetch()) {
                        $url = '_logos/' . $data['logo'];
                        ?>
                        <a href="#<?php echo $data['id']; ?>"><a href="#<?php echo $data['id']; ?>"><div class="tournament">
                                    <h5><?php echo $data['name']; ?></h5>
                                    <div>
                                        <?php
                                        if ($data['logo']) {
                                            ?>
                                            <div style = "background-image: url(<?php echo $url ?>)">
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <p><?php echo $data['start_date'] ?></p>
                                    </div>
                                </div></a>
                            <?php
                        }
                    } else {
                        echo '<h4>BRAK</h4>';
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
<!--
<script>
    //document.getElementById('myContent').style.marginTop = document.getElementById('myHeader').clientHeight;
</script>
-->