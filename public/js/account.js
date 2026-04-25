async function init(){
    try{
        const response = await fetch('https://l1.dptinfo-usmb.fr/~grp9/lib/auth_check.php');
        const data = await  response.json();
        const user = data.user;
        if(!data.active && !data.connected){
            window.location.href = 'https://l1.dptinfo-usmb.fr/~grp9/public/login.php?status=disconnected';
        }else{
            return user;
        }
    }catch(err){
        console.error(err.message);
    }
}

async function afficheHead(user){
    const div_pp = document.querySelector('#div_nom_pp');
    const user_id = user.id;
    const user_name = user.prenom;
    const user_lastname = user.nom;
    //Photo de profil
    const pp = document.createElement('img');
    pp.setAttribute('src', `https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=${user_id}`);
    pp.classList.add('pp');
    div_pp.appendChild(pp);
    //Nom
    const text_nom = document.createElement('h3');
    const text_text_nom = document.createTextNode(`${user_name} ${user_lastname}`);
    text_nom.appendChild(text_text_nom);
    div_pp.appendChild(text_nom);
    //Abonnements
    const abonnements_btn = document.createElement('button');
    abonnements_btn.classList.add('btn');
    const div_abonnements = document.createElement('div');
    const text = document.createTextNode('Abonnements : ');
    const result = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abonnements.php?id=${user_id}&action=nbAbo`);
    const nb_abonnements = await result.json();
    const text2 = document.createTextNode(`${nb_abonnements.nb_abo}`);
    div_abonnements.appendChild(text);
    div_abonnements.appendChild(text2);
    abonnements_btn.appendChild(div_abonnements);
    div_pp.appendChild(abonnements_btn);
    //Abonnés
    const abonnes_btn = document.createElement('button');
    abonnes_btn.classList.add('btn');
    const div_abonnes = document.createElement('div');
    const text_a = document.createTextNode('Abonnés : ');
    const result_a = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abo.php?id=${user_id}&action=nbAbo`);
    const nb_abonnes = await result_a.json();
    const text2_a = document.createTextNode(`${nb_abonnes.nb_abo}`);
    div_abonnes.appendChild(text_a);
    div_abonnes.appendChild(text2_a);
    abonnes_btn.appendChild(div_abonnes);
    div_pp.appendChild(abonnes_btn);
}

async function afficheInfos(user){
    const div_infos = document.querySelector('#infos');
    
}

document.addEventListener('DOMContentLoaded', async()=>{
    const user = await init();
    await afficheHead(user);
})