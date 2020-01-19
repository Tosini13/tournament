<div class="myContent">
    <div class="myTournament2">
        <?php
        require 'php/compute_tournament.php';
        //var_dump($tournament);
        ?>
        <h3 id="temp"><?php echo $tournament->get_name(); ?></h3>
        <?php
        foreach ($tournament->groups as $index => $group) {
            ?>
            <div class="group" id='<?php echo $index ?>'>
                <input class="groupName" type="text" value="Grupa <?php echo $group->name ?>"><br>
                <?php
                foreach ($group->teams as $index => $team) {
                    ?>
                    <input type="text" placeholder="<?php echo $team->get_name() ?>"><br>
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
        foreach ($tournament->play_offs->rounds as $round => $matches) {
            foreach ($matches as $index => $match) {
                ?>
                <div>
                    <h3><?php echo $match->get_name(); ?></h3>
                    <div class="play_off_match"><input type="text" placeholder="<?php echo $match->get_team1()->get_name() ?>"> vs <input type="text" placeholder="<?php echo $match->get_team2()->get_name() ?>"></div>
                </div>
                <?php
            }
        }
        foreach ($tournament->play_offs->places as $place => $match) {
            ?>
            <div>
                <h3>Mecz o <?php echo $place ?> miejsce</h3>
                <div class="play_off_match"><input type="text" placeholder="<?php echo $match->get_team1()->get_name() ?>"> vs <input type="text" placeholder="<?php echo $match->get_team2()->get_name() ?>"></div>
            </div>
            <?php
        }
        ?>
    </div>
</div>