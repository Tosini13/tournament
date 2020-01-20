<div class="myContent">
    <form action="" method="POST">
        <!-- SEND TOURNAMENT CLASS!!!! -->
        <div class="myTournament2">
            <?php
            require 'php/compute_tournament.php';
            ?>
            <h3 id="temp"><?php echo $tournament->get_name(); ?></h3>
            <?php
            $group_iterator = 0;
            foreach ($tournament->groups as $index => $group) {
                ?>
                <h5><input class="groupName" name="<?php echo 'group-' . $group_iterator ?>" type="text" value="<?php echo $group->name ?>"></h5>
                <div class="groupStage">
                    <div class="group" id='<?php echo $index ?>'>
                        <?php
                        $team_iterator = 0;
                        foreach ($group->teams as $index => $team) {
                            ?>
                            <input name="<?php echo 'team-' . $group_iterator . '-' . $team_iterator ?>" type="text" value="<?php echo $team->get_name() ?>"><br>
                            <?php
                            $team_iterator++;
                        }
                        ?>
                    </div>
                    <div>
                        <?php
                        foreach ($group->get_matches() as $index => $match) {
                            ?>
                            <div class = "play_off_match"><input type = "text" disabled = "true" value="<?php echo $match->get_team1()->get_name() ?>"> vs <input type = "text" disabled = "true" value = "<?php echo $match->get_team2()->get_name() ?>"></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $group_iterator++;
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
                        <div class="play_off_match"><input type="text" disabled="true" placeholder="<?php echo $match->get_team1()->get_name() ?>"> vs <input type="text" disabled="true" placeholder="<?php echo $match->get_team2()->get_name() ?>"></div>
                    </div>
                    <?php
                }
            }
            foreach ($tournament->play_offs->places as $place => $match) {
                ?>
                <div>
                    <h3>Mecz o <?php echo $place ?> miejsce</h3>
                    <div class="play_off_match"><input type="text" disabled="true" placeholder="<?php echo $match->get_team1()->get_name() ?>"> vs <input type="text" disabled="true" placeholder="<?php echo $match->get_team2()->get_name() ?>"></div>
                </div>
                <?php
            }
            ?>
        </div>
        <input class="button" name="update" type="submit" value="Dalej">
    </form>
</div>