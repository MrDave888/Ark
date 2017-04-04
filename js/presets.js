$(function(){
  addPreset()
  removePreset()
});

/* Function to add preset from community to users collection of presets */
let addPreset=()=>{
  $('.preset-add').on('mousedown', function(){

    /* Get preset id from id */
    let id = $('.preset-add').attr('id');

    /* Pass id to hidden form and submit */
    $('.add-preset-form').val(id);
    $('.add-preset-form-submit').click();
  });
}

/* Function to remove preset from users collection of presets */
let removePreset=()=>{
  $('.preset-remove').on('mousedown', function(){

    /* Get preset id from id */
    let id = $('.preset-remove').attr('id');

    /* Pass id to hidden form and submit */
    $('.remove-preset-form').val(id);
    $('.remove-preset-form-submit').click();
  });
}
