  
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

    etoiles.forEach((label, index) => {
      label.addEventListener("click", () => {
        for (let i = 0; i < etoiles.length; i++) {
          if (i <= index) {
            etoiles[i].classList.add("selected");
          } else {
            etoiles[i].classList.remove("selected");
          }
        }
      });
    });

    
    
    
    
    

