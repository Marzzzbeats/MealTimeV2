let ALL_RECETTES = [];


async function loadRecettes() {
    try {
        const response = await fetch('./api/recettes/getRecettes.php');
        const data = await response.json();

        //console.log(data);
        return data;
        
    } catch (err) {
        console.error("Erreur :", err);
    }
}

async function getUserName(user_id) {
    try {
        const response = await fetch(`./api/notifs/userName.php?user_id=${user_id}`);
        const data = await response.text();
    
        // console.log(data);
        return data;
        
    } catch (err) {
        console.error("Erreur :", err);
    }
}

async function manage_session() {
    try{
        const res = await fetch('./lib/auth_check.php');
        if(res.ok){
            let data = await res.json();
            const login = document.querySelector('#login');
            const register = document.querySelector('#register');
            const logout = document.querySelector('#logout');
            const user = data.user;
            if(data.connected == true && data.user != null){
                const hello = document.createElement("p");
                hello.textContent = `Bonjour ${data.user.prenom}`;
                hello.id = "userName_p";
                login.classList.add("hidden");
                register.classList.add("hidden");
                logout.classList.remove("hidden");
                document.body.appendChild(hello);
            }
        }
    }catch(err){
        console.error(err.message);
    }
}



function createAllCards(recettes){
    const container = document.getElementById("container");
    
    const top = recettes.slice(0, 20);
    const rest = recettes.slice(20);

    container.appendChild(createTopCards(top));
    container.appendChild(createCards(rest));

    return;
}

function createTopCards(recettes){
    const carousselTopContainer = document.createElement("div");
    carousselTopContainer.classList.add("carousselTopContainer");
    let rec = [recettes.slice(0, 10), recettes.slice(10, 20)];
    for(let i=0; i<2; i++){
        const sens = i % 2 === 0 ? "left" : "right";
        const caroussel = createCaroussel(sens, rec[i]);
        carousselTopContainer.appendChild(caroussel);
    }
    return carousselTopContainer;
}

function createCaroussel(sens,  recettes){
    const carousselTop = document.createElement("div");
    carousselTop.classList.add("carousselTop");
    for(let i=0; i<2; i++){
        const innerCarousselTop = document.createElement("div");
        innerCarousselTop.classList.add("innerCarousselTop");
        if(sens=="left"){
            innerCarousselTop.classList.add("toLeft");
        }else{  
            innerCarousselTop.classList.add("toRight");
        }
        recettes.forEach(recette => {
            innerCarousselTop.appendChild(createTopCard(recette));
        });
        carousselTop.appendChild(innerCarousselTop);
    }
    return carousselTop;
}


function createTopCard(recette){
    const card = document.createElement("div");
    card.classList.add("cardTopElm");
    card.classList.add("cardElm");
    cardVisu(recette).forEach(elm => {
        card.appendChild(elm);
    });
    card.addEventListener("click", () => {
        redirectRecette(recette.owner, recette.id);
    });
    return card
}

function createCards(recettes){
    const cardsDiv = document.createElement("div");
    cardsDiv.id = "cardsDiv";
    recettes.forEach(recette => {
        cardsDiv.appendChild(createCard(recette));
    });
    return cardsDiv;
}

function createCard(recette){
    const card = document.createElement("div");
    card.classList.add("cardElm");
    cardVisu(recette).forEach(elm => {
        card.appendChild(elm);
    });
    card.addEventListener("click", () => {
        redirectRecette(recette.owner, recette.id);
    });
    return card;
}

function cardVisu(recette){
    const recette_img = document.createElement("img");
    recette_img.src = `./api/recettes/api_image_recette.php?id=${recette.id}`;
    // recette_img.src = `./public/img/local_dining.png`;
    // recette_img.src = `./public/img/rdn_img_bouffe.png`;
    recette.atl = "image de la recette";
    recette_img.classList.add("recette_img");

    const titre = document.createElement("p");
    titre.classList.add("titre_reccete");
    titre.textContent = recette.titre;
    
    const upvote = document.createElement("p");
    upvote.classList.add("upvote_p");
    upvote.textContent = recette.upvote;

    const season_img = document.createElement("img");
    season_img.classList.add("season_img");
    if(recette.saison == "all"){
        season_img.src = "./public/img/all-removebg-preview.png";
    }else if(recette.saison == "spring"){
        season_img.src = "./public/img/spring-removebg-preview.png";
    }else if(recette.saison == "summer"){
        season_img.src = "./public/img/summer-removebg-preview.png";
    }else if(recette.saison == "winter"){
        season_img.src = "./public/img/winter-removebg-preview.png";
    }else if(recette.saison == "autumn"){
        season_img.src = "./public/img/autumn-removebg-preview.png";
    }else{
        season_img.alt = "met une vrai saisons fdp";
    }



    return [recette_img, titre, season_img, upvote];
}

function redirectRecette(user_id, id_recette){
    window.location = `https://l1.dptinfo-usmb.fr/~grp9/public/profil.php?owner=${user_id}&id_recette=${id_recette}`;
    console.log("clicked");
}

function initSearch(){
    const input = document.querySelector("#SearchBar input[type='text']");
    const topCard = document.querySelector(".carousselTopContainer");
    const botomCard = document.getElementById("cardsDiv");
    const resultsDiv = document.getElementById("searchResults");

    input.addEventListener("input", () => {
        const value = input.value.trim().toLowerCase();
        if(value.length === 0){
            resultsDiv.style.display = "none";
            resultsDiv.innerHTML = "";
            topCard.style.display = "flex";
            botomCard.style.display = "grid";
            return;
        }

        const filtered = ALL_RECETTES.filter(r => r.titre.toLowerCase().includes(value));

        topCard.style.display = "none";
        botomCard.style.display = "none";
        resultsDiv.style.display = "grid";
        resultsDiv.innerHTML = "";

        if(filtered.length === 0){
            const p = document.createElement("p");
            p.textContent = "Aucun resultat";
            resultsDiv.style.display = "flex";
            resultsDiv.appendChild(p);
            return;
        }

        filtered.forEach(recette => {
            resultsDiv.appendChild(createCard(recette));
        });
    });
}


document.addEventListener('DOMContentLoaded', async ()=>{
    manage_session();
    const recettes = await loadRecettes();
    console.log(recettes);
    ALL_RECETTES = recettes;
    createAllCards(recettes)
    initSearch();
})