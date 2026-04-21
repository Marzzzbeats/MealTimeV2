let ALL_TICKETS = []

async function init(){
    try{
        const res = await fetch('../lib/auth_check.php');
        if(res.ok){
            let data = await res.json();
            const user = data.user;
            if(!data.active && user.role != 'admin'){
                window.location.href='./login.php?status=forbidden';
            }
            return user;
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

        console.log(data);
        return data;
        
    } catch (err) {
        console.error("Erreur :", err);
    }
}

async function createTicketsList(){
    const tickets = await loadTickets()

    ALL_TICKETS = tickets
    generateCategoryFilters();
    renderTickets(ALL_TICKETS)
}

function renderTickets(tickets) {
    const tickets_ul = document.getElementById("tickets_ul")
    tickets_ul.innerHTML = ""

    if (!tickets || !Array.isArray(tickets)) return
    tickets.forEach(ticket => {
        tickets_ul.appendChild(createTicket(ticket))
    })
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

function generateCategoryFilters() {
    const categories = ["bug", "report", "other"];

    const select = document.getElementById("filter_category")
    select.innerHTML = '<option value="all">Tous</option>'

    categories.forEach(cat => {
        const option = document.createElement("option")
        option.value = cat
        option.textContent = cat
        select.appendChild(option)
    })
}

function createTicket(ticket){
    const ticket_li = document.createElement("li");
    ticket_li.classList.add("ticket_li");

    const ticket_header = document.createElement("div");
    ticket_header.addEventListener("click", () => {
        ticket_li.classList.toggle("open");
    });
    ticket_header.classList.add("ticket_header");
    createticketHead(ticket).forEach(elm => {
        ticket_header.appendChild(elm);
    });
    
    const ticket_expand = document.createElement("div");
    ticket_expand.classList.add("ticket_expand");
    createTicketView(ticket, ticket_li).forEach(elm => {
        ticket_expand.appendChild(elm);
    });


    ticket_li.appendChild(ticket_header);
    ticket_li.appendChild(ticket_expand);

    return ticket_li;
}

function createticketHead(ticket){
    const ticket_title = document.createElement("h4");
    ticket_title.textContent = ticket["titre"];

    const date = document.createElement("p");
    date.textContent = "1212121";

    const category = document.createElement("p");
    category.textContent = ticket["category"];

    const expand_btn = document.createElement("img");
    expand_btn.src = "../svgs/down.svg";
    expand_btn.alt = "arrow down";

    const img_container = document.createElement("div");
    img_container.appendChild(expand_btn);

    return [ticket_title, category, date, img_container];
}

function createTicketView(ticket, ticket_li){
    const ticket_div = document.createElement("div");
    const ticket_actions = document.createElement("div");

    const message = document.createElement("p");
    message.textContent = ticket.message;

    const user_info = document.createElement("div");
    const username = document.createElement("p")
    const category = document.createElement("p")
    username.textContent = ticket["user_id"];
    category.textContent = ticket["category"];

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
    await init();
    createTicketsList();
    // document.getElementById("container").appendChild();
    document.getElementById("filter_category").addEventListener("change", (e) => {
        filterByCategory(e.target.value)
    })

});