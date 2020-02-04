<?php
require_once 'structures.php';
if (isset($_SESSION['tournament'])) {
    $tournament = &$_SESSION['tournament'];
} else {
    $tournament = new Tournament($_GET['name'], $_GET['no_participants'], $_GET['start_date'], $_GET['end_date']);
    $_SESSION['tournament'] = &$tournament;
    if (isset($_GET['tournament_mode'])) {
        $tournament->set_mode($_GET['tournament_mode']);
        if ($_GET['tournament_mode'] == "0") {
            //GROUP
            $tournament->declare_groups($_GET['no_groups'], $_GET['play_offs']);
        } elseif ($_GET['tournament_mode'] == "1") {
            //PLAY-OFFS
            $tournament->declare_play_offs($_GET['play_offs'], $_GET['place_matches']);
        } else {
            //BOTH
            $tournament->declare_groups($_GET['no_groups'], $_GET['play_offs']);
            $tournament->declare_play_offs($_GET['play_offs'], $_GET['place_matches']);
        }
    }
}

if (isset($_POST['update'])) {
    require 'update_tournament_creation.php';
    require 'toDB.php';
}