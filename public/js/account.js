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
    abonnements_btn.id = 'btn_abonnements';
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
    abonnes_btn.id = 'btn_abonnes';
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
    modif_btn.id = 'modif_nom_btn';
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
    modif_btn_mail.id = 'modif_email_btn';
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
    modif_btn_password.id = 'modif_password_btn';
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
    modif_btn_pp.id = 'modif_pp_btn';
    const text_btn_pp = document.createTextNode('Modifier');
    modif_btn_pp.appendChild(text_btn_pp);
    div_pp.appendChild(modif_btn_pp);
    div_infos.appendChild(div_pp);
}

async function afficheAbonnements(user){
    const abonnements_dom = document.querySelector('#abonnements');
    const response2 = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abonnements.php?id=${user.id}&action=abonnements`);
    const abonnements_abo = await response2.json();
    const div_popup_abonnements = document.createElement('div');
    div_popup_abonnements.id = 'div_abonnements';
    div_popup_abonnements.classList.add('popup_form');
    abonnements_abo.forEach((abonnement)=>{
        let div_affichage_abonnement = document.createElement('div');
        div_affichage_abonnement.classList.add('line_abo');
        let id_abo = abonnement.id;
        //Photo de profil
        let pp = document.createElement('img');
        pp.classList.add('pp_abo');
        pp.setAttribute('src', `https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=${id_abo}`);
        //texte
        let nom = abonnement.nom;
        prenom = abonnement.prenom;
        let texte_abonnement = document.createTextNode(`${prenom} ${nom}`);
        div_affichage_abonnement.appendChild(texte_abonnement);
        div_affichage_abonnement.appendChild(pp);
        div_popup_abonnements.appendChild(div_affichage_abonnement);
    })
    abonnements_dom.appendChild(div_popup_abonnements);
}

async function afficheAbonnes(user){
    const abonnes_dom = document.querySelector('#abonnes');
    const response2 = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abo.php?id=${user.id}&action=abonnes`);
    const abonnes_abo = await response2.json();
    const div_popup_abonnes = document.createElement('div');
    div_popup_abonnes.id = 'div_abonnes';
    div_popup_abonnes.classList.add('popup_form');
    abonnes_abo.forEach((abo)=>{
        let div_affichage_abonne = document.createElement('div');
        div_affichage_abonne.classList.add('line_abo');
        let id_abo = abo.id;
        //Photo de profil
        let pp = document.createElement('img');
        pp.classList.add('pp_abo');
        pp.setAttribute('src', `https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=${id_abo}`);
        //texte
        let nom = abo.nom;
        prenom = abo.prenom;
        let texte_abonne = document.createTextNode(`${prenom} ${nom}`);
        div_affichage_abonne.appendChild(texte_abonne);
        div_affichage_abonne.appendChild(pp);
        div_popup_abonnes.appendChild(div_affichage_abonne);
    })
    abonnes_dom.appendChild(div_popup_abonnes);
}

document.addEventListener('DOMContentLoaded', async()=>{
    const user = await init();
    await afficheHead(user);
    afficheInfos(user);
    await afficheAbonnements(user);
    await afficheAbonnes(user);

    const abonnements_btn = document.querySelector("#btn_abonnements");
    const abonnes_btn = document.querySelector("#btn_abonnes");
    const abonnements_dom = document.querySelector('#abonnements');
    const abonnes_dom = document.querySelector('#abonnes');
    const allscreens = document.querySelectorAll(".screen");
    const div_abonnements = document.querySelector('#div_abonnements');
    const div_abonnes = document.querySelector('#div_abonnes');
    
    const modif_nom = document.querySelector('#modif_nom');
    const modif_email = document.querySelector('#modif_email');
    const modif_password = document.querySelector('#modif_password');
    const modif_pp = document.querySelector('#modif_pp');

    const modif_nom_btn = document.querySelector('#modif_nom_btn');
    const modif_email_btn = document.querySelector('#modif_email_btn');
    const modif_password_btn = document.querySelector('#modif_password_btn');
    const modif_pp_btn = document.querySelector('#modif_pp_btn');

    const forms = document.querySelectorAll('form');

    abonnements_btn.addEventListener('click', ()=>{
        abonnements_dom.classList.remove('hidden');
    })

    abonnes_btn.addEventListener('click', ()=>{
        abonnes_dom.classList.remove('hidden');
    })

    allscreens.forEach((screen) =>{
        screen.addEventListener('click', ()=>{
            abonnes_dom.classList.add('hidden');
            abonnements_dom.classList.add('hidden');
            modif_nom.classList.add('hidden');
            modif_email.classList.add('hidden');
            modif_password.classList.add('hidden');
            modif_pp.classList.add('hidden');
        })
    })

    modif_nom_btn.addEventListener('click', ()=>{
        modif_nom.classList.remove('hidden');
    })

    modif_email_btn.addEventListener('click', ()=>{
        modif_email.classList.remove('hidden');
    })

    modif_password_btn.addEventListener('click', ()=>{
        modif_password.classList.remove('hidden');
    })

    modif_pp_btn.addEventListener('click', ()=>{
        modif_pp.classList.remove('hidden');
    })

    div_abonnements.addEventListener('click', (e)=>{
        e.stopPropagation();
    })

    div_abonnes.addEventListener('click', (e)=>{
        e.stopPropagation();
    })

    forms.forEach((form)=>{
        form.addEventListener('click', (e)=>{
           e.stopPropagation(); 
        })
    })
})