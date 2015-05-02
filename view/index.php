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
        <span id="user-name">Maria das Dores</span>
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
    <?php
        $qtd_posts = count($posts->getPosts());
        $i = 1;
        foreach($posts->getPosts() as $post) {
            $class = ($i++ % 2 == 0) ? 'post-even' : 'post';
            $post_pessoa = $pessoa->getPessoaById($post["id_pessoa"]);
            $post_pessoa = $post_pessoa[0];
    ?>
    <div class="<?php echo $class; ?>">

        <img src="<?php echo $post_pessoa['foto'] ?>" class="post-image">
        <ul id="post-info">
          <li><h1><?php echo $post_pessoa["nome"] . " " . $post_pessoa["sobrenome"]; ?></h1></li>
          <li>5 estrelas</li>
          <li>
              <?php
              if($post["segunda"] == 1)
                echo "seg ";
              if($post["terca"] == 1)
                echo "ter ";
              if($post["quarta"] == 1)
                echo "qua ";
              if($post["quinta"] == 1)
                echo "qui ";
              if($post["sexta"] == 1)
                echo "sex ";
              if($post["sabado"] == 1)
                echo "sab ";
              if($post["segunda"] == 1)
                echo "dom ";
              ?>
          </li>
        </ul>

        <ul class="confirmed">
        <?php
        if( empty($posts->getConfirmacoes($post["id"])) ) {
            $j = $post["num_vagas"];
            while($j--) {
                echo "<li><img src='images/interrogation.jpg' /></li>";
            }
        } else {
            foreach( $posts->getConfirmacoes($post["id"]) as $confirmados ) {
                $confirmado = $pessoa->getPessoaById($confirmados['id_pessoa']);
            ?>
                <li><img src="<?php echo $confirmado[0]['foto'] ?>"></li>
            <?php
            }
            if($post["num_vagas"] > 0) {
                $j = $post["num_vagas"];
                while($j--) {
                    echo "<li><img src='images/interrogation.jpg' /></li>";
                }
            }
        }?>
        </ul>
        <hr>
        <ul class="tags">
            <li id="partida">17:00</li>
            <?php
            $trajetos = $posts->getTrajeto($post["id"]);
            foreach( $trajetos as $trajeto ) {
                echo "<li>$trajeto</li>";
            }
            ?>
            <li id="chegada">19:00</li>
        </ul>


      <a href="#" class="button" id="send-message">Vamo junto!</a>
    </div>
    <?php
        }
    ?>
  <div id="copyright" class="container" style="padding: 0 !important;">
    <p>© Tritz - Tecnologia. All rights reserved</p>
  </div>
  </div>
  </body>
</html>
