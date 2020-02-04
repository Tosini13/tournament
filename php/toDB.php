<?php

$validity = true;
if ($tournament->get_mode() == 0) {
    $result = $db->prepare("insert into tournament(login, name, participants_qtt, group_qtt, play_offs_qtt, tournament_mode, start_date, finish_date) values('" . $_SESSION['username'] . "','" . $tournament->get_name() . "'," . $tournament->get_participants_qtt() . "," . $tournament->get_group_qtt() . "," . $tournament->get_play_offs_qtt() . "," . $tournament->get_mode() . "," . $tournament->get_start_date() . "," . $tournament->get_end_date() . ")");
} elseif ($tournament->get_mode() == 1) {
    $result = $db->prepare("insert into tournament(login, name, participants_qtt, play_offs_qtt, no_last_place, tournament_mode, start_date, finish_date) values('" . $_SESSION['username'] . "','" . $tournament->get_name() . "'," . $tournament->get_participants_qtt() . "," . $tournament->get_play_offs_qtt() . "," . $tournament->get_no_last_place() . "," . $tournament->get_mode() . "," . $tournament->get_start_date() . "," . $tournament->get_end_date() . ")");
} else {
    $result = $db->prepare("insert into tournament(login, name, participants_qtt, group_qtt,  play_offs_qtt, no_last_place, tournament_mode, start_date, finish_date) values('" . $_SESSION['username'] . "','" . $tournament->get_name() . "'," . $tournament->get_participants_qtt() . "," . $tournament->get_group_qtt() . "," . $tournament->get_play_offs_qtt() . "," . $tournament->get_no_last_place() . "," . $tournament->get_mode() . "," . $tournament->get_start_date() . "," . $tournament->get_end_date() . ")");
}
$result = $result->execute();
$tournament->set_id($db->lastInsertId());
if (!$result) {
    $validity = false;
}
//group_stage
if ($tournament->get_mode() == 0 || $tournament->get_mode() == 2) {
    foreach ($tournament->groups as $index => $group) {
        $result = $db->prepare("insert into group_stage(tournament_id, teams_qtt, name) values(" . $tournament->get_id() . "," . $group->get_teams_qtt() . ",'" . $group->name . "')");
        $result = $result->execute();
        if (!$result) {
            $validity = false;
        }
        $group->set_id($db->lastInsertId());
        foreach ($group->teams as $index => $team) {
            $result = $db->prepare("insert into teams(tournament_id, group_id, name) values(" . $tournament->get_id() . "," . $group->get_id() . ",'" . $team->get_name() . "')");
            $result = $result->execute();
            if (!$result) {
                $validity = false;
            }
            $team->set_id($db->lastInsertId());
        }

        foreach ($group->get_matches() as $index => $match) {
            $result = $db->prepare("insert into matches(tournament_id, group_id, home_id, away_id) values(" . $tournament->get_id() . "," . $group->get_id() . "," . intval($match->get_team1()->get_id()) . "," . intval($match->get_team2()->get_id()) . ")");
            $result = $result->execute();
            $match->set_id($db->lastInsertId());
            if (!$result) {
                $validity = false;
            }
        }
    }
}

//play-offs
if ($tournament->get_mode() == 1 || $tournament->get_mode() == 2) {
    foreach ($tournament->play_offs->rounds as $round => $matches) { //even means play-off structure
        foreach ($matches as $index => $match) {
            $result = $db->prepare("insert into matches(tournament_id, play_offs_id, home_id, away_id) values(" . $tournament->get_id() . "," . array_search($match->get_name(), $tournament->play_offs->round) . "," . intval($match->get_team1()->get_id()) . "," . intval($match->get_team2()->get_id()) . ")");
            $result = $result->execute();
            $match->set_id($db->lastInsertId());
            if (!$result) {
                $validity = false;
            }
        }
    }

    foreach ($tournament->play_offs->places as $place => $match) { //odd means place
        $result = $db->prepare("insert into matches(tournament_id, play_offs_id, home_id, away_id) values(" . $tournament->get_id() . "," . $place . "," . intval($match->get_team1()->get_id()) . "," . intval($match->get_team2()->get_id()) . ")");
        $result = $result->execute();
        $match->set_id($db->lastInsertId());
        if (!$result) {
            $validity = false;
        }
    }
}

if (!$validity) {
    var_dump('DB error');
} else {
    var_dump('DB inserted');
}
?>