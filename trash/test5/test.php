
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">
<script type="text/javascript" language = "javascript">
<!--
// 모바일 웹 주소창 숨기기
window.addEventListener('load', function() {
  // body의 height를 살짝 늘리는 코드
  document.body.style.height = (document.documentElement.clientHeight + 5) + 'px';
  // scroll를 제어 하는 코드
  setTimeout(scrollTo, 0, 0, 1);
}, false);
//-->
</script
<title></title>
<link rel="stylesheet" href="mobile_sidebar.css">
</head>

<body>
<div id="pages_wrraper">

    <nav class="navigator" id="navigator">
        <div id="wrapper">
            <ul class="menu">
                        <li class="subitem1"><a href="#">서브메뉴1-1 <span>▶</span></a></li>
                        <li class="subitem2"><a href="#">서브메뉴1-2 <span>▶</span></a></li>
                        <li class="subitem3"><a href="#">서브메뉴1-3 <span>▶</span></a></li>
                        <li class="subitem3"><a href="#">서브메뉴1-4 <span>▶</span></a></li>

            </ul>
        </div>
    </nav>
    
    <div class="page-wrap">
        <header class="main-header ">
            <a href="#navigator" class="open-menu">
                <div style="float:left; width:10%;">
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                </div>
                
                <div class="open_menu_txt">
                    신토불이
                </div>
                
                <div style="clear:both;">
                </div>
            </a>
            <a href="#" class="close-menu">
                <div style="float:left; width:100px; width:10px;">
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                </div>
                
                <div class="open_menu_txt">
                    신토불이
                </div>
                
                <div style="clear:both;">
                </div>
            </a>
        </header>
        <section id="main_pages">
            <!-- 본문시작 -->
            여기는 본문 내용이 입력되는 위치를 의미합니다. 
<?php
require ("../user_login.php");
?>
            <!-- 본문끝 -->
        </section>
    </div>
</div>
</body>
</html>
