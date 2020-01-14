<?php

/* GROUP STAGE */
$tournament_name = $_GET['name'];
$no_groups = $_GET['no_groups'];
$no_participants = $_GET['no_participants'];
$no_teams_in_group = $no_participants / $no_groups; //no teams in group
if ($no_groups != 1) {
    $rest_teams = $no_participants % $no_groups; //when odd no of participants
} else {
    $rest_teams = 1;
}
$group_name = 65; //ASCII

/* PLAY OFFS */
$no_play_offs = $_GET['play_offs'];
while ($no_play_offs*2 > $no_participants) {  //when there's more play offs than participants
    $no_play_offs /= 2;
}
$play_offs = array(1 => "Finał", 2 => "Półfinał", 4 => "Ćwierćfinał", 8 => "1/16", 16 => "1/32");
$place_matches = $_GET['place_matches'];
?>