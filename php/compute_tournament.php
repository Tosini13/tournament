<?php

require_once 'structures.php';

$tournament = new Tournament($_GET['name'], $_GET['no_participants'], 2);
$tournament->declare_groups($_GET['no_groups'], $_GET['play_offs']);
$tournament->declare_play_offs($_GET['play_offs'], $_GET['place_matches']);

if (isset($_POST['update'])) {
    //var_dump($tournament);
    //require 'update_tournament_creation.php';
}
