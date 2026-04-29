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


async function getRecettesfav(user, saison, prix, sante){
    let user_id = user.id;
    console.log(saison, prix, sante);
    console.log(JSON.stringify({saison, prix, sante}));
    try{
        const response = await fetch(`../api/semaine/get_recette_favoris.php?user_id=${user_id}&saison=${saison}&prix=${prix}&sante=${sante}`);
        let data = await response.json();
        return data;
    }catch(err){
        console.error(err.message);
    }
}


async function getAllRecettesfav(user){
    let user_id = user.id;
    try{
        const res = await fetch(`../api/semaine/get_all_fav.php?user_id=${user_id}`);
        let recettes = await res.json();
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


function get_semaine_id(semaine){
    semaine = semaine?.[0] ?? null;
    let tableau_id_recettes = [];
    for (let i = 1; i <= 14; i++) {
        let id = semaine[`id_plat_${i}`];
        tableau_id_recettes.push(id)
        console.log(id);
    }
    console.log(tableau_id_recettes);
    console.log(semaine);
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
    res = true;
    if(semaine.length == 0 || semaine == null){
        res = false;
    }
    return res;
}


async function verifie_saison(user, saison, prix, sante) {
    if (saison == "all"){
        recettes = await getAllRecettesfav(user);
    }
    else{
        recettes = await getRecettesfav(user, saison, prix, sante);
    }
    return recettes
}

async function createSemaine(user, saison, prix, sante){
    console.log(saison, prix, sante);
    const tabRecette = document.getElementById("tableau");
    recettes = await verifie_saison(user, saison, prix, sante);
    console.log(recettes);


    if(recettes.length < 14){
        document.getElementById("Erreurs").textContent = "Vous n'avez pas assez de recettes correspondant à ces critères dans vos favoris."
    }
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
    await addSemaine(user,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14);
}



async function creer_tableau_semaine(nomsRecettes, idsRecettes) {
    const container = document.getElementById("tableau");

    const titre = document.createElement("p");
    titre.textContent = "MA SEMAINE";
    titre.id = "planning-title";
    container.appendChild(titre);

    const wrapper = document.createElement("div");
    wrapper.id = "planning-wrapper";

    const table = document.createElement("table");
    table.id = "planning-table";

    const jours = ['LUNDI', 'MARDI', 'MERCREDI', 'JEUDI', 'VENDREDI', 'SAMEDI', 'DIMANCHE'];

    const thead = document.createElement("thead");
    const headerRow = document.createElement("tr");

    jours.forEach(jour => {
        const th = document.createElement("th");
        
        const p = document.createElement("p");
        p.textContent = jour;
        p.classList.add("planning-day-text");

        th.appendChild(p);
        th.classList.add("planning-day-header");

        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    const tbody = document.createElement("tbody");

    const nbRepas = 2;
    let indexNom = 0;
    let indexImage = 0;

    for (let i = 0; i < nbRepas; i++) {
        const row = document.createElement("tr");
        row.classList.add("planning-row");

        for (let j = 0; j < 7; j++) {
            const td = document.createElement("td");
            td.classList.add("planning-cell");

            const mealWrapper = document.createElement("div");
            mealWrapper.classList.add("meal-wrapper");

            const imgWrapper = document.createElement("div");
            imgWrapper.classList.add("meal-image-wrapper");

            const img = document.createElement("img");
            img.classList.add("meal-image");

            const id = idsRecettes[indexImage];
            img.src = `https://l1.dptinfo-usmb.fr/~grp9/api/recettes/api_image_recette.php?id=${id}`;
            indexImage++;

            imgWrapper.appendChild(img);

            const textWrapper = document.createElement("div");
            textWrapper.classList.add("meal-text-wrapper");

            const p = document.createElement("p");
            p.classList.add("meal-text");

            if (nomsRecettes[indexNom] !== null && nomsRecettes[indexNom] !== undefined) {
                p.textContent = nomsRecettes[indexNom];
            } else {
                p.textContent = "Repas";
            }
            indexNom++;

            textWrapper.appendChild(p);

            mealWrapper.appendChild(imgWrapper);
            mealWrapper.appendChild(textWrapper);

            td.appendChild(mealWrapper);
            row.appendChild(td);
        }

        tbody.appendChild(row);
    }

    table.appendChild(tbody);
    wrapper.appendChild(table);
    container.appendChild(wrapper);
}




function createForm(user) {
    const form = document.getElementById("CreateSemaineForm");
    form.classList.add("week-form");

    const title = document.createElement("h1");
    title.textContent = "Paramètres de la semaine";
    title.classList.add("form-title");

    const fieldsWrapper = document.createElement("div");
    fieldsWrapper.classList.add("form-fields");

    function createSelectField(labelText, id, options) {
        const field = document.createElement("div");
        field.classList.add("form-field");

        const label = document.createElement("label");
        label.textContent = labelText;
        label.setAttribute("for", id);
        label.classList.add("form-label");

        const select = document.createElement("select");
        select.id = id;
        select.name = id;
        select.classList.add("form-select");

        options.forEach(opt => {
            const option = document.createElement("option");
            option.value = opt;
            option.textContent = opt;
            select.appendChild(option);
        });

        field.appendChild(label);
        field.appendChild(select);

        return { field, select };
    }

    const { field: saisonField, select: saisonSelect } = createSelectField("Saison :", "saison", ["printemps", "ete", "automne", "hiver", "all"]);
    const { field: prixField, select: prixSelect } = createSelectField("Prix maximum :", "prix", [5, 4, 3, 2, 1]);
    const { field: santeField, select: santeSelect } = createSelectField("Indice de santé minimum :", "sante", [5, 4, 3, 2, 1]);

    const submitBtn = document.createElement("button");
    submitBtn.textContent = "Valider ces paramètres";
    submitBtn.type = "submit";
    submitBtn.classList.add("form-submit");

    fieldsWrapper.appendChild(saisonField);
    fieldsWrapper.appendChild(prixField);
    fieldsWrapper.appendChild(santeField);

    form.appendChild(title);
    form.appendChild(fieldsWrapper);
    form.appendChild(submitBtn);

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const saison = saisonSelect.value;
        const prix = prixSelect.value;
        const sante = santeSelect.value;

        console.log(saison, prix, sante);

        if (await verifie_semaine(user)) {
            deleteSemaine(user);
        }

        await createSemaine(user, saison, prix, sante);

        alert("Semaine créée en fonction de vos paramètres.");

        const semaine = await getSemaine(user);
        const noms = await get_semaine_titre(semaine);
        const ids = await get_semaine_id(semaine);

        form.style.display = "none";
        document.getElementById("Erreurs").textContent = "";

        await creer_tableau_semaine(noms, ids);
    });
}

document.addEventListener("DOMContentLoaded", async () => {
    console.log("load");
    let user = await init();

    const CreateSemaineForm = document.getElementById("CreateSemaineForm");
    createForm(user);
    CreateSemaineForm.style.display = "none";

    const erreurs = document.getElementById("Erreurs");

    const tabRecette = document.getElementById("tableau");
    
    let recettes = await getAllRecettesfav(user);
    let nb_recettes_manquant = 14 - recettes.length;
    const nb_manquant = `Il vous manque ${nb_recettes_manquant} recettes favorites pour programmer une semaine complète.`;
    
    const Err1 = "Vous n'avez pas assez de recettes en favoris !" + nb_manquant
    const Err2 = "Vous avez retiré de vos favoris une recette présente dans votre semaine. Une nouvelle semaine va être chargée.";
    const Err3 = "Vous n'avez pas assez de recettes en favoris !" + nb_manquant
    
    

    if(await verifie_semaine(user)){
        console.log("semaine OK");
        let semaine = await getSemaine(user)

        if(recettes.length < 14){
            deleteSemaine(user);
            erreurs.textContent = Err1;
        }
        
        else if(!(await compare_semaine_favoris(semaine, recettes))){
            deleteSemaine(user);
            erreurs.textContent = Err2;
        }
        
        else{
            let tableau_nom_recettes = await get_semaine_titre(semaine);
            let tableau_id_recettes = await get_semaine_id(semaine);
            await creer_tableau_semaine(tableau_nom_recettes, tableau_id_recettes);
        }
    }
    
    else{
        console.log('semaine pas OK');

        if(recettes.length < 14){
            erreurs.textContent = Err3;
        }
        
        else{
            CreateSemaineForm.style.display = "flex";
        }
    }
});





