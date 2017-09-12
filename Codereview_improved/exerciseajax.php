<?php
  include 'dbconnect.php';
// Selecting Database
//Fetching Values from URL
$ISBNItem=$_POST['ISBN1'];
$titelItem=$_POST['titel1'];
$authorItem=$_POST['author1'];
$statusItem=$_POST['status1'];
$descriptionItem=$_POST['description1'];
$photoLinkItem=$_POST['photoLink1'];
$genreItem=$_POST['genre1'];
//return $genreItem;
// echo "<br>";
// var_dump($_POST)
$sql = "INSERT INTO book (ISBN, titel, author, status, description, photoLink, genre) VALUES (\"$ISBNItem\", \"$titelItem\" ,\"$authorItem\", \"$statusItem\",  \"$descriptionItem\" , \"$photoLinkItem\" , \"$genreItem\")";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . mysqli_error($conn);
}
mysqli_close($conn);
?>