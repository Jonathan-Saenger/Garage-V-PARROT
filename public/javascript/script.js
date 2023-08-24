  
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

// Affichage de la valeur des éléments du filtre de recherch des véhicules

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
