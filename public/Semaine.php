<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MA SEMAINE</title>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <?php
        require_once(__DIR__ . '/../db/db_connect.php');
        require_once(__DIR__ . '/../crud/favoris.crud.php');
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        #$user_id = $_SESSION['id']; 
        $user_id = 2;
        $recettes = getRecettesFav($conn, $user_id);
        var_dump($recettes[0]);
    ?>

    <script>
        async function init(){
            try{
                const res = await fetch('../lib/auth_check.php');
                if(res.ok){
                    let data = await res.json();
                    const user = data.user;
                    if(!data.active){
                        window.location.href='./login.php?status=disconnected';
                    }
                    return user;
                }
            }catch(err){
                console.error(err.message);
            }
        }

        window.onload = init();
        user = init();
        console.log(user);



        window.onload = function() { // fait le tableau de la semaine

            const h1 = document.createElement("h1");
            const hello = document.createTextNode("MA SEMAINE");
            h1.appendChild(hello);
            document.body.appendChild(h1);
            const nb_jours = 7;
            const nb_repas = 4;

            const div = document.createElement("div");
            let table = document.createElement("table");

            const tr = document.createElement("tr");
            const jours = ['LUNDI', 'MARDI', 'MERCREDI', 'JEUDI', 'VENDREDI', 'SAMEDI', 'DIMANCHE'];

            for (let y = 0; y < 7; y++) {
                const td = document.createElement("td");
                td.textContent = jours[y];
                td.classList.add("repa", "jour", "ligne_jour");
                tr.appendChild(td);
            }
            table.appendChild(tr);

            for (let i = 0; i < nb_repas; i++) {
                const tr = document.createElement("tr");
                let jour = "";
                for (let j = 0; j < nb_jours; j++) {
                    const td = document.createElement("td");
                    if ((i === 1) || (i === 3)) {
                        jour = document.createTextNode("repa");
                        td.appendChild(jour);
                        td.classList.add("repa");
                        tr.appendChild(td);
                    } else {
                        jour = document.createTextNode("");
                        td.appendChild(jour);
                        tr.appendChild(td);
                    }
                }
                table.appendChild(tr);
            }
            div.appendChild(table);
            document.body.appendChild(div);
        }

    </script>
</body>
</html>