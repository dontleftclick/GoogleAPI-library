<?php
include_once("connect.php");

$bookTitle = $_GET['title'];
$query = "SELECT * FROM review WHERE bookTitle='$bookTitle'";
$result = mysqli_query($connection, $query);

$reviews = array();
while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = $row;
}

foreach ($reviews as $review) {

 

    echo "<div class='review' style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
    echo "<p><strong>User:</strong> " . ($review['userName'] ? $review['userName'] : 'Anonymous') . "</p>";
    echo "<p><strong>Review:</strong> " . $review['reviewText'] . "</p>";
    echo "</div>";
}
?>
