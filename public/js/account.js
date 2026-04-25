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
    div_pp.appendChild(pp);
    //Nom
    const text_nom = document.createElement('h3');
    const text_text_nom = document.createTextNode(`${user_name} ${user_lastname}`);
    text_nom.appendChild(text_text_nom);
    div_pp.appendChild(text_nom);
    //Abonnements
    const div_abonnements = document.createElement('div');
                const text = document.createTextNode('Abonnés : ');
                const result = await fetch(`https://l1.dptinfo-usmb.fr/~grp9/api/sub/get_abo.php?id=${owner}&action=nbAbo`);
                nb_abonnements = await result.json();
                const text2 = document.createTextNode(`${nb_abo.nb_abo}`);
                console.log(nb_abo.nb_abo);
                div_abo.appendChild(text);
                div_abonnements.appendChild(text2);
                div_pp.appendChild(div_abo);
    

}

// async function afficheInfos(user){

// }