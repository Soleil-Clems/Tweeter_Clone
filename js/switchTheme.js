window.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector(':root');
    const lightTheme = "white";
    const darkTheme = "rgba(0, 0, 0, 1)";
    const lightDark = "rgba(22, 25, 29, 255)";
    const littleDark = "rgb(51, 54, 57)";
    const thinBlue = "rgba(28, 155, 241, .2)";
    const chooseTheme = document.getElementById("chooseTheme")
    const logo = document.getElementById("logoImg")

    
    
    let getTheme = localStorage.getItem("theme")
    themeFunction(getTheme)
    let setTheme;
    chooseTheme.addEventListener("change", (e)=>{
        if(chooseTheme.checked){
            setTheme = localStorage.setItem("theme", "dark")
            
        }else{
            setTheme = localStorage.setItem("theme", "light")
            

        }
        getTheme = localStorage.getItem("theme")
        themeFunction(getTheme)
    })

    function themeFunction(theme) {
        if (theme == "dark") {
            chooseTheme.checked=true
            logo.src="./assets/favicon.webp"
            root.style.setProperty('--light-theme', darkTheme);
            root.style.setProperty('--dark-theme', lightTheme);
            root.style.setProperty('--thin-blue', lightDark);
        }else{
            logo.src="./assets/logo.webp"
            root.style.setProperty('--light-theme', lightTheme);
            root.style.setProperty('--dark-theme', darkTheme);
            root.style.setProperty('--thin-blue', thinBlue);
        }
    }

})