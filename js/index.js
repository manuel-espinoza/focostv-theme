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

});