
function registerFormHtml(){
    //Crée le html du formulaire d'inscription
    const div_form = document.querySelector('#register_form');
    const form = document.createElement('form');
    const titre = document.createElement('h2');
    const text = document.createTextNode("Formulaire d'inscription");
    titre.appendChild(text);
    form.appendChild(titre);
    form.setAttribute('action', 'register.php');
    form.setAttribute('method', 'POST');
    form.setAttribute('enctype', 'multipart/form-data');
    form.classList.add('rcp_form');
    //Nom
    const total_nom = document.createElement('div');
    const text_nom = document.createTextNode('Nom* : ');
    const nom = document.createElement('input');
    nom.setAttribute('type', 'text');
    nom.setAttribute('required', 'required');
    nom.setAttribute('name', 'nom');
    nom.setAttribute('id', 'nom');
    total_nom.appendChild(text_nom);
    total_nom.appendChild(nom);
    form.appendChild(total_nom);
    //Prenom
    const total_prenom = document.createElement('div');
    const text_prenom = document.createTextNode('Prénom* : ');
    const prenom = document.createElement('input');
    prenom.setAttribute('type', 'text');
    prenom.setAttribute('required', 'required');
    prenom.setAttribute('name', 'prenom');
    prenom.setAttribute('id', 'prenom');
    total_prenom.appendChild(text_prenom);
    total_prenom.appendChild(prenom);
    form.appendChild(total_prenom);
    //Email
    const total_email = document.createElement('div');
    const text_email = document.createTextNode('Email* : ');
    const email = document.createElement('input');
    email.setAttribute('type', 'email');
    email.setAttribute('required', 'required');
    email.setAttribute('placeholder', 'example@blablamail.com');
    email.setAttribute('name', 'email');
    email.setAttribute('id', 'email');
    total_email.appendChild(text_email);
    total_email.appendChild(email);
    form.appendChild(total_email);
    //Photo de profil
    const total_profile_pic = document.createElement('div');
    const text_profile_pic = document.createTextNode('Photo de profil : ');
    const profile_pic = document.createElement('input');
    profile_pic.setAttribute('type', 'file');
    profile_pic.setAttribute('name', 'profile_pic');
    profile_pic.setAttribute('id', 'profile_pic');
    total_profile_pic.appendChild(text_profile_pic);
    total_profile_pic.appendChild(profile_pic);
    form.appendChild(total_profile_pic);
    //Password
    const total_pword1 = document.createElement('div');
    const text_pword1 = document.createTextNode('Mot de passe* : ');
    const pword1 = document.createElement('input');
    pword1.setAttribute('type', 'password');
    pword1.setAttribute('name', 'password1');
    pword1.setAttribute('required', 'required');
    pword1.setAttribute('id', 'password1');
    total_pword1.appendChild(text_pword1);
    total_pword1.appendChild(pword1);
    form.appendChild(total_pword1);
    //Password confirmation
    const total_pword2 = document.createElement('div');
    const text_pword2 = document.createTextNode('Confirmation du mot de passe* : ');
    const pword2 = document.createElement('input');
    pword2.setAttribute('type', 'password');
    pword2.setAttribute('name', 'password2');
    pword2.setAttribute('required', 'required');
    pword2.setAttribute('id', 'password1');
    total_pword2.appendChild(text_pword2);
    total_pword2.appendChild(pword2);
    form.appendChild(total_pword2);
    //CGU
    const total_cgu = document.createElement('div');
    const text_cgu = document.createTextNode('Accepter les ');
    const lien_cgu = document.createElement('a');
    lien_cgu.setAttribute('href', './cgu.html');
    lien_cgu.setAttribute('target', '_blank');
    const text_cgu2 = document.createTextNode("conditions générales d'utilisation");
    lien_cgu.appendChild(text_cgu2)
    const cgu = document.createElement('input');
    cgu.setAttribute('type', 'checkbox');
    cgu.setAttribute('name', 'cgu');
    cgu.setAttribute('required', 'required');
    cgu.setAttribute('id', 'cgu');
    total_cgu.appendChild(text_cgu);
    total_cgu.appendChild(lien_cgu);
    const text2 = document.createTextNode("*");
    total_cgu.appendChild(lien_cgu);
    total_cgu.appendChild(text2);
    total_cgu.appendChild(cgu);
    form.appendChild(total_cgu); 
    //Action
    const action = document.createElement('input');
    action.setAttribute('type', 'hidden');
    action.setAttribute('name', 'action');
    action.setAttribute('id', 'action');
    action.setAttribute('value', 'login');
    form.appendChild(action);
    //Bouton de submit
    const submit_btn = document.createElement('button');
    submit_btn.setAttribute('type', 'submit');
    submit_btn.classList.add('btn');
    submit_btn.classList.add('createBtn');
    const text3 = document.createTextNode("S'inscrire");
    submit_btn.appendChild(text3);
    form.appendChild(submit_btn);
    div_form.appendChild(form);
    let div_link = document.createElement('div');
    let text4 = document.createTextNode('Déjà membre ?');
    let lien = document.createElement('a');
    lien.setAttribute('href', './login.php');
    let a_text = document.createTextNode('Se connecter');
    lien.appendChild(a_text);
    div_link.appendChild(text4);
    div_link.appendChild(lien);
    div_form.appendChild(div_link);
}

window.onload = registerFormHtml();
