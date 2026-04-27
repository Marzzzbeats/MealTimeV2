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
        const navbar = document.querySelector('#navbar_ul');
        const notifs = document.querySelector('#notifs_div');
        if(res.ok){
            let data = await res.json();
            const login = document.querySelector('#login');
            const register = document.querySelector('#register');
            const logout = document.querySelector('#logout');
            const pp = document.querySelector('#pdp_img');
            const user = data.user;
            if(data.connected == true && data.user != null){
                const hello = document.createElement("p");
                hello.textContent = `Bonjour ${data.user.prenom}`;
                hello.id = "userName_p";
                login.classList.add("hidden");
                register.classList.add("hidden");
                logout.classList.remove("hidden");
                document.body.appendChild(hello);
                navbar.classList.remove('hidden');
                notifs.classList.remove('hidden');
                pp.setAttribute('src', `https://l1.dptinfo-usmb.fr/~grp9/api/user/getProfilePic.php?id=${user.id}`);
            }else{
                navbar.classList.add('hidden');
                notifs.classList.add('hidden');
            }
        }
    }catch(err){
        console.error(err.message);
    }
}



function createAllCards(recettes){
    const container = document.getElementById("container");
    let top = recettes.slice(0, 20);
    let rest = recettes.slice(0);

    container.appendChild(createTopCards(top));
    container.appendChild(createCards(rest));

    return;
}

function createTopCards(recettes){
    const carousselTopContainer = document.createElement("div");
    carousselTopContainer.classList.add("carousselTopContainer");
    let rec = [recettes.slice(0, recettes.length/2), recettes.slice(recettes.length/2, recettes.length)];
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
    const wrapper = document.createElement("div");
    wrapper.classList.add("cardWrapper");
    wrapper.classList.add("cardTopWrapper");

    cardVisu(recette).forEach(elm => {
        wrapper.appendChild(elm);
    });
    wrapper.querySelector(".cardElm").classList.add("cardTopElm");
    wrapper.addEventListener("click", () => {
        redirectRecette(recette.owner, recette.id);
    });
    return wrapper
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
    const wrapper = document.createElement("div");
    wrapper.classList.add("cardWrapper");
    
    cardVisu(recette).forEach(elm => {
        wrapper.appendChild(elm);
    });
    wrapper.addEventListener("click", () => {
        redirectRecette(recette.owner, recette.id);
    });

    return wrapper;
}

function cardVisu(recette){
    const titre = document.createElement("p");
    titre.classList.add("titre_recette");
    titre.textContent = recette.titre;

    const recette_img = document.createElement("img");
    recette_img.src = `./api/recettes/api_image_recette.php?id=${recette.id}`;
    recette.atl = "image de la recette";
    recette_img.classList.add("recette_img");
    
    const upvote = document.createElement("p");
    upvote.classList.add("upvote_p");
    upvote.textContent = recette.upvote;

    const card = document.createElement("div");
    card.classList.add("cardElm");
    const season_img = document.createElement("img");
    season_img.classList.add("season_img");
    if(recette.saison == "all"){
        season_img.src = "./public/img/all-removebg-preview.png";
    }else if(recette.saison == "printemps"){
        season_img.src = "./public/img/spring.png";
    }else if(recette.saison == "ete"){
        season_img.src = "./public/img/summer.png";
    }else if(recette.saison == "hiver"){
        season_img.src = "./public/img/winter.png";
    }else if(recette.saison == "automne"){
        season_img.src = "./public/img/autumn-removebg-preview.png";
    }else{
        season_img.alt = "Saison invalide";
    }

    card.appendChild(recette_img);
    return [titre, upvote, card, season_img];
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
            p.id = "noRes";
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