$(document).ready(()=>{

  /*トップ文字のフェードイン*/
  $(window).on('load', function() {
    $('h1').fadeIn('slow');
    $('a').fadeIn('slow');
  });

  $(window).on('unload', function() {
    $('h1').fadeIn('slow');
    $('a').fadeIn('slow');
  });

  /*読み込まれなかった時用*/
  $('h1').fadeIn('slow');
  $('a').fadeIn('slow');
  /*END : 読み込まれなかった時用*/
  /*END : トップ文字のフェードイン*/

  let show = 'login';

  $('#tab-login').on('click', ()=>{
    $('#login').removeClass('d-none');
    $('#register').addClass('d-none');

    $('#tab-register').removeClass('gradation');
    $('#tab-login').addClass('gradation');
  });

  $('#tab-register').on('click', ()=>{
    $('#register').removeClass('d-none');
    $('#login').addClass('d-none');

    $('#tab-login').removeClass('gradation');
    $('#tab-register').addClass('gradation');
  });

  var body = document.getElementsByTagName('body')[0];
 
  function fadeOut() {
      body.classList.add('bodyfadeout');
  }
  
  function linkUrl() {
      location.href = 'ここに遷移先のアドレス'
  }
  var bt1 = document.getElementById('fadeout');
  bt1.addEventListener('click', function() {
      fadeOut();
      setTimeout(linkUrl, 1500);
  })

});