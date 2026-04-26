let ALL_TICKETS = []

async function init(){
    try{
        const res = await fetch('../lib/auth_check.php');
        if(res.ok){
            let data = await res.json();
            const user = data.user;
            if(!data.active && user.role !== "admin"){
                window.location.href='./login.php?status=forbidden';
            }
            return user;
        }else{
            window.location.href='./login.php?status=forbidden';
        }
    }catch(err){
        console.error(err.message);
    }
}

async function closeTicket(ticketId) {
    try {
        const res = await fetch('../api/tickets/closeTicket.php', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: ticketId })
        })

        const data = await res.json()
        console.log("Ticket fermé :", data)

    } catch (err) {
        console.error("Erreur fermeture ticket :", err)
    }
}

async function loadTickets() {
    try {
        const response = await fetch('../api/tickets/getTicket.php');
        const data = await response.json();
        return data;
    } catch (err) {
        console.error("Erreur :", err);
    }
}

async function getUserName(user_id) {
    try {
        const response = await fetch(`../api/notifs/userName.php?user_id=${user_id}`);
        const data = await response.text();
        return data;
    } catch (err) {
        console.error("Erreur :", err);
    }
}

function filterByCategory(category) {
    if (category === "all") {
        renderTickets(ALL_TICKETS)
        return
    }

    const filtered = ALL_TICKETS.filter(ticket => 
        ticket.category === category
    )

    renderTickets(filtered)
}

async function createTicketsList(){
    const tickets = await loadTickets()

    ALL_TICKETS = tickets
    generateCategoryFilters();
    await renderTickets(ALL_TICKETS)
}

async function renderTickets(tickets) {
    const tickets_ul = document.getElementById("tickets_ul")
    tickets_ul.innerHTML = ""

    if (!tickets || !Array.isArray(tickets)) return

    for (const ticket of tickets) {
        const tck = await createTicket(ticket);
        tickets_ul.appendChild(tck)
    }
}

function generateCategoryFilters() {
    const categories = ["bug", "signalement", "autre"];

    const select = document.getElementById("filter_category")
    select.innerHTML = '<option value="all">Tous</option>'

    categories.forEach(cat => {
        const option = document.createElement("option")
        option.value = cat
        option.textContent = cat
        select.appendChild(option)
    })
}

async function createTicket(ticket){
    const ticket_li = document.createElement("li");
    ticket_li.classList.add("ticket_li");

    const ticket_header = document.createElement("div");
    ticket_header.classList.add("ticket_header");

    ticket_header.addEventListener("click", () => {
        ticket_li.classList.toggle("open");
    });

    const headerElements = createticketHead(ticket);
    headerElements.forEach(elm => ticket_header.appendChild(elm));

    const ticket_expand = document.createElement("div");
    ticket_expand.classList.add("ticket_expand");

    const expandElements = await createTicketView(ticket, ticket_li);
    expandElements.forEach(elm => ticket_expand.appendChild(elm));

    ticket_li.appendChild(ticket_header);
    ticket_li.appendChild(ticket_expand);

    return ticket_li;
}

function createticketHead(ticket){
    const ticket_title = document.createElement("h4");
    ticket_title.textContent = ticket.titre;

    const date = document.createElement("p");
    date.textContent = ticket.date;

    const category = document.createElement("p");
    category.textContent = ticket.category;

    const expand_btn = document.createElement("img");
    expand_btn.src = "./svgs/down.svg";

    const img_container = document.createElement("div");
    img_container.appendChild(expand_btn);

    return [ticket_title, category, date, img_container];
}

async function createTicketView(ticket, ticket_li){
    const ticket_div = document.createElement("div");
    const ticket_actions = document.createElement("div");

    const message = document.createElement("p");
    message.textContent = ticket.message;

    const user_info = document.createElement("div");

    const username = document.createElement("p")
    const category = document.createElement("p")

    const usr = await getUserName(ticket.user_id);
    username.textContent = usr;

    category.textContent = ticket.category;

    user_info.appendChild(username);
    user_info.appendChild(category);

    const close_btn = document.createElement("p");
    close_btn.textContent = "Fermer le ticket";
    close_btn.classList.add("ticket_close_btn")

    let isClosing = false;

    close_btn.addEventListener("click", async (e) => {
        e.stopPropagation()

        if (isClosing) return
        isClosing = true

        const confirmClose = confirm("t sur ?")
        if (!confirmClose) return

        await closeTicket(ticket.id)

        ticket_li.style.transition = "0.3s"
        ticket_li.style.opacity = "0"
        setTimeout(() => ticket_li.remove(), 300)
    })

    ticket_div.appendChild(message)
    ticket_div.appendChild(user_info)
    ticket_actions.appendChild(close_btn);

    return [ticket_div, ticket_actions];
}

document.addEventListener("DOMContentLoaded", async () => {
    const user = await init();
    console.log(user);

    await createTicketsList();

    document.getElementById("filter_category")
        .addEventListener("change", (e) => {
            filterByCategory(e.target.value)
        })
})