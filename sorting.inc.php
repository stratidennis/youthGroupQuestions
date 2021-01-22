<?php

if (isset($_POST["submitSort"])) {

    $sortingOption = $_POST['sortare'];

    header("Location: index.php?sortby=" . $sortingOption);
    exit();
} else {
    header("Location: index.php?error:buttonNotClicked");
    exit();
}
