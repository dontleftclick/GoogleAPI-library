<?php
include_once("connect.php");

if(isset($_POST['submit'])){ // Change to POST method

    $reviewText = strip_tags($_POST['reviewText']);
    $userName = strip_tags($_POST['userName']);
    $author = $_GET['author'];
    $publisher = $_GET['publisher'];
    $image = $_GET['image'];

    $bookTitle = $_GET['title'];

    $query = "INSERT INTO review (reviewText, userName, bookTitle) VALUES ('$reviewText', '$userName', '$bookTitle')"; // Fix variable names

    if(empty($reviewText))  { 
        echo "*review field empty";
    }
    else {
        if(mysqli_query($connection, $query)){
            echo "Review submitted successfully!";
            header("Location: book.php?title=" . urlencode($bookTitle) . "&author=" . urlencode($author) . "&publisher=" . urlencode($publisher) . "&image=" . urlencode($image));
            exit(); 
            
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
}
?>
