<p>Du har slagit alla slagen. Dina tärningar visar:<br>
    <?php
        foreach($tarning as $key=>$value){
            echo "<div class='tarningarna'><img src='bilder/dice_$value.png' alt='Tärning_$value' height=15></div>";
        }
    ?>
    <br>
    Du fick en <?= $resultat['resultat']; ?> med värdet <?= $resultat['varde']; ?>
<form method="POST">
    <input type="submit" name="submit" value="Spela igen">
    <input type="submit" name="submit" value="Göra något tråkigt">
</form>