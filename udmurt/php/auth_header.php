<?
session_start();
include('connectdb.php');
?>
<ul>
    <li>
        <div class="logo"></div>
    </li>
    <li class="header-link" onclick="$('main').load('./html/find.html');">Поиск</li>
    <li class="header-link" onclick="$('main').load('./html/excur.html');">Экскурсии</li>
    <li class="header-link" onclick="$('main').load('./html/sights.html');">Достопримечательности</li>
    <li class="header-link" onclick="$('main').load('./html/udmurt.html');">Удмуртия</li>
    <li>
        <button class="header-btn" onclick="$.post('./php/personal.php', {
            id: <?echo $_SESSION['id']?>}, function (data) {
                $('main').html(data);   
            }
        )">Личный кабинет</button>
    </li>
</ul>