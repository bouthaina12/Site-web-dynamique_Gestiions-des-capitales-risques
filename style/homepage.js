
/*footer*/
const footer_input = document.querySelector(".footer-input");

footer_input.addEventListener("focus", () => {
    footer_input.classList.add("focus");
  });
  
  footer_input.addEventListener("blur", () => {
    if (footer_input.value != "") return;
    footer_input.classList.remove("focus");
  });


/*reviews*/
var testimonials = document.getElementById('testimonials');
        var control1 = document.getElementById('control1');
        var control2 = document.getElementById('control2');
        var control3 = document.getElementById('control3');
        
        
        control1.onclick=function(){
            testimonials.style.transform = "translateX(870px)";
            control1.classList.add("active");
            control2.classList.remove("active");
            control3.classList.remove("active");
        }
        
        control2.onclick=function(){
            testimonials.style.transform = "translateX(0px)";
            control1.classList.remove("active");
            control2.classList.add("active");
            control3.classList.remove("active");
        }
        
        control3.onclick=function(){
            testimonials.style.transform = "translateX(-870px)";
            control1.classList.remove("active");
            control2.classList.remove("active");
            control3.classList.add("active");
        }


let navbar = document.querySelector('.header .navbar')

document.querySelector('#menu').onclick = () =>{
  navbar.classList.add('active');
}

document.querySelector('#close').onclick = () =>{
  navbar.classList.remove('active');
}







