<div class="myContent">
    <div class="myTournament2">
        <?php
        require 'php/compute_tournament.php';
        for ($i = 0; $i < $no_groups; $i++) {
            ?>
            <div class="group">
                <h3><?php echo $tournament_name; ?></h3>
                <input class="groupName" type="text" value="Grupa <?php echo chr($group_name) ?>"><br>
                <?php $group_name++; ?>
                <?php
                if ($rest_teams != 0) {
                    $add = 1;
                    $rest_teams--;
                } else {
                    $add = 0;
                }
                for ($j = 1; $j < $no_teams_in_group + $add; $j++) {
                    ?>
                    <input type="text" placeholder="Zespoł nr <?php echo $j ?>"><br>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="myTournament2">
        <?php
        for ($i = $no_play_offs; $i >= 1; $i /= 2) {
            for ($j = 0; $j < $i; $j++) {
                ?>
                <div>
                    <h3><?php echo $play_offs[$i]; ?></h3>
                </div>
                <?php
            }
        }
        ?> <?php
        for ($i = $place_matches; $i > 1; $i -= 2) {
            ?>
            <div>
                <h3>Mecz o <?php echo $i ?> miejsce</h3>
            </div>
            <?php
        }
        ?>
    </div>
</div>