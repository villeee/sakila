<?php 
    include "db.php";     // avaa tietokannan 
    $genre_id = $_POST['data']; // genre-id tulee buttonin klikkauksesta 

   $sql_leffat = "SELECT c.name, f.title, f.description, f.rating, f.release_year FROM (film f LEFT JOIN film_category fc on f.film_id = fc.film_id) INNER JOIN category c on fc.category_id = c.category_id where c.category_id = $genre_id";
    $tulos = $mysqli->query($sql_leffat);
    
    if ($tulos -> num_rows > 0) {
       $a = 0;
        while($rivi = $tulos -> fetch_assoc()){

            $genre = $rivi["name"];
            $title = $rivi["title"];
            $description = $rivi["description"];
            $rating = $rivi["rating"];
            $release_year = $rivi["release_year"];

            if ($a == 0) {
                echo "<h1>".strtoupper($genre)."</h1>"; // Genren otsikko sisältökenttään
            }
            echo "<b>$title</b>, $release_year, $rating</br>";                  
            echo $description."</br></br>";

            $a++;
        }
    } else {
        echo "Ei tuloksia";
    }     

    $mysqli -> close();    
?>