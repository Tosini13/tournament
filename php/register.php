<?php
session_start();
require_once('connect_database.php');

$err_valid = array();
$arr = array();
$arr['email'] = "";
$arr['login'] = "";


if (isset($_POST['btnSignup'])) {

    /* --------------- */
    /* CHECK POLICY    */
    /* --------------- */
    if (!isset($_POST['policy'])) {
        $err_valid['policy'] = "Accept policy!!!";
    }
    /* --------------- */
    /* CHECK BOT PROOF */
    /* --------------- */
    if (isset($_POST['g-recaptcha-response'])) {
        $secret_key = "6Lei360UAAAAAJefMKSG_LogVmRU8Le-dLVBA1VN";
        $check_bot = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response=" . $_POST['g-recaptcha-response']);
        $response_bot = json_decode($check_bot);
        if (!$response_bot->success) {
            $err_valid['policy'] = "Proof that you are human!!!";
        }
    } else {
        $err_valid['policy'] = "Proof that you are human!!!";
    }
    $arr['email'] = $_POST['email'];
    $arr['login'] = $_POST['login'];
    $arr['password'] = NULL;

    /* --------------------- */
    /* CHECK IF LOGIN EXISTS */
    /* --------------------- */
    $result = $db->query("SELECT login FROM users WHERE login='{$arr['login']}'");
    if ($result->rowCount() == 0) {
        if ($arr['login'] != "") {
            
        }
    } else {
        $err_valid['login'] = "This login already exist, choose diffrent one!!!";
    }
    /* --------------------- */
    /* CHECK IF EMAIL EXISTS */
    /* --------------------- */
    $email_save = filter_var($arr['email'], FILTER_SANITIZE_EMAIL); //it's not necessary, because of input validation
    if (filter_var($email_save, FILTER_VALIDATE_EMAIL) == false || $email_save != $arr['email']) {

        $err_valid['email'] = "Email invalid!!!";
    } else {
        $result = $db->query("SELECT email FROM users WHERE email='{$arr['email']}'");
        if ($result->rowCount() == 0) {
            
        } else {
            $err_valid['email'] = "This email already exist!!!";
        }
    }
    /* -------------------------- */
    /* CHECK PASSWORD CORRECTNESS */
    /* -------------------------- */
    if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {

        $err_valid['password'] = "Password has to contain at least 8 and up to 20 characters!!!";
    } else {
        if ($_POST['password'] == $_POST['password2'] && $_POST['password'] != "") {

            $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {

            $err_valid['password'] = "Write an apropriate password two times!!!";
        }
    }

    /* -------- */
    /*  INSERT  */
    /* -------- */
    if (sizeof($err_valid) == 0) {
        /* ------------------------ */
        /* USERS - HASHING */
        /* ------------------------ */
        
        var_dump($arr['login']);
        var_dump($arr['email']);
        var_dump($arr['password']);
        
        $sql = "insert into users(login, password, email) values('{$arr['login']}','{$arr['password']}','{$arr['email']}')";
        $users = $db->exec($sql);
        var_dump($users);
        header("Location: login.php");
        die();
    }
}
?>
<!DOCTYPE>
<html>
    <head>
        <!-- *********************** -->
        <!--        HEAD             -->
        <title>MójTurniej - rejestracja</title>
        <meta name="description" content="Zarejestruj się aby stworzyć własny turniej!">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- *********************** -->
        <!--        META LINKS       -->
        <?php require_once '_meta_links.php'; ?>
        <!-- *********************** -->
        <!-- INTERNAL JAVASCRIPT -->
        <script src="js_register.js" type="text/javascript"></script>
        <!-- END INTERNAL JAVASCRIPT -->
        <script>
            $(document).ready(function () {
                position();
                validity(<?php echo $err_valid ?>);
            });
        </script>
    </head>
    <body>
        <div class="wrapper text-center">
            <!--********************************-->
            <!--            FORM              -->
            <!--********************************-->
            <form method="POST" action="./register.php" target="_self">
                <div class="container col-lg-8 col-md-10 col-11 form">
                    <h2>Registration</h2>
                    <div class="row">
                        <div class="col-md-8 pt-3 ml-auto mr-auto">
                            <label class="col-md-12 mt-md-5"><span class="col-md-6 text-md-right">Email:</span><input class="col-md-6" type="email" name="email" value="<?php echo "{$arr['email']}"; ?>"></label>
                            <label class="col-md-12 mt-md-2"><span class="col-md-6 text-md-right">Login:</span><input class="col-md-6" type="text" name="login" value="<?php echo "{$arr['login']}"; ?>"></label>
                            <label class="col-md-12 mt-md-2"><span class="col-md-6 text-md-right">Password:</span><input class="col-md-6" type="password" name="password"></label>
                            <label class="col-md-12 mt-md-2"><span class="col-md-6 text-md-right">Repeat password:</span><input class="col-md-6" type="password" name="password2"></label>
                            <label class="col-md-5 mt-md-2"><input class="col-md-3 col-2 mt-4" type="checkbox" name="policy" value="accepted"><span class="col-md-9 col-10">Accept Policy</span></label>
                            <div class="g-recaptcha mt-3 ml-auto mr-auto" data-sitekey="6Lei360UAAAAADDLwAT3hnbWKsrRP_408xZwVtbs"></div>
                        </div>
                    </div>
                    <div class="row">
                        <input class="col-2 mt-3 ml-auto mr-auto buttons" id="button" type="submit" name="btnSignup" value="Sign up">
                    </div>
                </div>
            </form>
            <a id="back" href="./login.php"><button id="btnSignup" class="buttons mb-5">Back to sign in</button></a>
            <!--********************************-->
            <!--            ERRORS              -->
            <!--********************************-->
            <?php
            if (sizeof($err_valid) != 0) {
                foreach ($err_valid as $value) {
                    echo "<p class='error_my'>$value</p>";
                }
            }
            ?>
        </div>
        <!-- *********************** -->
        <!--     EXTERNAL LINKS      -->
        <!-- EXTERNAL-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!-- END EXTERNAL -->
        <!-- BOOTSTRAP -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- *********************** -->
    </body>
</html>