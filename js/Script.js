let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

var swiper = new Swiper(".home-slider", {
    loop:true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".reviews-slider", {
    loop:true,
    autoHeight:true,
    grabCusor:true,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: { 
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 50,
      },
    },
});

let loadMoreBtn = document.querySelector('.services .load-more .btn');
let currentItem = 2;

loadMoreBtn.onclick = () =>{
  let boxes = [...document.querySelectorAll('.services .box-container .box')];
  for (var i = currentItem; i < currentItem + 1; i++){
    boxes[i].style.display = 'inline-block';
  };
  currentItem +=1;
  if(currentItem >= boxes.length){
    loadMoreBtn.style.display = 'none';
  }
};




/*loop:true,
    spaceBetween: 10,
    autoHeight:true,
    grabCusor:true,*/