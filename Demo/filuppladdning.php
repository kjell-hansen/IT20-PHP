<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Filuppladdning</title>
    </head>
    <body>
        <form enctype="multipart/form-data" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000">
            Fil att skicka (max 30kb): <input name="userfile" type="file" accept="image/*"><br>
            <input type="submit" value="Skicka">
        </form>
<?php
    if($_FILES) {
        $mapp="c:\\temp\\";
        $uppladdadFil=$mapp . basename($_FILES['userfile']['name']);
        echo "<pre>";
        if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uppladdadFil)) {
            echo "Filen laddades upp och finns lagras på: $uppladdadFil.<br>";
        } else {
            echo "Något gick fel vid uppladdningen!<br>";
        }
        echo "Här finns lite mer info om filen:";
        print_r($_FILES);
        echo "</pre>";
    }
?>
    </body>
</html>
