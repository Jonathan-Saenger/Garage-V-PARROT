  
// Apparition de la Navbar en format mobile

const openNav = document.querySelector(".menuBurger");
const navBar = document.querySelector("nav"); 
const closeNav = document.querySelector(".fermeture")

    openNav.addEventListener('click', apparitionMenu)
        function apparitionMenu () {
            openNav.classList.toggle("active")
            navBar.classList.toggle("active")
        }

    closeNav.addEventListener('click', disparitionMenu)
        function disparitionMenu () {
            navBar.classList.remove("active")
        }
        
//Formulaire témoignage

const etoiles = document.querySelectorAll(".boite-etoiles label");
const noteInput = document.querySelector("#temoignage_note");

etoiles.forEach((label, index) => {
    label.addEventListener("click", () => {
        etoiles.forEach((etoile, i) => {
            if (i <= index) {
                etoile.classList.add("selected");
            } else {
                etoile.classList.remove("selected");
            }
        });
        noteInput.value = index + 1;
    });
});

// Affichage de la valeur des éléments du filtre de recherche des véhicules

const prixInput = document.getElementById("Prix");
const kilometrageInput = document.getElementById("kilométrage");
const anneesInput = document.getElementById("années");

const prixOutput = document.getElementById("prixValeur");
const kilometrageOutput = document.getElementById("kilometrageValeur");
const anneesOutput = document.getElementById("anneeValeur");

const afficherValeur = (input, output) => {
    output.textContent = input.value;
};

prixInput.addEventListener("input", () => {
    afficherValeur(prixInput, prixOutput);
});

kilometrageInput.addEventListener("input", () => {
    afficherValeur(kilometrageInput, kilometrageOutput);
});

anneesInput.addEventListener("input", () => {
    afficherValeur(anneesInput, anneesOutput);
});

// Evènement de recherche des véhicules filtrés 

const boutonFiltrer = document.querySelector('.filtrebouton');
const annonceDiv = document.querySelector('.carte'); 

boutonFiltrer.addEventListener('click', () => {
    const prixValeur = document.getElementById('Prix').value;
    const kilometrageValeur = document.getElementById('kilométrage').value;
    const anneeValeur = document.getElementById('années').value;

// Requête AJAX pour les véhicules 
const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const annonceFiltre = JSON.parse(xhr.responseText);
                annonceDiv.innerHTML = ''; 
                annonceFiltre.forEach(annonce => {
                    const imageElement = document.createElement('img');
                    imageElement.classList.add('imageFile');
                    imageElement.alt = 'Erreur d\'affichage, veuillez nous excuser pour la gêne occasionnée';
                    imageElement.src = annonce.imageFile ? annonce.imageFile : '';
                    imageElement.dataset.image = annonce.imageFile; 
                    
                    const article = document.createElement('article');
                    article.classList.add('carte-service'); 
                    article.appendChild(imageElement);

                    const divCarteAnnonce = document.createElement('div');
                    divCarteAnnonce.classList.add('carte-annonce'); 
                    divCarteAnnonce.innerHTML = `
                        <h3 class="carte-titre">${annonce.titre}</h3>
                        <p>${annonce.infotechniques}</p>
                        <p>${annonce.annee} | ${annonce.carburant} | ${annonce.kilometrage} km | ${annonce.boiteVitesse}</p>
                        <span class="prix">${annonce.prix} €</span>
                        <center><a class="boutondetails" href="${annonce.url}" target="_blank">DETAILS</a></center>
                    `;

                    article.appendChild(divCarteAnnonce);
                    annonceDiv.appendChild(article);
                });
            } else {
                
            }
        }
    };

    const url = `/filtrer-annonces?annee=${anneeValeur}&prix=${prixValeur}&kilometrage=${kilometrageValeur}`;
    xhr.open('GET', url, true);
    xhr.send();
});