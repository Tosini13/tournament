<?php
require_once('connect_database.php');
session_start();
/* -------------------- */
/*       SET USER       */
/* -------------------- */
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = false;
}
/* -------------------- */
/*       LOG OUT        */
/* -------------------- */
if (isset($_GET['logout'])) {
    $_SESSION['username'] = false;
}
$err_valid = array();
/* -------------------- */
/*       LOG IN         */
/* -------------------- */
if (isset($_POST['btnlogin'])) {

    if (strpos($_POST['login'], '@')) {
        $login = $db->query("SELECT login, password FROM users WHERE email='{$_POST['login']}'");
    } else {
        $login = $db->query("SELECT login, password FROM users WHERE login='{$_POST['login']}'");
    }
    if ($login->rowCount()) {
        $password = $login->fetch();
        if (password_verify($_POST['password'], $password['password'])) {
            $_SESSION['username'] = $_POST['login'];
            //var_dump($_SESSION['username']);
            //var_dump($_SESSION['username']);
            header("Location: ../index.php");
            die();
        } else {

            $err_valid['password'] = "Witaj {$_POST['login']}, nie zapomniałeś przypadkiem hasła? ;)!";
        }
    } else {

        $err_valid['password'] = "Wpisałeś błędny login lub hasło! :/";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- *********************** -->
        <!--        HEAD             -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MójTurniej - logowanie</title>
        <!-- *********************** -->
        <!--        META LINKS       -->
        <?php require_once '_meta_links.php'; ?>
        <!-- *********************** -->
    </head>
    <body>
        <div class="wrapper">
            <h1 class="ml-auto mr-auto mt-3 mb-5">Zaloguj się aby stworzyć własny turniej!</h1>
            <div class="container col-md-7 col-11 form">
                <div class="row">
                    <form class="col-md-12 ml-auto mr-auto mt-3 mb-3 text-center container" method="POST" action="./login.php" target="_self">
                        <div class="row">
                            <div class="col-lg-4 col-10 ml-auto mr-auto mt-3 mb-3 text-center">
                                <h6>Login lub email:</h6>
                                <input type="text" name="login" placeholder="login lub email">
                            </div>
                            <div class="col-lg-4 col-10 ml-auto mr-auto mt-3 mb-3 text-center">
                                <h6>Hasło:</h6>
                                <input type="password" name="password" placeholder="hasło">
                            </div>
                        </div>
                        <input id="button" class="buttons" type="submit" name="btnlogin" value="Zaloguj">
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto mt-3 mb-3 text-center">
                        <h6>Nie masz jeszcze konta?</h6>
                        <a href="register.php"><button id="btnSignup" class="buttons">Zarejestruj</button></a>
                        <a href="../index.php"><button id="btnWithout" class="buttons">Kontynuuj bez logowania</button></a>
                    </div>
                    <?php
                    if (sizeof($err_valid) != 0) {
                        foreach ($err_valid as $value) {
                            echo "<p class='col-md-12 ml-auto mr-auto mt-3 mb-3 text-center'>$value</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>