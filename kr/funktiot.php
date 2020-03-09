<?php

function callFunctions($mode)
{
    $local = ($_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['REMOTE_ADDR']=='::1');
    
    // 
    // foreach ($_SERVER  as $k => $v)
    // {
    //     echo "key: $k, value: $v <br>";       
    //     
    // }
    // 
    // var_export ($_SERVER);
    if (!$local )
    {
        $palvelin   = "127.0.0.1:53181";
        $kayttaja   = "azure";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
        $salasana   = "6#vWHD_$";
        $tietokanta = "sakila";
    }
    else {
        $palvelin   = "localhost";
        $kayttaja   = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
        $salasana   = "";
        $tietokanta = "sakila";
     }

    $con = mysqli_connect($palvelin, $kayttaja, $salasana, $tietokanta);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    try {
        switch ($mode)
        {
            case "fetchCategories":
                valikko($con);
                break;

            case "fetchFilms":
                fetchFilms($con);
                break;

            case "fetchLanguages":
                fetchLanguages($con);
                break;

            case "createFilm":
                createFilm($con);            
                break;       
        
            default:
                break;
        }
    }
    finally {
        mysqli_close($con);
    }
   
}

function valikko( $con)
{   
    $sql = "SELECT category_id, name FROM category order by name";

    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0)
    {
        $valitse = "Valitse kaikki kategoriat";  
        echo  "<select name=\"gategoria\">";
        echo  "<option value=0 selected>$valitse</option>";

        while($row = mysqli_fetch_assoc($result)) 
        {
            $id   = $row["category_id"];
            $name = $row["name"];
    
            echo  "<option value=$id>$name</option>";
        }
    }
    else
    {
        echo "Tietoja ei löydy";
    }
}

function fetchLanguages($con)
{
    $sql = "SELECT l.language_id, l.name FROM language l order by l.name";
    $result = mysqli_query($con, $sql);
    
    echo   "<select name=\"kieli\" id=\"kieli\">";

    if (mysqli_num_rows($result) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
            echo "<option value=" . $row["language_id"]. ">" . $row["name"]. "</option>";
        }
    } else {
        echo "0 results";
    }
    echo "<br><br>"; //todo:
}

function fetchFilms( $con)
{
    $nimi        = trim(strip_tags( $_POST['nimi'] ) );
    $nimi        = mysqli_real_escape_string($con, $nimi);

    $nimi        = strtoupper($nimi ); //to uppercase

    $category =  $_POST['gategoria'];
        
    if ($category != 0)
    {
        // $sql =  
        // "SELECT f.film_id, f.title, f.description, f.release_year, f.rating, c.name as categoryname FROM film f, category c ".
        // "WHERE UPPER(f.title) LIKE '%$nimi%' AND c.category_id = '$category'  AND " .
        // "f.film_id IN (SELECT fc.film_id FROM film_category fc WHERE fc.film_id = f.film_id) ORDER BY title";
        
         $sql =  
        "SELECT f.film_id, f.title, f.description, f.release_year, f.rating, c.name as categoryname FROM film f" . 
        " INNER JOIN film_category fc ON fc.film_id = f.film_id INNER JOIN category c ON c.category_id = fc.category_id".
        " WHERE UPPER(f.title) LIKE '%$nimi%' AND fc.category_id = '$category' ORDER BY title";
        
        // echo $sql ;
        // exit;
        
    }
    else //no category selected
    {
        $sql =
        // "SELECT f.film_id, f.title, f.description, f.release_year, f.rating, c.name as categoryname FROM film f, category c ".
        // "WHERE UPPER(f.title) LIKE '%$nimi%' AND  " .
        // "f.film_id IN (SELECT fc.film_id FROM film_category fc WHERE fc.film_id = f.film_id) " .
         "SELECT f.film_id, f.title, f.description, f.release_year, f.rating, c.name as categoryname FROM film f" . 
        " LEFT JOIN film_category fc ON fc.film_id = f.film_id LEFT JOIN category c ON c.category_id = fc.category_id".
        " WHERE UPPER(f.title) LIKE '%$nimi%' ORDER BY title";
    //  echo $sql ;
    //     exit;
// 
//         "UNION " .
// 
//         "SELECT f.film_id, f.title, f.description, f.release_year, f.rating, '' as categoryname FROM film f, category c ".
//         "WHERE UPPER(f.title) LIKE '%$nimi%' AND  " .
//         "f.film_id NOT IN (SELECT fc.film_id FROM film_category fc WHERE fc.film_id = f.film_id) " .       
//         
//         "ORDER BY title";
    }
    
      
       

    $result = mysqli_query($con, $sql);
    
   
    if (mysqli_num_rows($result) > 0)
    {
        echo "<table><tr><th>Nimi</th><th>Kuvaus</th><th>Ikäraja</th><th>Julkaisuvuosi</th><th>Kategoria</th></tr>";

        while($row = mysqli_fetch_assoc($result)) 
        {
            $title = $row['title'];
            $description = $row["description"]; 
            $release_year = $row["release_year"];
            $rating = $row["rating"];
            $categoryname = $row["categoryname"];
        
            echo "<tr><td>$title</td><td>$description</td><td>$rating</td><td>$release_year</td><td>$categoryname</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<br>Tietoja ei löydy!";
    } 
}


function createFilm($con)
{
    $title              = trim(strip_tags( $_POST['nimi']));
    $title              = mysqli_real_escape_string($con, $title);

    $description        = trim(strip_tags( $_POST['kuvaus'])); 
    $description        = mysqli_real_escape_string($con, $description);
  
    $release_year       = (int) $_POST['julkaisuvuosi'];
    
    $language_id        = (int) $_POST['kieli'];
    $original_language_id = (int) $_POST['kieli'];
    
    $rental_duration    = (int)$_POST['vuokraaika'];
  
    $rental_rate        = (double) $_POST['vuokrahinta'] ;
  //  $rental_rate        = str_replace(',', '.', $rental_rate); //commas to points
     
    //echo "test1: $rental_rate"; 

    $length             = (int)$_POST['pituus']; 
   
    $replacement_cost   = (double)$_POST['korvaushinta'] ;
    
    // echo "replacement_cost: $replacement_cost"; 
    // exit;
   // $replacement_cost   = str_replace(',', '.', $replacement_cost); //commas to points

   // echo "test2: $rental_rate"; 

    $rating             = trim(strip_tags( $_POST['ikaraja'] ));   
    $rating             = mysqli_real_escape_string($con, $rating);

   
    $special_features    = trim(strip_tags( $_POST['special_features'] ));  
    $special_features    = mysqli_real_escape_string($con, $special_features);

    if ( $language_id  == 0)
    {
        $language_id = NULL;
    }

    $sql = "INSERT INTO film  (
                title,
                description,
                release_year,
                language_id,
                original_language_id,
                rental_duration,
                rental_rate,
                length,
                replacement_cost,
                rating,
                special_features               
            )
            VALUES (
                '$title',
                '$description',
                '$release_year',
                '$language_id',
                '$original_language_id',
                '$rental_duration',
                '$rental_rate',
                '$length',
                '$replacement_cost',
                '$rating',
                '$special_features')";

    if (mysqli_query($con, $sql))
    {
        echo "Elokuva $title lisätty onnistuneesti tietokantaan!";
    }
    else
    {
        echo "Error updating record: " . mysqli_error($con);
    }    
}
  
?>