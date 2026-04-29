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
    const user_id = user.id;
    console.log(user_id);
    let res = [];
    //Récup des recettes favorites
    try{
        const response1 = await fetch(`../api/recettes/api_recettes.php?action=fav&user_id=${user_id}`);
        const fav = await response1.json();
        res[0] = fav;
    }catch(err){
        console.error(err.message);
    }

    //Récup des recettes crées

    try{
        const response2 = await fetch(`../api/recettes/api_recettes.php?action=created&user_id=${user_id}`);
        const created  = await response2.json();
        res[1] = created;
    }catch(err2){
        console.error(err2.message);
    }

    return res;
}

async function afficheRecettes(user){
    const div_fav = document.querySelector('#fav');
    const div_created = document.querySelector('#created');
    div_fav.classList.add("fl-row-recette");
    const res = await getRecettes(user);
    const fav = res[0];
    const created = res[1];
    console.log(created);
    fav.forEach(recette => {
        let div = document.createElement('div');
        div.classList.add('carte');
        //Icone de favoris
        let div_favo = document.createElement('div');
        div_favo.classList.add('close_div');
        let a_fav = document.createElement('a');
        a_fav.setAttribute('href', `../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette.id_recette}&action=remFav`);
        let fav_icon = document.createElement('img');
        fav_icon.setAttribute('src', './img/favoris.png');
        fav_icon.setAttribute('id', 'favImg');
        a_fav.appendChild(fav_icon);
        div_favo.appendChild(a_fav);
        div.appendChild(div_favo);
        //Image
        let div_img = document.createElement('div');
        let img = document.createElement('img');
        let recette_id = recette.id_recette;
        console.log(recette_id);
        img.setAttribute('src', `../api/recettes/api_image_recette.php?id=${recette_id}`);
        img.setAttribute('alt', `image_recette_${recette_id}`);
        div_img.appendChild(img);
        div.appendChild(div_img);
        //Titre
        let div_titre = document.createElement('div');
        let texte_titre = recette.titre;
        let titre = document.createTextNode(texte_titre);
        div_titre.appendChild(titre);
        div.appendChild(div_titre);
        //Description
        let div_description = document.createElement('div');
        let desc = recette.description;
        let text_desc = document.createTextNode(desc);
        div_description.appendChild(text_desc);
        div.appendChild(div_description);
        //ingredients
        let div_ingredients = document.createElement('div');
        let ingredients = recette.ing;
        let ul_ing = document.createElement('ul');
        ingredients.forEach((ingredient)=>{
            let name = ingredient.nom;
            let qte = ingredient.quantite;
            let str = `${name} : ${qte}`;
            let li = document.createElement('li');
            let str_ing = document.createTextNode(str);
            li.appendChild(str_ing);
            ul_ing.appendChild(li);
        })
        let text_ing = document.createTextNode('Ingrédients : ');
        div_ingredients.appendChild(text_ing);
        div_ingredients.appendChild(ul_ing);
        div.appendChild(div_ingredients);
        //Indice de prix
        let div_indp = document.createElement('div')
        div_indp.classList.add("badge", "price");
        let ind_p = recette.price_ind;
        let str_indp = `Indice de prix : ${ind_p}`;
        let text_indp = document.createTextNode(str_indp);
        div_indp.appendChild(text_indp);
        div.appendChild(div_indp);
        //Indice de santé
        let div_indh = document.createElement('div');
        div_indh.classList.add("badge", "health");
        let ind_h = recette.health_ind;
        let str_indh = `Indice de santé : ${ind_h}`;
        let text_indh = document.createTextNode(str_indh);
        div_indh.appendChild(text_indh);
        div.appendChild(div_indh);
        //Boutons
        if(user.id == recette.owner){
            let div_btn = document.createElement('div');
            div_btn.classList.add('fl-row');
            let delete_btn = document.createElement('button');
            delete_btn.classList.add('btn');
            delete_btn.classList.add('delBtn');
            let a_delete = document.createElement('a');
            let text_del = document.createTextNode('Supprimer la recette');
            a_delete.setAttribute('href', `../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette_id}&action=delete`);
            delete_btn.appendChild(text_del);
            a_delete.appendChild(delete_btn);
            div_btn.appendChild(a_delete)
            let modif_btn = document.createElement('button');
            modif_btn.classList.add('btn');
            modif_btn.classList.add('createBtn');
            let a_modif = document.createElement('a');
            let text_modif = document.createTextNode('Modifier la recette');
            a_modif.setAttribute('href', `./recettes.php?id=${recette_id}&action=modif`);
            modif_btn.appendChild(text_modif);
            a_modif.appendChild(modif_btn);
            div_btn.appendChild(a_modif)
            div.appendChild(div_btn);
        }
        div_fav.appendChild(div);
    })
    created.forEach( async (recette) => {
        let div = document.createElement('div');
        div.classList.add('carte');
        //Icone de favoris
        let div_favo = document.createElement('div');
        div_favo.classList.add('close_div');
        let a_fav = document.createElement('a');
        let response = await fetch(`../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette.id_recette}&action=isFav`);
        let isFav = await response.json();
        let fav = isFav.fav;
        console.log(fav);
        let fav_icon = document.createElement('img');
        if(fav == true){
            a_fav.setAttribute('href', `../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette.id_recette}&action=remFav`);
            fav_icon.setAttribute('src', './img/favoris.png');
            fav_icon.setAttribute('id', 'favImg');
        }else{
            a_fav.setAttribute('href', `../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette.id_recette}&action=addFav`);
            fav_icon.setAttribute('src', './img/non_favoris.png');
            fav_icon.setAttribute('id', 'favImg');
        }
        a_fav.appendChild(fav_icon);
        div_favo.appendChild(a_fav);
        div.appendChild(div_favo);
        //Image
        let div_img = document.createElement('div');
        let img = document.createElement('img');
        let recette_id = recette.id_recette;
        console.log(recette_id);
        img.setAttribute('src', `../api/recettes/api_image_recette.php?id=${recette_id}`);
        img.setAttribute('alt', `image_recette_${recette_id}`);
        div_img.appendChild(img);
        div.appendChild(div_img);
        //Titre
        let div_titre = document.createElement('div');
        let texte_titre = recette.titre;
        let titre = document.createTextNode(texte_titre);
        div_titre.appendChild(titre);
        div.appendChild(div_titre);
        //Description
        let div_description = document.createElement('div');
        let desc = recette.description;
        let text_desc = document.createTextNode(desc);
        div_description.appendChild(text_desc);
        div.appendChild(div_description);
        //ingredients
        let div_ingredients = document.createElement('div');
        let ingredients = recette.ing;
        let ul_ing = document.createElement('ul');
        ingredients.forEach((ingredient)=>{
            let name = ingredient.nom;
            let qte = ingredient.quantite;
            let str = `${name} : ${qte}`;
            let li = document.createElement('li');
            let str_ing = document.createTextNode(str);
            li.appendChild(str_ing);
            ul_ing.appendChild(li);
        })
        let text_ing = document.createTextNode('Ingrédients : ');
        div_ingredients.appendChild(text_ing);
        div_ingredients.appendChild(ul_ing);
        div.appendChild(div_ingredients);
        //Indice de prix
        let div_indp = document.createElement('div');
        div_indp.classList.add("badge", "price");
        let ind_p = recette.price_ind;
        let str_indp = `Indice de prix : ${ind_p}`;
        let text_indp = document.createTextNode(str_indp);
        div_indp.appendChild(text_indp);
        div.appendChild(div_indp);
        //Indice de santé
        let div_indh = document.createElement('div');
        div_indh.classList.add("badge", "health");
        let ind_h = recette.health_ind;
        let str_indh = `Indice de santé : ${ind_h}`;
        let text_indh = document.createTextNode(str_indh);
        div_indh.appendChild(text_indh);
        div.appendChild(div_indh);
        //Bouton supprimer
        if(user.id == recette.owner){
            let div_btn = document.createElement('div');
            div_btn.classList.add('fl-row');
            let delete_btn = document.createElement('button');
            delete_btn.classList.add('btn');
            delete_btn.classList.add('delBtn');
            let a_delete = document.createElement('a');
            let text_del = document.createTextNode('Supprimer la recette');
            a_delete.setAttribute('href', `../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette_id}&action=delete`);
            delete_btn.appendChild(text_del);
            a_delete.appendChild(delete_btn);
            div_btn.appendChild(a_delete)
            let modif_btn = document.createElement('button');
            modif_btn.classList.add('btn');
            modif_btn.classList.add('createBtn');
            let a_modif = document.createElement('a');
            let text_modif = document.createTextNode('Modifier la recette');
            a_modif.setAttribute('href', `./recettes.php?id=${recette_id}&action=modif`);
            modif_btn.appendChild(text_modif);
            a_modif.appendChild(modif_btn);
            div_btn.appendChild(a_modif)
            div.appendChild(div_btn);
        }
        div_created.appendChild(div);
    })
} 

async function sendNotifs(user){
    const response = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abo.php?id=${user.id}&action=abonnes`);
    const abonnes = await response.json();
    abonnes.forEach(async (abo)=>{
        const id_abo = abo.id;
        await fetch('./api/notifs/notifs.php?type=newRecipe', {method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(
                    {from: user.id,
                        to: id_abo}
                    )
                }
            );
    })
}

const forms = document.querySelectorAll(".popup_form");
const btn = document.querySelector("#create");
const screens = document.querySelectorAll(".screen");
const create = document.querySelector('#create');
const screen_created = document.querySelector('#screen_create');

btn.addEventListener('click', ()=>{
    create.classList.remove('hidden');
    screen_created.classList.remove('hidden');
})


screens.forEach((screen) => {
    screen.addEventListener('click', ()=>{
        forms.forEach((form)=>{
            form.classList.add('hidden');
        })
        screen.classList.add('hidden');
    })
})



document.addEventListener('DOMContentLoaded', async ()=>{
    let user_data = await init();
    afficheRecettes(user_data);

    forms.forEach((form)=>{
    form.addEventListener('click', (e)=>{
        e.stopPropagation();
    })

    form.addEventListener("submit", async ()=>{
        
    });
})
})


submit_btn.add