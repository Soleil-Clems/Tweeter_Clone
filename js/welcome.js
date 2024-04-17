const loginBtn = document.getElementById("choosedRegister")
const registerBtn = document.getElementById("choosedLogin")
const register = document.getElementById("signIn")
const login = document.getElementById("login")
const swipe = document.querySelector(".swipe")

loginBtn.addEventListener("click", (e)=>{
    e.preventDefault()
    swipe.style.transform ="translateX(100%)";
    login.style.display= "none"
    register.style.display= "flex"
    swipe.style.transition="transform 1s .1s ease"
})

registerBtn.addEventListener("click", (e)=>{
    e.preventDefault()
    login.style.display= "flex"
    register.style.display= "none"
    swipe.style.transform ="translateX(0%)";
    swipe.style.transition="transform 1s .1s ease"
})