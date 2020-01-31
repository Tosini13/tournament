<div class="myContent">
    <form class="createTournament" method="GET" action="index.php">
        <section>
            <h2>TURNIEJ</h2>
            <h6>Nazwa turnieju</h6>
            <input class="text" type="text" name="name" placeholder="nazwa turnieju">
            <h6>Gospodarz</h6>
            <input class="text" type="text" name="" placeholder="">
            <h6>Logo gospodarza</h6>
            <input type="image" name="logo_gospodarza" placeholder="">
            <h6>Strona gospodarza (URL)</h6>
            <input class="text" type="text" name="strona_gospodarza" placeholder="">
            <h6>Nazwa Sponsora</h6>
            <input class="text" type="text" name="" placeholder="">
            <h6>Strona sponsora (URL)</h6>
            <input class="text" type="text" name="strona_sponsora" placeholder="">
            <h6>Logo sponsora</h6>
            <input type="image" name="logo_sponsora" placeholder="">
            <h6>Tryb Turnieju</h6>
            <select class="text" name="tournament_mode">
                <option value='0'>Group</option>
                <option value='1'>Play-offs</option>
                <option value='2'>Group + Play-offs</option>
            </select>
            <!-- <input class="number" type="text" name="no_participants" placeholder=""> -->
        </section>
        <section>
            <h2>FAZA GRUPOWA</h2>
            <h6>Liczba uczestników</h6>
            <select class="number" name="no_participants">
                <?php
                for ($i = 2; $i < 97; $i++) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                ?>
            </select>
            <h6>Ilość grup</h6>
            <select class="number" name="no_groups">
                <option value="1">1</option>
                <?php
                for ($i = 2; $i < 17; $i *= 2) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                ?>
            </select>
            <h6>Tryb fazy pucharowej</h6>
            <select name='play_offs'>
                <option value="1">Finał</option>
                <option value="2">Finał, Półfinały</option>
                <option value="4">Finał, Półfinały, Ćwierćfinały</option>
                <option value="8">Finał, Półfinały, Ćwierćfinały, 1/16</option>
                <option value="16">Finał, Półfinały, Ćwierćfinały, 1/16, 1/32</option>
            </select>
            <!-- <h6>Ilość drużyn wychodzących z ostatniej grupy</h6>
            <input class="number" type="text" name="no_promotion" value="1"> -->
            <h6>Rewanże</h6>
            <input type="checkbox" name="revange">
            <h6>Punkty za wygraną</h6>
            <input class="number" type="text" name="win_points" value="3">
            <h6>Punkty za remis</h6>
            <input class="number" type="text" name="draw_points" value="1">
            <!-- 
            <h6>Użyj loga uczestników?</h6>
            <input type="checkbox" name="participants_logo" value="">
            <h6>Użyj własne nazwy grup?</h6>
            <input type="checkbox" name="" value="">
            -->
            <h6>Uzyj daty meczy (dla wielodniowych turniejów)?</h6>
            <input type="checkbox" name="" value="">
        </section>
        <section>
            <h2>FAZA PUCHAROWA</h2>
            <h6>Wyłączona</h6>
            <input type="checkbox" name="play_offs">
            <h6>Rewanże</h6>
            <input type="checkbox" name="revange">
            <h6>Mecze o miejsca</h6>
            <select name='place_matches'>
                <option value="3">Finał, 3 miejsce</option>
                <option value="5">Finał, 3 miejsce, 5 miejsce</option>
            </select>
            <!--
            <h6></h6>
            <input type="text" name="" placeholder="">
            -->
        </section>
        <input class="button" name="submit" type="submit" value="Dalej">
    </form>
</div>
<!--
<select>
    <option>Bez</option>
    <option>Mecz i rewanż</option>
    <option>Mecze o miejsca</option>
    <option>Tylko finał</option>
</select>
-->