function createLoginForm(){
    //Crée le html du formulaire
    const div_form = document.querySelector('#login_form');
    const form = document.createElement('form');
    form.setAttribute('action', 'login.php');
    form.setAttribute('method', 'POST');
    const total_email = document.createElement('div');
    const text_email = document.createTextNode('Email : ');
    const email = document.createElement('input');
    email.setAttribute('type', 'email');
    email.setAttribute('required', 'required');
    email.setAttribute('placeholder', 'example@blablamail.com');
    email.setAttribute('name', 'email');
    email.setAttribute('id', 'email');
    total_email.appendChild(text_email);
    total_email.appendChild(email);
    const total_pword = document.createElement('div');
    const text_pword = document.createTextNode('Mot de passe : ');
    const pword = document.createElement('input');
    pword.setAttribute('type', 'password');
    pword.setAttribute('name', 'password');
    pword.setAttribute('id', 'password');
    pword.setAttribute('required', 'required');
    total_pword.appendChild(text_pword);
    total_pword.appendChild(pword);
    form.appendChild(total_email);
    form.appendChild(total_pword);
    const submit = document.createElement('button');
    submit.setAttribute('type', 'submit');
    const text_btn = document.createTextNode('Se connecter');
    submit.appendChild(text_btn);
    form.appendChild(submit);
    div_form.appendChild(form);
}

window.onload = createLoginForm;