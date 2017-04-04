$(function(){
  populateSpeedSwiper()
  populateTempSwiper()
  populateTypeSwiper()
  populateDeviceSwiper()
  initSwiper()
});

/* Populate preset speed setting with options between 10 & 100 RPM */
let populateSpeedSwiper=()=>{
  for(i=10;i<101;i++){
    $('.speed-swiper').append('<div class="swiper-slide">'+i+'</div>');
  }
}

/* Populate preset temperature setting with options between 100 & 250 Degrees */
let populateTempSwiper=()=>{
  for(i=100;i<251;i++){
    $('.temp-swiper').append('<div class="swiper-slide">'+i+'</div>');
  }
}

/* Populate preset type setting with all thermoplastic options */
let populateTypeSwiper=()=>{
  types = ['ABS', 'PLA', 'PP', 'PET', 'PE', 'PBI', 'PC', 'PES', 'PEEK', 'PEI', 'PPO', 'PPS', 'PTFE'];
  for(i=0;i<types.length;i++){
    $('.type-swiper').append('<div class="swiper-slide">'+types[i]+'</div>');
  }
}

/* Populate device swiper options with placeholder devices */
let populateDeviceSwiper=()=>{
  devices = ['MAIN EXTRUDER', 'WORK EXTRUDER', 'OFFICE EXTRUDER'];
  for(i=0;i<devices.length;i++){
    $('.device-swiper').append('<div class="swiper-slide">'+devices[i]+'</div>');
  }
}

/* Initialize the swiper javascript library */
let initSwiper=()=>{
  var mySwiper = new Swiper ('.swiper-container',{
    slidesPerView: 5,
    spaceBetween: 10,
    loop: true
  });
}
