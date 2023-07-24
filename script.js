function menuResponsive() {
    const ouverture = document.getElementsByClassName('menuBurger');
    const addMenu = document.getElementsByClassName('navbar');
    const fermeture = document.getElementsByClassName('fermeture');

    ouverture.addEventListener('click', () => {
        addMenu.classList.add('show-nav');
    })   

    fermeture.addEventListener('click', () => {
        addMenu.classList.remove('show-nav');
    })  
}

menuResponsive(); 