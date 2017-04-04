$(function(){
  newPrint()
});

/* Function to pass preset name to local storage */
let newPrint=()=>{
  $('.new-print').on('mousedown', function(){

    /* Get value from class */
    let name = $('.preset-swiper .swiper-slide-active').html();

    /* Set local storage item to variable and redirect to home page */
    localStorage.setItem('name', name);
    window.location.replace("http://45.76.83.52/Ark");
  });
}
