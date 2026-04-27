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

async function getSemaine(user){
    let user_id = user.id;
    try{
        const res = await fetch(`../api/semaine/get_semaine_by_user.php?user_id=${user_id}`);
        let semaine = await res.json();
        console.log(semaine);
        return semaine;
    }catch(err){
        console.error(err.message);
    }
}

async function getRecettesfav(user){
    let user_id = user.id;
    try{
        const res = await fetch(`../api/semaine/get_recette_favoris.php?user_id=${user_id}`);
        let recettes = await res.json();
        console.log(recettes);
        return recettes;
    }catch(err){
        console.error(err.message);
    }
}

async function deleteSemaine(user){
    let user_id = user.id;
    try{
        const res = await fetch(`../api/semaine/delete_semaine.php?user_id=${user_id}`);
        let data = await res.json();
        return data;
    }catch(err){
        console.error(err.message);
    }
}


async function addSemaine(user, p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14){
    let user_id = user.id;
    try{
        const response = await fetch(`../api/semaine/add_semaine.php?user_id=${user_id}`, {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json' 
            }, 
            body: JSON.stringify({user_id, p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14})
        });
        let data = await res.json();
        return data;
    }catch(err){
        console.error(err.message);
    }
}


function recettes_random(data){ // me permet de mélanger les recettes entre elles.
    let recettes = data;
    for (let i = recettes.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [recettes[i], recettes[j]] = [recettes[j], recettes[i]];
    }
    return recettes
}


async function creer_tableau_semaine(tableau_nom_recettes, tableau_id_recettes) { // fait le tableau de la semaine
    // console.log(tableau_nom_recettes);
    let container = document.getElementById("tableau");
    let indice1 = 0;
    let indice2 = 0;
    const h1 = document.createElement("h1");
    const hello = document.createTextNode("MA SEMAINE");
    h1.appendChild(hello);
    container.appendChild(h1);
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
                if (tableau_nom_recettes[indice1] !== null) {
                    //console.log(indice);
                    jour = document.createTextNode(tableau_nom_recettes[indice1]);
                    indice1++;
                } else {
                    jour = document.createTextNode('repas');
                }
                td.appendChild(jour);
                td.classList.add("repa");
                tr.appendChild(td);
            } else {
                
                let img = document.createElement('img');
                console.log(`https://l1.dptinfo-usmb.fr/~grp9/api/recettes/api_image_recette.php?id=${tableau_id_recettes[indice2]}`);
                await img.setAttribute('src', `https://l1.dptinfo-usmb.fr/~grp9/api/recettes/api_image_recette.php?id=${tableau_id_recettes[indice2]}`);
                indice2++;
                img.classList.add("image");
                td.appendChild(img);
                tr.appendChild(td);
            }
        }
        table.appendChild(tr);
    }
    div.appendChild(table);
    container.appendChild(div);
}

document.addEventListener("DOMContentLoaded", async () => {    
    let user = await init();
    let semaine = fetch(`../api/semaine/get_semaine_by_user.php?user_id=${user_id}`)
    console.log(semaine);
    if (semaine){
        let recettes = fetch(`../api/semaine/get_recettes_favoris.php?user_id=${user_id}`);
            if (recettes.lenght() < 14) {
                fetch(`../api/semaine/delete_semaine.php?user_id=${user_id}`);
                let container = document.getElementById('message');
                let text = document.createTextNode("Vous n'avez pas assez de recettes en favoris !");
                let h2 = document.createElement("h2");
                h2.appendChild(text);
                container.appendChild(h2);
                let nb_recettes_manquant = (14 - recettes.lenght());
                if (nb_recettes_manquant === 1){
                    let br = createElement("br");
                    let h2 = createElement("h2");
                    let text = createTextNode("Il vous manque 1 recette favorite pour programmer une semaine complète.");
                    h2.appendChild(text);
                    br.appendChild(h2);
                    document.body.appendChild(br);
                } else {
                    
                    let br = createElement("br");
                    let h2 = createElement("h2");
                    let text = createTextNode("Il vous manque "+nb_recettes_manquant+" recette favorite pour programmer une semaine complète.");
                    h2.appendChild(text);
                    br.appendChild(h2);
                    document.body.appendChild(br);
                }
            } else if {
                
            }
    }
});



