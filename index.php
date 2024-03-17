<?php

session_start();

$gewonnenVerloren = "noch nicht gespielt";

if (!isset($_SESSION['zaehler'])) {
    $_SESSION['zaehler'] = 0;
}
if (!isset($_SESSION['erfolgreicheVersuche'])) {
    $_SESSION['erfolgreicheVersuche'] = 0;
}

if (isset($_POST['button1']) || isset($_POST['button2']) || isset($_POST['button3'])) {
    $randomWert = mt_rand(0, 1);
    if ($randomWert == 0) {
        $gewonnenVerloren = "gewonnen";
        $_SESSION['erfolgreicheVersuche']++;
    } else {
        $gewonnenVerloren = "verloren";
    }
    $_SESSION['zaehler']++;

    if ($_SESSION['zaehler'] >= 20) {
        $_SESSION['zaehler'] = 0;
        $_SESSION['erfolgreicheVersuche'] = 0;
    }
}

print '<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glückspiel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        button {
            float: left;
            margin-top: 10%;
            border-top-left-radius: 50%;
            border-top-right-radius: 50%;
            border-bottom-left-radius: 50%;
            border-bottom-right-radius: 50%;
            font-size: 300%;
            background-color: transparent;
            background-repeat: no-repeat;
            border: none;
        }

        .spielumfang {
            display: flex;
            position: absolute;
            top: 40%;
            left: 40%;
            justify-content: space-around;
            width: 25vw;
            background-color: #a2c2c0;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transform: scale(250%);
        }

        body {
            background-color: #a2c2c0;
        }

        b {
            font-family: sans-serif;
            font-size: 1rem;
        }
    </style>
</head>
<body>
<div class="spielumfang">
<div class="schrift_oben_flex"><b>Ich möchte ein Spiel spielen. Du musst wählen!</b></div>  
<div class="buttons_unten_flex">
<form action="index.php" method="post">
<button name="button1">&#128512;</button>
<button name="button2">&#128513;</button>
<button name="button3">&#128509;</button>
</form>
</div>
<div>
<br>
<br>
    <b>Du hast ' . $gewonnenVerloren . '.</b>
    <br><br>
</div>';

$statistikText = 'Statistik: Du hast ' . $_SESSION['erfolgreicheVersuche'] . ' Versuche von ' . $_SESSION['zaehler'] . ' korrekt.';
if ($_SESSION['zaehler'] > 0) {
    $erfolgsquote = ($_SESSION['erfolgreicheVersuche'] / $_SESSION['zaehler']) * 100;
    $statistikText .= '<br>Statistik: Du hast ' . number_format($erfolgsquote, 2) . '% korrekt.';
} else {
    $statistikText .= '<br>Statistik: Noch keine Versuche unternommen.';
}

print '<div class="statistik"><b>' . $statistikText . '</b></div>';

print '</div>
</body>
</html>';