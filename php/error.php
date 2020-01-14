<?php
if (isset($_GET['err'])) {
    $info = $_GET['err'];
}
?>

<!DOCTYPE>
<html>
    <head>
        <title>CONNECTION ERROR</title>
    </head>
    <body>
        <div id="container">
            <div id="content">
                <h1>PRZEPRASZAMY ZA PROBLEM!<br>Spróbuj ponownie później</h1>
                <h3>Pracujemy nad problemem...</h3>
                <h6><?php echo "Error: $info"; ?></h6>
            </div>
        </div>
    </body>
</html>
<style>
    h1,h3,h6{
        margin-top: 10vh;
        text-align: center;
    }
</style>