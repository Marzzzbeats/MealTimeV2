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

function afficheInfos(user){
    const div_infos = document.querySelector('#infos');
    //nom
    const div_nom = document.createElement('div');
    const nom = user.nom;
    const prenom = user.prenom;
    const modif_btn = document.createElement('button');
    modif_btn.classList.add('btn');
    modif_btn.classList.add('createBtn');
    modif_btn.setAttribute('id', 'modif_nom');
    const text_btn_nom = document.createTextNode('Modifier');
    modif_btn.appendChild(text_btn_nom);
    const text_nom = document.createTextNode(`${prenom} ${nom}`);
    div_nom.appendChild(text_nom);
    div_nom.appendChild(modif_btn);
    div_infos.appendChild(div_nom);
    //email
    const div_email = document.createElement('div');
    const email = user.email;
    const modif_btn_mail = document.createElement('button');
    modif_btn_mail.classList.add('btn');
    modif_btn_mail.classList.add('createBtn');
    modif_btn_mail.setAttribute('id', 'modif_mail');
    const text_btn_email = document.createTextNode('Modifier');
    modif_btn_mail.appendChild(text_btn_email);
    const text_mail = document.createTextNode(`Email : ${email}`);
    div_email.appendChild(text_mail);
    div_email.appendChild(modif_btn_mail);
    div_infos.appendChild(div_email);
    //Password
    const div_password = document.createElement('div');
    const modif_btn_password = document.createElement('button');
    modif_btn_password.classList.add('btn');
    modif_btn_password.classList.add('createBtn');
    modif_btn_password.setAttribute('id', 'modif_password');
    const text_btn_password = document.createTextNode('Modifier');
    modif_btn_password.appendChild(text_btn_password);
    const text_password = document.createTextNode(`Mot de passe : ********`);
    div_password.appendChild(text_password);
    div_password.appendChild(modif_btn_password);
    div_infos.appendChild(div_password);
    //Photo de profil
    const div_pp = document.createElement('div');
    const div_div_pp = document.createElement('div');
    const text_pp = document.createTextNode('Photo de profil : ');
    div_div_pp.appendChild(text_pp);
    const pp = document.createElement('img');
    pp.setAttribute('src', `https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=${user.id}`);
    pp.classList.add('pp_img');
    div_div_pp.appendChild(pp);
    div_pp.appendChild(div_div_pp);
    const modif_btn_pp = document.createElement('button');
    modif_btn_pp.classList.add('btn');
    modif_btn_pp.classList.add('createBtn');
    modif_btn_pp.setAttribute('id', 'modif_pp');
    const text_btn_pp = document.createTextNode('Modifier');
    modif_btn_pp.appendChild(text_btn_pp);
    div_pp.appendChild(modif_btn_pp);
    div_infos.appendChild(div_pp);
}

// async function afficheAbonnements(user){
//     const response2 = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abonnements.php?id=${user.id}&action=abonnements`);
//     const abonnements_abo = await response2.json();
//     const div_popup_abonnements = document.createElement('div');

// }

document.addEventListener('DOMContentLoaded', async()=>{
    const user = await init();
    await afficheHead(user);
    afficheInfos(user);
})