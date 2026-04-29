const params = new URLSearchParams(window.location.search);
const owner = params.get("owner");
const id_recette = params.get("id_recette");

async function init(owner, id_recette){
    try{
        const res = await fetch('../lib/auth_check.php');
        if(res.ok){
            let data = await res.json();
            if(data.connected == true && data.user != null){
                console.log('ok');
                const user = data.user;
                const div_npp = document.querySelector('#div_nom_pp');
                const data2 = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/user/get_user_info.php?id=${owner}`);
                const account_info = await data2.json();
                const account_prenom= account_info.prenom;
                const account_nom = account_info.nom;
                //Photo de profil
                const pp = document.createElement('img');
                pp.setAttribute('src', `https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=${owner}`);
                pp.classList.add('pp');
                div_npp.appendChild(pp);
                //Nom
                const text_nom = document.createElement('h3');
                const text_text_nom = document.createTextNode(`${account_prenom} ${account_nom}`);
                text_nom.appendChild(text_text_nom);
                div_npp.appendChild(text_nom);
                //Nombre d'abonnés
                const div_abo = document.createElement('div');
                const text = document.createTextNode('Abonnés : ');
                const result = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abo.php?id=${owner}&action=nbAbo`);
                nb_abo = await result.json();
                const text2 = document.createTextNode(`${nb_abo.nb_abo}`);
                console.log(nb_abo.nb_abo);
                div_abo.appendChild(text);
                div_abo.appendChild(text2);
                div_npp.appendChild(div_abo);
                //Bouton abo
                const response1 = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/is_sub.php?id=${user.id}&account_id=${owner}`);
                const is_abo = await response1.json();
                if(is_abo.result){
                    const lien = document.createElement('a');
                    lien.setAttribute('href', `https://l1.dptinfo-usmb.fr/~grp9/api/sub/sub_gestion.php?id=${user.id}&account_id=${owner}&action=delAbo&recette_id=${id_recette}`);
                    const sub_btn = document.createElement('button');
                    sub_btn.classList.add('btn');
                    sub_btn.classList.add('delBtn');
                    sub_btn.id = 'sub_btn';
                    const text_btn = document.createTextNode('Se désabonner');
                    sub_btn.appendChild(text_btn);
                    lien.appendChild(sub_btn)
                    div_npp.appendChild(lien);
                }else{
                    const lien = document.createElement('a');
                    const sub_btn = document.createElement('button');
                    lien.setAttribute('href', `https://l1.dptinfo-usmb.fr/~grp9/api/sub/sub_gestion.php?id=${user.id}&account_id=${owner}&action=addAbo&recette_id=${id_recette}`);
                    sub_btn.classList.add('btn');
                    sub_btn.classList.add('createBtn');
                    const text_btn = document.createTextNode("S'abonner");
                    sub_btn.appendChild(text_btn);
                    lien.appendChild(sub_btn);
                    div_npp.appendChild(lien);
                }
                //Titre des recettes
                const div_user_rec = document.querySelector('#user_recettes');
                const text_rec = document.createElement('h3');
                const text_text = document.createTextNode(`Voici les recettes de ${account_prenom} ${account_nom}`);
                text_rec.appendChild(text_text);
                div_user_rec.appendChild(text_rec);
                await afficheRecettes(user, owner, id_recette);
                return user;
            }else{
                window.location.href='./login.php?status=disconnected';
            }
        }
    }catch(err){
        console.error(err.message);
    }
}

async function getRecettes(owner){
    console.log(owner);

    try{
        const response = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/recettes/api_recettes.php?action=created&user_id=${owner}`);
        const created  = await response.json();
        const res = created;
        return res;
    }catch(err){
        console.error(err.message);
    }
}

async function afficheRecettes(user, owner, id_recette){
    const selected_rcp = document.querySelector('#selected_rcp');
    const div_created = document.querySelector('#created');
    div_created.classList.add("fl-row-recette");
    const created = await getRecettes(owner);
    console.log(created);
    created.forEach( async (recette) => {
        let div = document.createElement('div');
        div.classList.add('carte');
        if(id_recette == recette.id_recette){
            div.classList.add('selected_rcp');
        }
        //Icone de favoris
        let div_favo = document.createElement('div');
        div_favo.classList.add('close_div');
        let a_fav = document.createElement('a');
        let response = await fetch(`../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette.id_recette}&action=isFav&owner=${owner}`);
        let isFav = await response.json();
        let fav = isFav.fav;
        console.log(fav);
        let fav_icon = document.createElement('img');
        if(fav == true){
            a_fav.setAttribute('href', `../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette.id_recette}&action=remFav&owner=${owner}`);
            fav_icon.setAttribute('src', './img/favoris.png');
            fav_icon.setAttribute('id', 'favImg');
        }else{
            a_fav.setAttribute('href', `../api/recettes/fav_actions.php?id_user=${user.id}&id_recette=${recette.id_recette}&action=addFav&owner=${owner}`);
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
        if(user.id == owner){
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
            div.appendChild(div_btn);
        }
        if(id_recette == recette.id_recette){
            const clone = div.cloneNode(true);
            clone.classList.add('selected_rcp');
            clone.id = 'sel';
            selected_rcp.appendChild(clone);
            selected_rcp.classList.remove('hidden');
        }
        div_created.appendChild(div);
    })
} 

document.addEventListener('DOMContentLoaded', async ()=>{
    user = await init(owner, id_recette);
    const selected_rcp = document.querySelector('#selected_rcp');
    const sel = document.querySelector('#sel');
    selected_rcp.addEventListener('click', ()=>{
        selected_rcp.classList.add('hidden');
    })

    if(sel){
        sel.addEventListener('click', (e)=>{
            e.stopPropagation();
        })
    }

    const sub = document.querySelector('#sub_btn');
    sub.addEventListener('click', async ()=>{
        const response1 = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/is_sub.php?id=${user.id}&account_id=${owner}`);
        const is_abo = await response1.json();
        if(!is_abo.result){
            await fetch('./api/notifs/notifs.php?type=followRequest', {method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(
                    {from: user.id,
                        to: owner}
                    )
                }
            );
        }
    })          
})