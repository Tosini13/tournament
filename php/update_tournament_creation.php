<?php
$group_iterator = 0;
foreach ($tournament->groups as $index => $group) {
    if (isset($_POST['group-' . $group_iterator])) {
        $group->set_name($_POST['group-' . $group_iterator]);
    }
    $team_iterator = 0;
    foreach ($group->teams as $index => $team) {
        if (isset($_POST['team-' . $group_iterator . '-' . $team_iterator])) {
            $team->set_name($_POST['team-' . $group_iterator . '-' . $team_iterator]);
        }
        $team_iterator++;
    }
    $group_iterator++;
}
?>

<div class="myTournament2">
    <?php
    require 'php/compute_tournament.php';
    ?>
    <h3 id="temp"><?php echo $tournament->get_name(); ?></h3>
    <?php
    $group_iterator = 0;
    foreach ($tournament->groups as $index => $group) {
        ?>
        <div class="group" id='<?php echo $index ?>'>
            <input class="groupName" name="<?php echo 'group-' . $group_iterator ?>" type="text" value="<?php echo $group->name ?>"><br>
            <?php
            $team_iterator = 0;
            foreach ($group->teams as $index => $team) {
                ?>
                <input name="<?php echo 'team-' . $group_iterator . '-' . $team_iterator ?>" type="text" placeholder="<?php echo $team->get_name() ?>"><br>
                <?php
                $team_iterator++;
            }
            ?>
        </div>
        <?php
        $group_iterator++;
    }
    ?>
</div>