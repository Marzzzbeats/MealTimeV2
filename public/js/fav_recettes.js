async function init(){
    try{
        const res = await fetch('../lib/auth_check.php');
        if(res.ok){
            let data = await res.json();
            const user = data.user;
            if(!data.connected){
                window.location.href='./login.php?status=disconnected';
            }
        }
    }catch(err){
        console.error(err.message);
    }
    return user;
}

async function getRecettes(user){
    const user_id = user.user_id;
    let res = array();
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

// async function afficheRecettes(user){
//     const div_fav = document.querySelector('#fav');
//     const div_created = document.querySelector('#created');
//     div_fav.classList.add("recette_conteneur");
//     const res = await getRecettes(user);
//     const fav = res[0];
//     const created = res[1];
//     fav.forEach(recette => {
//         let div = document.createElement('div');
//         div.classList.add('recette');
//         let img = document.createElement('img');
//         if(recette.image != null){
//             img.setAttribute('src', '');
//         }
//     })
// }
//A finir plus tard 

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

window.onload = init();
