$(document).ready(function(){
  $('.drawer').drawer();
  $('.drawer-api-toggle').on(function(){
    $('.drawer').drawer("open");
  });
  $('.drawer').on('drawer.opened',function(){
    console.log('opened');
  });
  $('.drawer').on('drawer.closed',function(){
    console.log('closed');
  });
  $('.drawer-dropdown-hover').hover(function(){ 
    $('[data-toggle="dropdown"]', this).trigger('click');
  });
});