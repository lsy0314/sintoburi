$(document).ready(function(){

  $(window).load( function() {
   /* 메뉴버튼을 눌렀을때, 오버레이부분을 클릭했을때*/
    $(".ninja-btn, .panel-overlay").click( function() {
      $(".ninja-btn, .panel-overlay, .panel").toggleClass("active"); //해당 영역에 toggleClass를 넣어줍니다
      /* panel overlay가 활성화 되어있는지를 체크합니다. */
      if ($(".panel-overlay").hasClass("active")) {
        $(".panel-overlay").fadeIn();
      } else {
        $(".panel-overlay").fadeOut();
      }
    });

  });

})

