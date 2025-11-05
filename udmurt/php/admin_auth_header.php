<?
session_start();
include('connectdb.php');
?>
<ul>
    <li>
        <div class="logo"></div>
    </li>
    <li class="header-link" onclick="$('main').load('./html/admin_excur.html');">Экскурсии</li>
    <li class="header-link" onclick="$('main').load('./html/admin_sights.html');">Достопримечательности</li>
    <li class="header-link" onclick="$('main').load('./html/admin_udmurt.html');">Удмуртия</li>
    <li>
        <button class="header-btn" onclick="$('header').load('./html/admin_noauth_header.html'); $('main').load('./html/admin_login.html')">Выход</button>
    </li>
</ul>