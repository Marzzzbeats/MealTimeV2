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


async function sendTicket(user_id, category, title, message){
    try {
        const response = await fetch('/home/~grp9/public_html/api/tickets/sendTicket.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ user_id, category, title, message })
        });
        
        const data = await response.json();
        console.log(data);
        
        return data;
        
    } catch (err) {
        console.error(err);
    }
}

async function createTicketForm(user_id){
    const form = document.createElement("form");
    form.classList.add("ticket_form");

    const title_label = document.createElement("label");
    title_label.textContent = "Entrez un titre";
    title_label.htmlFor = "title";
    const title_inp = document.createElement("input");
    title_inp.type = "text";
    title_inp.id = "title"
    
    const select_label = document.createElement("label");
    select_label.textContent = "Selectionez une category";
    select_label.htmlFor = "category";
    const select = document.createElement("select");
    select.id = "category"
    select.name = "category";
    ["bug", "report", "other"].forEach(cat => {
        const option = document.createElement("option");
        option.value = cat;
        option.textContent = cat;
        select.appendChild(option);
    });
    
    const textarea_label = document.createElement("label");
    textarea_label.textContent = "Décrivez votre problème";
    textarea_label.htmlFor = "message";
    const textarea = document.createElement("textarea");
    textarea.id = "message";
    
    const btn = document.createElement("button");
    btn.textContent = "Envoyer";
    
    form.appendChild(title_label);
    form.appendChild(title_inp);
    form.appendChild(select_label);
    form.appendChild(select);
    form.appendChild(textarea_label);
    form.appendChild(textarea);
    form.appendChild(btn);
    container.appendChild(form);
    
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        
        const category = select.value;
        const message = textarea.value;
        const title = title_inp.value;
        
        console.log(category, message, title);
        await sendTicket(user_id, category, title, message);
        
        textarea.value = "";
        title_inp.value = "";
        alert("Ticket envoyé");
    });

    return form;
}


document.addEventListener("DOMContentLoaded", async () => {
    let user = await init();
    let user_id = user.id;
    let form = await createTicketForm(user_id);
    document.getElementById("container").appendChild(form);

});