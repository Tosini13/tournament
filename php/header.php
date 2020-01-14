<header id="myHeader">
    <nav>
        <ul>
            <a href="index.php"><li><img src="" alt="icon"><h6>MójTurniejPlan</h6></li></a>
            <?php
            if (isset($_SESSION['username']) && $_SESSION['username'] != false) {
                ?>
                <a href="index.php?page=my_tournaments"><li><img src="" alt="icon"><h6>Moje turnieje</h6></li></a>
                <?php
            }
            ?>
        </ul>
        <ul>
            <?php
            if (isset($_SESSION['username']) && $_SESSION['username'] != false) {
                ?>
                <a href="#php/myaccount.php"><li><img src="" alt="icon"><h6><?php echo $_SESSION['username'] ?></h6></li></a>
                <a href="php/login.php?logout=true"><li><img src="" alt="icon"><h6>wyloguj</h6></li></a>
                <?php
            } else {
                ?>
                <a href="php/login.php"><li><img src="" alt="icon"><h6>zaloguj</h6></li></a>
                <a href="php/register.php"><li><img src="" alt="icon"><h6>zarejestruj</h6></li></a>
                <?php
            }
            ?>
            <a href="#ceny"><li><img src="" alt="icon"><h6>ceny</h6></li></a>
            <a href="#o_nas"><li><img src="" alt="icon"><h6>o nas</h6></li></a>
            <a href="#pomoc"><li><img src="" alt="icon"><h6>pomoc</h6></li></a>
        </ul>
    </nav>
</header>