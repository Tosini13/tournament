<?php
require_once 'php/connect_database.php';
session_start();
/* -------------------- */
/*       SET USER       */
/* -------------------- */
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = false;
}
?>
<!DOCTYPE>
<html>
    <head lang="pl">
        <!-- *********************** -->
        <!--        HEAD             -->
        <title>MójTurniej</title>
        <!-- *********************** -->
        <!--           CSS           -->
        <!-- *********************** -->
        <link href="css/css_header.css" type="text/css" rel="stylesheet">
        <link href="css/css_main_content.css" type="text/css" rel="stylesheet">
        <link href="css/css_my_tournaments.css" type="text/css" rel="stylesheet">
        <link href="css/css_footer.css" type="text/css" rel="stylesheet">
        <link href="css_index.css" type="text/css" rel="stylesheet">
        <!-- EXTERNAL -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- BOOTSTRAP -->
        <link href="_external/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="_external/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body id="mybody">
        <!-- *********************** -->
        <!--         HEADER          -->
        <!-- *********************** -->
        <?php require 'php/header.php'; ?>
        <!-- *********************** -->
        <!--        CONTENT          -->
        <!-- *********************** -->
        <?php
        if (isset($_GET['page']) && $_SESSION['username'] != false) {
            $url = "php/" . $_GET['page'] . ".php";
            require $url;
        } else {
            if(isset($_GET['submit'])) {
                require 'php/create_tournament_2.php';
            } else {
                require 'php/content.php';
            }
        }
        ?>
        <!-- *********************** -->
        <!--         FOOTER          -->
        <!-- *********************** -->
        <?php require 'php/footer.php'; ?>
        <!-- *********************** -->
        <!--            JS           -->
        <!-- *********************** -->
    </body>
</html>