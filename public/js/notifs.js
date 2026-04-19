



async function loadNotifs() {
    try {
        const response = await fetch('/~perivolas/mealtime/api/notifs/notifs.php');
        const data = await response.json();

        console.log(data);
        return data;
        
    } catch (err) {
        console.error("Erreur :", err);
    }
}

async function getUserName(user_id) {
    try {
        const response = await fetch(`/~perivolas/mealtime/api/notifs/userName.php?user_id=${user_id}`);
        const data = await response.text();
    
        console.log(data);
        return data;
        
    } catch (err) {
        console.error("Erreur :", err);
    }
}

async function markAsRead(id) {
    try {
        await fetch('/~perivolas/mealtime/api/notifs/markAsRead.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        });
        
        console.log("notif lue");
        
    } catch (err) {
        console.error(err);
    }
}

function myTextNode(text, classes=[], id=null){
    const p = document.createElement("p");
    p.textContent = text;
    classes.forEach(classe => {
        p.classList.add(classe);
    });
    if(id){
        p.id = id;
    }
    return p
}

function update_notif_size(){
    const container = document.getElementById("notifs_display_div");
    let notifAmount = document.querySelectorAll(".notif_div").length;
    let topValue = 11;
    if (notifAmount >= 4){
        topValue += 4*11;
    }else if(notifAmount == 0){
        topValue = 16;
    }else{
        topValue += notifAmount*11;
    }
    container.style.top = `-${topValue}vh`;

}


function actionsNotifsManager(type, id_notif, num_notif){
    let ok_btn = myTextNode("OK", ["markAsReadBtn"]);
    ok_btn.dataset.id = id_notif;
    ok_btn.dataset.num = num_notif;
    
    ok_btn.addEventListener("click", (event) => {
        
        event.stopPropagation();
        
        const id = id_notif;
        const num = num_notif;
        
        const notif = document.getElementById(num);
        notif.classList.add("removing");
                
        setTimeout(() => {
            notif.classList.add("collapsing");
        }, 300);
        
        setTimeout(async () => {
            try {
                await markAsRead(id);
            } catch (err) {
                console.error(err);
            }
            notif.remove();
            update_notif_size();
        }, 300);
    });

    let actions = [ok_btn];
    if (type == "newFollower"){
        // actions.push(myTextNode("Accepter", ["acceptFollow"]));
    }else if (type == "newRecipe"){
        actions.push(myTextNode("Voir", ["checkNewRecipe"]));
    }else if (type == "deletedRecipe"){
        
    }else if (type == "followAccepted"){
        

    }
    return actions;
}

async function createNotif(notif, num){
    const notif_div = document.createElement("div");
    notif_div.classList.add("notif_div");
    notif_div.id = num;
    
    const metadata_div = document.createElement("div");
    const actions_div = document.createElement("div");
    metadata_div.classList.add("metadata_div");
    actions_div.classList.add("actions_div");
    
    const users_div = document.createElement("div");
    const message_div = document.createElement("div");
    users_div.classList.add("users_div");
    message_div.classList.add("message_div");
    
    const from_div = document.createElement("div");
    const to_div = document.createElement("div");
    from_div.classList.add("from_div");
    to_div.classList.add("to_div");
    
    const notif_de = await getUserName(notif.de)
    const notif_a = await getUserName(notif.a)
    from_div.appendChild(myTextNode(notif_de));
    to_div.appendChild(myTextNode(notif_a));
    message_div.appendChild(myTextNode(notif.message));

    actionsNotifsManager(notif.type, notif.id, num).forEach(action => {
        actions_div.appendChild(action);
    });

    users_div.appendChild(from_div);
    users_div.appendChild(to_div);

    metadata_div.appendChild(users_div);
    metadata_div.appendChild(message_div);

    notif_div.appendChild(metadata_div);
    notif_div.appendChild(actions_div);

    return notif_div;
}

 async function createNotifs(){
    const data = await loadNotifs();

    const container = document.getElementById("notifs_display_div");
    
    for(let i=0; i<data.length; i++){
        const notifElement = await createNotif(data[i], i);
        container.appendChild(notifElement);
    }

    update_notif_size();
}




document.addEventListener("DOMContentLoaded", () => {
    createNotifs();
    
    const notifsDiv = document.getElementById("notifs_div");
    const notifsDislpayDiv = document.getElementById("notifs_display_div");
    
    notifsDislpayDiv.addEventListener("click", (event) => {
        event.stopPropagation();
    });
    notifsDiv.addEventListener("click", (event) => {
        event.stopPropagation();
        notifsDislpayDiv.classList.toggle("hidden");
    });
    document.addEventListener("click", () => {
        notifsDislpayDiv.classList.add("hidden");
    });

    getUserName(2);
    

});