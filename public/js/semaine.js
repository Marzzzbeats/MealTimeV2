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

async function getRecettes(user){
    let user_id = user.id;
    try{
        const res = await fetch(`../api/api_recettes.php?action=fav&user_id=${user_id}`);
        let recettes = await res.json();
        let recettes_random = [];
        for (let i = recettes.length; i >= 0; i--) {
            let nombre_aleatoire = getRandomInt(i);
            let recette = recettes.splice(nombre_aleatoire, 1);
            recettes_random.push(recette.titre);
        };
        return recettes_random;
    }catch(err){
        console.error(err.message);
    }
}




window.onload = init();
user = init();
console.log(user);

function recettes_random(data){ // me permet de mélanger les recettes entre elles.
    let recettes = data;
    for (let i = recettes.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [recettes[i], recettes[j]] = [recettes[j], recettes[i]];
    }
    return recettes
}


const test = recettes_random(data);
//console.log(test);
//console.log(data);





window.onload = function() { // fait le tableau de la semaine

    let indice = 0;
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
                if (indice < data.length) {
                    jour = document.createTextNode(data[indice].titre);
                    indice++;
                } else {
                    jour = document.createTextNode('repa');
                }
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

