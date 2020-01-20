<?php

require_once 'structures.php';
if (isset($_SESSION['tournament'])) {
    $tournament = &$_SESSION['tournament'];
} else {
    $tournament = new Tournament($_GET['name'], $_GET['no_participants']);
    $_SESSION['tournament'] = &$tournament;
    $tournament->declare_groups($_GET['no_groups'], $_GET['play_offs']);
    $tournament->declare_play_offs($_GET['play_offs'], $_GET['place_matches']);
}


if (isset($_POST['update'])) {
    require 'update_tournament_creation.php';
}