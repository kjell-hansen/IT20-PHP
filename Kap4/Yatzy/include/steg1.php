<p>Hej <?= $namn; ?></p>
<p>Här är dina tärningars värde:</p>
<form method="POST">
    Du har slagit <?= $antalSlag; ?> gånger<br>
    <input type="shidden" name="antalSlag" value="<?= $antalSlag;?>">
    Markera tärningarna du vill slå om...<br>
    <?php
        foreach($tarning as $key=>$value){
            echo "Tärning $key:$value <input type='checkbox' name='tarning_$key'><br>";
            echo "<input type='shidden' name='t_$key' value='$value'>";
        }
    ?>
    <input type="submit" name="submit" value="Nästa slag">
</form>
