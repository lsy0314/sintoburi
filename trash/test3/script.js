function s() {
    $('.top-menu').toggleClass('active');
}

var 메뉴아이템이_클릭되면_할일 = function () {
    var $클릭된_녀석 = $(this);
    if ($클릭된_녀석.hasClass('active')) {
        $클릭된_녀석.removeClass('active');
        }
    else {
        $클릭된_녀석.addClass('active');
    }
}

var $li = $('.mobile-top-bar .top-menu li ');
$li.click(메뉴아이템이_클릭되면_할일);

var 장바구니 = window.$('.mobile-top-bar .top-menu li ');
$장바구니.click(메뉴아이템이_클릭되면_할일);


