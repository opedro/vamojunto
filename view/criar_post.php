<?php

require "../controller/pessoa.class.php";
require "../controller/post.class.php";

$pessoa = new Pessoa();
$posts = new Post();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Vamo Junto!</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="scripts/default.js" type="text/javascript"></script>
    <meta name="keywords" content="">
    <meta name="description" content="Caronas">
    <link href="http://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/fonts.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<div id="side-menu"></div>

<div id="header" class="container">
    <div id="header-content">
        <div id="profile">

            <div id="user-detail">
                <img src="images/pic01.jpg" class="profile-image" alt="">
                <span id="user-name">Thiago Retondar</span>
                <span id="user-info">Any info</span>
            </div>

        </div><div id="logo">
            <h2>#VamoJunto</h2>
        </div>

        <div id="menu">
            <ul>
                <li class="current_page_item"><a href="#" accesskey="1" title="">menu</a></li>
            </ul>
        </div>
    </div>
</div>
<div style="height: 73px;"></div>
<div id="posts" style="display: inline-block;">
    <form action="a_definir" method="post">
        <input type="hidden" name="id_comunidade" value="ID DA COMUNIDADE MUDAR" />
        <input type="hidden" name="id_pessoa" value="ID DA PESSOA MUDAR"/>

        <label>
            <input type="radio" name="continuo" />
            <span>Contínuo</span>
        </label>
        <label>
            <span>Dias da semana</span><br />
            Seg - <input type="checkbox" name="weekDays[]" value="true" /> |
            Ter - <input type="checkbox" name="weekDays[]" value="true" /> |
            Qua - <input type="checkbox" name="weekDays[]" value="true" /> |
            Qui - <input type="checkbox" name="weekDays[]" value="true" /> |
            Sex - <input type="checkbox" name="weekDays[]" value="true" /> |
            Sab - <input type="checkbox" name="weekDays[]" value="true" /> |
            Dom - <input type="checkbox" name="weekDays[]" value="true" />
        </label>
        <br/><br/>
        <label>
            <span>Número de vagas: </span> <input type="text" name="numVagas" />
        </label>
        <br/><br/>
        <label>
            Hora partida: <input type="text" name="horaPartida" />
        </label>
        <span style="display: inline-block; width: 80px;"></span>
        <label>
            Hora Chegada: <input type="text" name="horaChegada" />
        </label>
        <br /><br/>
        <a href="#" class="button" id="send-message">Criar carona</a>
    </form>
    <br/><br/><br/>
    <div id="copyright" class="container" style="padding: 0 !important;">
        <p>© Tritz - Tecnologia. All rights reserved</p>
    </div>
</div>
</body>
</html>
