<?php
    include 'db.php';
  //  global $mysqli;
	echo $title = $_POST['title'];
    $desc= $_POST['desc'];
    $year= $_POST['year'];  
    $lang_id = $_POST['lang_id'];
    $orig_lang_id = $_POST['orig_lang_id'];
    $rent_dur = $_POST['rent_dur'];
    $rent_rate = $_POST['rent_rate'];
    $length = $_POST['length'];
    $replace_cost = $_POST['replace_cost'];
    $rate= $_POST['rate'];
    $special_feat = $_POST['special_feat'];

	$sql = "INSERT INTO film f (f.title,
    f.description,
    f.release_year,
    f.language_id,
    f.original_language_id,
    f.rental_rate,
    f.lenght,
    f.replacement_cost,
    f.rating,
    f.special_features) VALUES ($title, $desc, $year, $lang_id, $orig_lang_id, $rent_dur, $rent_rate, $length, $replace_cost, $rate, $special_feat)";

if ($mysqli -> query($sql) === TRUE) {
        echo "Movie inserted";
    } else {
        echo "failed";       
    }
?>