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
        const response1 = await fetch(`../api/api_recettes.php?action=fav&user_id=${user_id}`);
        const fav = await response1.json();
        res[0] = fav;
    }catch(err){
        console.error(err.message);
    }

    //Récup des recettes crées

    try{
        const response2 = await fetch(`../api/api_recettes.php?action=created&user_id=${user_id}`);
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
    fav.forEach(recette => {
        let div = document.createElement('div');
        div.classList.add('recette');
        //Icone de favoris
        let div_favo = document.createElement('div');
        div_favo.classList.add('close_div');
        let fav_icon = document.createElement('img');
        fav_icon.setAttribute('href', './img/favoris.png');
        div_favo.appendChild(fav_icon);
        div.appendChild(div_favo);
        //Image
        let div_img = document.createElement('div');
        let img = document.createElement('img');
        let recette_id = recette.id;
        img.setAttribute('src', `../api/api_image_recette.php?id=${recette_id}`);
        img.setAttribute('alt', `image_recette_${recette_id}`);
        div_img.appendChild(img);
        div.appendChild(div_img);
        //Titre
        let div_titre = document.createElement('div');
        let texte_titre = recette.titre;
        let titre_titre = document.createTextNode('Titre : ')
        let titre = document.createTextNode(texte_titre);
        div_titre.appendChild(titre_titre);
        div_titre.appendChild(titre);
        div.appendChild(div_titre);
        //Description
        let div_description = document.createElement('div');
        let desc_desc = document.createTextNode('Description : ');
        let desc = recette.description;
        let text_desc = document.createTextNode(desc);
        div_description.appendChild(desc_desc);
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
        let ind_p = recette.price_ind;
        let str_indp = `Indice de prix : ${ind_p}`;
        let text_indp = document.createTextNode(str_indp);
        div.appendChild(text_indp);
        //Indice de santé
        let ind_h = recette.health_ind;
        let str_indh = `Indice de santé : ${ind_h}`;
        let text_indh = document.createTextNode(str_indh);
        div.appendChild(text_indh);
        div_fav.appendChild(div);
    })
} 


const form = document.querySelector(".popup_form");
const btn = document.querySelector("#create");
const close = document.querySelector("#close");
const screen = document.querySelector(".screen");
btn.addEventListener('click', ()=>{
    form.classList.remove('hidden');
    screen.classList.remove('hidden');
})

close.addEventListener('click', ()=>{
    form.classList.add('hidden');
    screen.classList.add('hidden');
})


document.addEventListener('DOMContentLoaded', async ()=>{
    let user_data = await init();
    afficheRecettes(user_data)
});