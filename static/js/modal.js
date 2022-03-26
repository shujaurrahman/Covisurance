
const inputs = document.querySelectorAll(".input-field");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image-modal");
const modal =document.getElementById("modal");
const openBtn =document.getElementById("openBtn");
const signupopenBtn =document.getElementById("signupopenbtn");
const closeBtn =document.getElementById("closeBtn");

inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});


function moveSlider() {
  let index = this.dataset.value;

  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}

bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});

// var bullets = new bullets(".active", {
//   speed: 1100,
//   slidesPerView: 1,
//   loop: true,
//   autoplay: {
//     delay: 5000,
//   },
//   navigation: {
//     prevEl: ".swiper-button-prev",
//     nextEl: ".swiper-button-next",
//   },
// });

openBtn.addEventListener('click', ()=>{
  modal.style.display="block";
});

closeBtn.addEventListener('click',()=>{
  modal.style.display="none";
});

// signupopenBtn.addEventListener('click', ()=>{
//   modal.style.display="none";
// });

window.addEventListener('click',(e)=>{
  if(e.target === modal){
    modal.style.display="none";
  }
})