  
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


