<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='style.css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico'>
    <title>Întrebări și propuneri</title>
</head>

<style>
    <?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fullUrl, "error:") == true) {
        echo ".addQ textarea::placeholder {color: #ff393cc2;}";
    }
    ?>
</style>

<body>
    <div class='content'>
        <div class='wrapper'>
            <div class=logoImage>
                <img class='logo' src='images/logo.png' alt='Logo'>
            </div>
            <h1 class='info'>Adaugă o întrebare</h1>
            <form action='post.inc.php' method='post'>
                <div class='addQ'>
                    <textarea name='intrebare' placeholder=
                    <?php
                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "error:noTextIntroduced") == true) {
                        echo "' Nu ai introdus nimic'";
                    } elseif (strpos($fullUrl, "error:invalidcharactersinPost") == true) {
                        echo "' Caractere nepermise au fost introduse'";
                    } elseif (strpos($fullUrl, "error:over400characters") == true) {
                        echo "' Prea multe caractere'";
                    } elseif (strpos($fullUrl, "error=sqlerror") == true) {
                        echo "' A apărut o eroare. Încearcă din nou'";
                    } elseif (strpos($fullUrl, "error:whitespace") == true) {
                        echo "' Nu ai introdus nimic'";
                    } else {
                        echo "' Introdu o întrebare'";
                    }
                    ?>
                    ></textarea>
                </div>
                <div class='buttons'>
                    <div class='dropdown selectors'>
                        <button class='blue' disabled>Categoria</button>
                        <div class="dropdown-content">
                            <input class='visuallyHidden options' type='radio' id='intrebare' name='varianta' value='întrebare' checked><label for='intrebare'>Întrebare</label>
                            <input class='visuallyHidden options' type='radio' id='propunere' name='varianta' value='propunere'><label for='propunere'>Propunere</label>
                        </div>
                    </div>
                    <div class='selectors'>
                        <button name='trimite' class='gold'>Trimite</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="questionsSection">
            <?php

            require_once "dbh.inc.php";

            $sql = "SELECT * FROM intrebari ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<div class='intrebari'>";
                echo "<div class='category'>" . $row["categorie"] . "</div>";
                echo "<div class='textIntrebare'>" . $row["intrebare"] . "</div>";
                echo "<div class='dataUpload'>" . $row["uploadDate"] . "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <div class='push'></div>
    </div>
    <footer>
        <div class='externalLinks'>
            <a class='link1' href='https://www.instagram.com/tineretbujac/' target="_blank"><img src='images/instagram.png' alt='Instagram link'></a>
            <a class='link2' href='https://www.facebook.com/groups/965109080215342/' target="_blank"><img src='images/facebook.png' alt='Facebook link'></a>
        </div>
    </footer>
</body>

</html>
