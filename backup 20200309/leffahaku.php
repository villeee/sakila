<?php 
    $server = "localhost";
    $user = "root";  
    $pw = "root";
    $database = "sakila";

    $nimi = trim(strip_tags( $_POST['nimi'] ) );
    $nimi = strtoupper($nimi);
    
    $mysqli = new mysqli("$server","$user","","$database");
    if($mysqli -> connect_error) {
        die("Liian hapokasta: " . $mysqli -> connect_error);
    }
    $mysqli -> set_charset("utf8");

    // 1. Toteuta yksinkertainen hakulomake, jolla voi hakea elokuvan nimellä
    // tai nimen osalla. Hakutuloksissa näytetään elokuvan nimi, kuvaus, ikäraja ja julkaisuvuosi.



   $haku = "SELECT f.title, f.description, f.rating, f.release_year FROM film f " . " WHERE UPPER(f.title) LIKE '%$nimi%' ORDER BY title";

   $tulos = $mysqli -> query($haku);
    if ($tulos -> num_rows > 0) {
        while($rivi = $tulos -> fetch_assoc()) {

            $title = $rivi['title'];
            $description = $rivi["description"];
            $rating = $rivi["rating"];
            $release_year = $rivi["release_year"];

        //    $title = $mysqli->real_escape_string(strip_tags($_POST['title']));
        //    $description = $mysqli->real_escape_string(strip_tags($_POST['description']));
        //    $rating = $mysqli->real_escape_string(strip_tags($_POST['rating']));
        //     $release_year = $mysqli->real_escape_string(strip_tags($_POST['release_year']));

        echo "Film: ". $title . "<br>Description: " . $description . "<br>Rating: " . $rating . "<br>Release year: " . $release_year . "<br><br>";
 
       //  echo "<span>$title</span><span>$description</span><span>$rating</span><span>$release_year</span>";		
   
 
    }
        } else {
         echo "Ei tuloksia";
    }

    $mysqli -> close();
    
?>