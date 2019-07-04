<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link  href="/css/master.css">
    <title>TAMAGOTWEET</title>
  </head>
  <header>
    <h1>TAMAGOTWEET</h1>
  </header>
  <body>
        <form class="" method="post">
          <textarea type="text" name="tweet" value="Ecrir le tweet"></textarea>
          <input type="submit" name="compteur" value="Publier le tweets" >
        </form>
        <div class="container">
          <p>ici il y aura l'image</p>
        </div>

        <div class="hero">
          <p>ici s'affichera le vomis</p>
        </div>
        <?php

            if(!empty($_POST['compteur'])) {
                $monfichier = fopen("/var/www/html/MesProjetsPHP/MesExos/SauvegardeTamago.txt", 'r+');
                $nbTweet = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
                $nbTweet += 1; // On augmente de 1 ce nombre de pages vues
                fseek($monfichier, 0); // On remet le curseur au début du fichier
                fputs($monfichier, $nbTweet); // On écrit le nouveau nombre de pages vues
                fclose($monfichier);
            }

            $text=$_POST["tweet"];

            require_once('TwitterAPIExchange.php');
            /*authentification du compte tweeter=   token */
            $settings = array('oauth_access_token'=>'3238659609-6X9uGUkxpYhmqQSQqqix4Ewc2uTPdD9nskI45F8',
            'oauth_access_token_secret'=>'QEY4nk2YMueFDACd5nVZiqGkdT8HI5LiW4dKHoi7ZiYth',
            'consumer_key'=>'w3S89uW36ocTHuxTG7nfCjoVK',
            'consumer_secret'=>'fHcG0TZCbF8KRPl7uhyKi1lVhJxQnGm3tc3C2XcXgCVOsjbgjJ');
            /*construction URL pour envoi de tweet*/
            $url = "https://api.twitter.com/1.1/statuses/update.json";
            $requestMethod = "POST";
            $postfields = ["status"=>"$text"]; /*Ecrire un tweet*/

            $twitter = new TwitterAPIExchange($settings);

             $twitter->buildOauth($url, $requestMethod)
                         ->setPostfields($postfields)
                         ->performRequest();

        ?>
  </body>
</html>
