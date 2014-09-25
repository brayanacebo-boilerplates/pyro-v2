/*!
 * JavaScript Library v1.0
 * Brayan Acebo
 */
function abrir_chat(){
  if ($('#chat').hasClass('chat_close')){
    document.getElementById('chat').className='client-window';
  }else{
    document.getElementById('chat').className='chat_close';
  }
}

function cerrar_chat(){
  if ($('#chat').hasClass('client-window')){
    document.getElementById('chat').className='chat_close';
  }else{
    document.getElementById('chat').className='client-window';
  }
}

$(window).load(function(){
  $(document).ready(function() {
    $('.fancybox-media').fancybox({
      openEffect  : 'none',
      closeEffect : 'none',
      helpers : {
        media : {}
      }
    });
  });

  $(".fancybox").fancybox({
      openEffect  : 'elastic',
      closeEffect : 'elastic'
  });



	$("div.pagination").children().attr("class","pagination pagination-sm");

  // Banner
  $('.flexslider').flexslider({
    animation: "slide"
  });

  // fadeOut alerts
  setInterval(function() {
        $(".alert").fadeOut();
  }, 3000);

  // Dejar menú fixed
  // var num = 1; //numero de pixeles al bajar para modificar estilo
  // $(window).bind('scroll', function () {
  //     if ($(window).scrollTop() > num) {
  //         $('header').addClass('fixed');
  //     } else {
  //         $('header').removeClass('fixed');
  //     }
  // });

  // scrollTop
   $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });


    if($('#carousel').length > 0) {
    	$('#carousel').carouFredSel({
        width: '100%',
        items: {
          visible: '+1'
        },
        auto: {
          items: 1
        },
        prev: '#prev',
        next: '#next'
      });
    }
	/*LOGIN*/

  $(".login").click(function(){

    if($(".bkg-login").css("margin-top")=="-165px" && $(".bkg-register").css("margin-top")=="-165px"){
      $(".bkg-login").removeClass("ss");
      $(".bkg-login").animate({'margin-top':'0'},{queue:false, duration:800, easing:''});

    }
    if($(".bkg-login").css("margin-top")=="0px"){
      //alert("Hola");
      $(".bkg-login").animate({'margin-top':'-165px'},500,
        function(){
          $(".bkg-login").addClass("ss");
          //alert("Login Add Class ss");
        });
    }
    if($(".bkg-register").css("margin-top")=="0px" && $(".bkg-login").css("margin-top")=="-165px"){
      $(".bkg-register").animate({'margin-top':'-165px'},500,
        function() {
          $(".bkg-register").addClass("ss");
          $(".bkg-login").removeClass("ss");
            $(".bkg-login").animate({'margin-top':'0'},{queue:false, duration:800, easing:''});
          });
    }
  });

  $(".register").click(function(){
    if($(".bkg-register").css("margin-top")=="-165px" && $(".bkg-login").css("margin-top")=="-165px"){
      $(".bkg-register").removeClass("ss");
      $(".bkg-register").animate({'margin-top':'0'},{queue:false, duration:800, easing:''});
    }
    if($(".bkg-register").css("margin-top")=="0px"){
      //alert("Hola");
      $(".bkg-register").animate({'margin-top':'-165px'},500,
        function(){
          $(".bkg-register").addClass("ss");
          //alert("Register Add Class ss");
        });
    }
    if($(".bkg-login").css("margin-top")=="0px" && $(".bkg-register").css("margin-top")=="-165px"){
      $(".bkg-login").animate({'margin-top':'-165px'},500,
        function() {
          $(".bkg-login").addClass("ss");
          $(".bkg-register").removeClass("ss");
            $(".bkg-register").animate({'margin-top':'0'},{queue:false, duration:800, easing:''});
          });
    }
  });

  /*login head*/
  $(".close_login").click(function(){
      
      if($(".bkg-login").css("margin-top")=="0px"){
      //alert("Hola");
      $(".bkg-login").animate({'margin-top':'-165px'},500,
        function(){
          $(".bkg-login").addClass("ss");
          //alert("Login Add Class ss");
        });
      }
    
  });

  $(".close_register").click(function(){
      
      if($(".bkg-register").css("margin-top")=="0px"){
      //alert("Hola");
      $(".bkg-register").animate({'margin-top':'-165px'},500,
        function(){
          $(".bkg-register").addClass("ss");
          //alert("Register Add Class ss");
        });
    }
  });

});