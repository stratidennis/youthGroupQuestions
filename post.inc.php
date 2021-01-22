<?php

if (isset($_POST["trimite"])) {

    require_once "dbh.inc.php";

    $q = $_POST["intrebare"];
    $c = $_POST["varianta"];
    $date  = date("d.m.Y");
    if (empty($q)) {
        header("Location: index.php?error:noTextIntroduced");
        exit();
    } elseif (!preg_match("/^[\r\na-zA-Z0-9ăĂîÎâÂșȘțȚ, ?’.\"\/!#()_&=;:-]*$/", $q)) {
        header("Location: index.php?error:invalidcharactersinPost");
        exit();
    } elseif (strlen($q) > 1500) {
        header("Location: index.php?error:over400characters" . strlen($q));
        exit();
    } elseif (ctype_space($q)) {
        header("Location: index.php?error:whitespace");
        exit();
    } else {
        $sql = "INSERT INTO intrebari (intrebare, categorie, uploadDate) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $q, $c, $date);
            mysqli_stmt_execute($stmt);
            header("Location: index.php?upload=succes");
            exit();
        }
    }
} else {
    header("Location: index.php?error:buttonNotClicked");
    exit();
}