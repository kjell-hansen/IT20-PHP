<p>Hej <?= $namn; ?></p>
<p>Här är dina tärningars värde:</p>
<form method="POST">
    Du har slagit <?= $antalSlag; ?> gånger<br>
    <input type="hidden" name="antalSlag" value="<?= $antalSlag;?>">
    Markera tärningarna du vill slå om...<br>
    <?php
        foreach($tarning as $key=>$value){
            echo "<div class='tarningarna'><img src='bilder/dice_$value.png' alt='Tärning_$value' height=15><br><input type='checkbox' name='tarning_$key'></div>";
            echo "<input type='hidden' name='t_$key' value='$value'>";
        }
    ?>
    <br>
    <input type="submit" name="submit" value="Nästa slag">
</form>
