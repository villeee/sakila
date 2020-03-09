<?php 

    // GENRE-VALIKKO
      
    function genremenu() {
        global $mysqli; // Glogaali muuttuja pitää määrittää
        $sql = "SELECT * FROM category";
        $tulos = $mysqli -> query($sql);

        if ($tulos -> num_rows > 0) {
        while($rivi = $tulos -> fetch_assoc()){
            $c_id = $rivi["category_id"];
            $genre = $rivi["name"];       
            echo "<button class='btn' id='$c_id' onClick='haeGenrenLeffat(this.id)'>$genre</button></br>";                     
        }
    } else {
        echo "Ei tuloksia";
    }       
    $mysqli -> close();  
    }
  
     
 ?> 