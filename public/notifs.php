<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // include "/home/perivolas/public_html/mealtime/lib/notifsAffichage.php";     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifs</title>

    <script src="/~perivolas/mealtime/public/js/notifs.js?v=3" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>

    <link rel="stylesheet" href="../css/notifs.css?v=2">

</head>
<body>
    <!-- Juste pour. tester les notifs, a integrer ou on veux -->
     <p>yo</p>
     
    <div id="notifs_div">
        <div id="notifs_display_div" class="hidden">
            <p id="notif_p">NOTIFICATIONS</p>
        </div>
    </div>
</body>
</html>