  
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

