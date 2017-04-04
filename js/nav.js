$(function(){
  openNav()
  closeNav()
});

/* Function to open side navigation */
let openNav=()=>{
  $('.open').on('mousedown', function(){
    $('.side-nav').css({"width" : "100%"});
  });
}

/* Function to close side navigation */
let closeNav=()=>{
  $('.close').on('mousedown', function(){
      $('.side-nav').css({"width" : "0"});
  });
}
