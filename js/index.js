document.addEventListener('DOMContentLoaded', function () {

    // toogle menu
    const focostvToggleButton = document.getElementById('focostv-toggle-button')
    const focostvSiteToggleNavigation = document.getElementById('focostv-site-toggle-navigation')

    focostvToggleButton.addEventListener('click', () => {

        focostvToggleButton.classList.toggle('focostv-menu-open')
        focostvSiteToggleNavigation.classList.toggle('focostv-menu-open')

        const icon = focostvToggleButton.querySelector("i")

        if (focostvToggleButton.classList.contains('focostv-menu-open')) {
            icon.classList.remove('fa-bars')
            icon.classList.add('fa-xmark')
        } else {
            icon.classList.remove("fa-xmark");
            icon.classList.add("fa-bars");
        }
    })

    //toggle search
    const focostvToggleSearch = document.getElementById('focostv-toggle-search')
    const focostvSearch = document.getElementById('focostv-site-search')

    focostvToggleSearch.addEventListener('click', () => {
        focostvToggleSearch.classList.toggle('focostv-search-open')
        focostvSearch.classList.toggle('focostv-search-open')
        
        const icon = focostvToggleSearch.querySelector("i")

        if (focostvToggleSearch.classList.contains('focostv-search-open')) {
            icon.classList.remove('fa-bars')
            icon.classList.add('fa-xmark')
        }
        else {
            icon.classList.remove("fa-xmark");
            icon.classList.add("fa-bars");
        }
    })

});