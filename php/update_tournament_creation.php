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