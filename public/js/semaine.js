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


async function getAllRecettesfav(user){
    let user_id = user.id;
    try{
        const res = await fetch(`../api/semaine/get_all_fav.php?user_id=${user_id}`);
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
        let data = await response.json();
        return data;
    }catch(err){
        console.error(err.message);
    }
}


async function getRecetteById(id){
    try{
        const res = await fetch(`../api/semaine/get_recette_by_id.php?id=${id}`);
        let recette = await res.json();
        return recette;
    }catch(err){
        console.error(err.message);
    }
}


function recettes_random(data){ 
    for (let i = data.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [data[i], data[j]] = [data[j], data[i]];
    }
    return data;
}
    

async function get_semaine_titre(semaine){
    semaine = semaine?.[0] ?? null;
    let tableau_nom_recettes = [];
    for (let i = 1; i <= 14; i++) {
        let id = semaine[`id_plat_${i}`];
        let recette = await getRecetteById(id);
        tableau_nom_recettes.push(recette.titre);
    }
    console.log(tableau_nom_recettes);
    return tableau_nom_recettes;
}


function get_semaine_id(semaine, recettes){
    semaine = semaine?.[0] ?? null;
    let tableau_id_recettes = [];
    for (let i = 1; i <= 14; i++) {
        let id = semaine[`id_plat_${i}`];
        tableau_id_recettes.push(id);
    }
    return tableau_id_recettes;
}


function trouve_dans_favoris(id_de_la_recette, recettes){
    let trouve = false;
    let i = 0; 
    while (i < recettes.length && (!trouve)) {
        if (id_de_la_recette == recettes[i]['recette_id']){
            trouve = true;
        }
        i++;
    }
    return trouve;
}


async function compare_semaine_favoris(semaine, recettes){
    let res = true;
    semaine = await get_semaine_id(semaine, recettes);
    for (let i = 0; i < 14; i++) {
        let id_de_la_recette = semaine[i];
        if (!trouve_dans_favoris(id_de_la_recette, recettes)){
            res = false;
        }
    }
    return res;
}


async function verifie_semaine(user){
    let semaine = await getSemaine(user);
    return semaine != null;
}


async function creer_tableau_semaine(tableau_nom_recettes, tableau_id_recettes) {
    let indice1 = 0;
    let indice2 = 0;
    const table = document.getElementById("tableau");
    const h1 = document.createElement("h1");
    const hello = document.createTextNode("MA SEMAINE");
    h1.appendChild(hello);
    table.appendChild(h1);
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
    table.appendChild(div);
}


function createForm(){
    const CreateSemaineForm = document.getElementById("CreateSemaineForm");
    const Titre = document.createElement("h1");
    const titre = document.createTextNode("Paramètres de la semaine");
    Titre.appendChild(titre);

    const Label1 = document.createElement("label");
    const label1 = document.createTextNode("Saison :");
    Label1.appendChild(label1);
    const select1 = document.createElement("select");
    ["printemps", "ete", "automne", "hiver", "all"].forEach(elem => {
        const option = document.createElement("option");
        option.value = elem;
        option.textContent = elem;
        select1.appendChild(option);
    });
    
    const Label2 = document.createElement("label");
    const label2 = document.createTextNode("Prix maximum :");
    Label2.appendChild(label2);
    const select2 = document.createElement("select");
    [5,4,3,2,1].forEach(elem => {
        const option = document.createElement("option");
        option.value = elem;
        option.textContent = elem;
        select2.appendChild(option);
    });
    
    const Label3 = document.createElement("label");
    const label3 = document.createTextNode("Indice de santé minimum :");
    Label3.appendChild(label3);
    const select3 = document.createElement("select");
    [5,4,3,2,1].forEach(elem => {
        const option = document.createElement("option");
        option.value = elem;
        option.textContent = elem;
        select3.appendChild(option);
    });

    const btn = document.createElement("button");
    btn.textContent = "Valider ces paramètres";

    CreateSemaineForm.appendChild(Titre);
    
    CreateSemaineForm.appendChild(Label1);
    CreateSemaineForm.appendChild(select1);
    
    CreateSemaineForm.appendChild(Label2);
    CreateSemaineForm.appendChild(select2);
    
    CreateSemaineForm.appendChild(Label3);
    CreateSemaineForm.appendChild(select3);
    
    CreateSemaineForm.appendChild(btn);

    CreateSemaineForm.addEventListener("submit", async () => {
        const saison = select1.value;
        const prix = select2.value;
        const sante = select3.value;


        await addSemaine(user,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14);
        alert("Semaine crée en fonction de vos paramètres.")
    });
}


document.addEventListener("DOMContentLoaded", async () => {
    let user = await init();
    createForm();
    const CreateSemaineForm = document.getElementById("CreateSemaineForm");
    CreateSemaineForm.style.display = "none";
    
    if(await verifie_semaine(user)){
        let recettes = await getAllRecettesfav(user);
        let semaine = await getSemaine(user);
        
        if(recettes.length < 14){
            deleteSemaine(user);
            const Err1 = document.createElement("h2");
            const err1 = document.createTextNode("Vous n'avez pas assez de recettes en favoris !");
            let nb_recettes_manquant = 14 - recettes.length;
            const nb_manquant = document.createTextNode("Il vous manque "+nb_recettes_manquant+" recettes favorites pour programmer une semaine complète.");
            Err1.appendChild(err1);
            Err1.appendChild(nb_manquant);
        }
        
        else if(!(await compare_semaine_favoris(semaine, recettes))){
            deleteSemaine(user);
            const Err2 = document.createElement("h2");
            const err2 = document.createTextNode("Vous avez retiré de vos favoris une recette présente dans votre semaine.");
            const nv_semaine = document.createTextNode("Une nouvelle semaine va être chargée.");
            Err2.appendChild(err2);
            Err2.appendChild(nv_semaine);
        }
        
        else{
            let tableau_nom_recettes = await get_semaine_titre(semaine);
            let tableau_id_recettes = get_semaine_id(semaine, recettes);
            await creer_tableau_semaine(tableau_nom_recettes, tableau_id_recettes);
        }
    }
    
    else{
        let recettes = getRecettesfav(user);
        if(recettes.length < 14){
            const Err3 = document.createElement("h2");
            const err3 = document.createTextNode("Vous n'avez pas assez de recettes en favoris !");
            let nb_recettes_manquant = 14 - recettes.length;
            const nb_manquant = document.createTextNode("Il vous manque "+nb_recettes_manquant+" recettes favorites pour programmer une semaine complète.");
            Err3.appendChild(err3);
            Err3.appendChild(nb_manquant);
        }
        
        else{
            recettes_shuffle = recettes_random(recettes);
            let p1 = recettes_shuffle[0]['recette_id'];
            let p2 = recettes_shuffle[1]['recette_id'];
            let p3 = recettes_shuffle[2]['recette_id'];
            let p4 = recettes_shuffle[3]['recette_id'];
            let p5 = recettes_shuffle[4]['recette_id'];
            let p6 = recettes_shuffle[5]['recette_id'];
            let p7 = recettes_shuffle[6]['recette_id'];
            let p8 = recettes_shuffle[7]['recette_id'];
            let p9 = recettes_shuffle[8]['recette_id'];
            let p10 = recettes_shuffle[9]['recette_id'];
            let p11 = recettes_shuffle[10]['recette_id'];
            let p12 = recettes_shuffle[11]['recette_id'];
            let p13 = recettes_shuffle[12]['recette_id'];
            let p14 = recettes_shuffle[13]['recette_id'];
            CreateSemaineForm.style.display = "flex";
            let semaine = getSemaine(user);
            let tableau_nom_recettes = await get_semaine_titre(semaine);
            let tableau_id_recettes = get_semaine_id(semaine, recettes);
            await creer_tableau_semaine(tableau_nom_recettes, tableau_id_recettes);
        }
    }
});





