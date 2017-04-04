$(function(){
  getInput()
});

/* Function to get input information and pass to php file */
let getInput=()=>{
  $('.upload').on('mousedown', function(){

    /* Get values from classes */
    let name = $('.name').val();
    let desc = $('.desc').val();
    let speed = $('.speed-swiper .swiper-slide-active').html();
    let temp = $('.temp-swiper .swiper-slide-active').html();
    let type = $('.type-swiper .swiper-slide-active').html();

    /* Pass values to hidden form */
    $('.new-preset-form .name').val(name);
    $('.new-preset-form .desc').val(desc);
    $('.new-preset-form .speed').val(speed);
    $('.new-preset-form .temp').val(temp);
    $('.new-preset-form .type').val(type);

    /* Submit hidden form */
    $('.new-preset-submit').click();
  });
}
