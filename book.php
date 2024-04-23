<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Website</title>
    <style>       
       body {
           margin: 0;
           padding: 0;
           font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
           background-color: #f5f5f5; 
       }

    
       ul {
           list-style-type: none;
           margin: 0;
           padding: 0;
           overflow: hidden;
           background-color: #333;
       }

       li {
           float: left;
       }

       li a {
           display: block;
           color: white;
           text-align: center;
           padding: 14px 16px;
           text-decoration: none;
           transition: background-color 0.3s ease;
       }

       li a:hover {
           background-color: #111; 
       }
       .button {
       background-color: #04AA6D; /* Green */
       border: none;
       color: white;
       padding: 8px 16px;
       text-align: center;
       text-decoration: none;
       display: inline-block;
       font-size: 16px;
       margin: 4px 2px;
       transition-duration: 0.4s;
       cursor: pointer;
       font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   }

       .button1 {
       background-color: white;
       color: black;
       border: 2px solid #555555;
 }
   
       .button1:hover {
       background-color: #555555;
       color: white;
       }
   
    </style>
</head>

<body>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li style="float:right"><a href="#about">About</a></li>
    </ul>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <img src="" class="card-img-top" alt="Book Cover">
                    <div class="card-body">
                        <h2 class="card-title" id="bookTitle"></h2>
                        <p class="card-text" id="bookAuthor"></p>
                        <p class="card-text" id="bookPublisher"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="submitReview.php?title=<?php echo urlencode($_GET['title']); ?>&author=<?php echo urlencode($_GET['author']); ?>&publisher=<?php echo urlencode($_GET['publisher']); ?>&image=<?php echo urlencode($_GET['image']); ?>" method="post">
        <div class="row" id="reviewSection">
            <div class="col-md-6 offset-md-3">
                <div class="review-box">
                    <input id="reviewName" name="userName" type="text" class="review-input" placeholder="Your Name">
                    <textarea id="reviewText" name="reviewText" class="review-input" placeholder="Write your review..."></textarea>
                    <button type="submit" class="submit-btn" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row " id="thanksSection" style="display:none;">
        <div class="col-md-6 offset-md-3 text-center" style="text-align: center; justify-content: center;">
            <p>Thanks for your input!</p>
            
        </div>
    </div>
    <div class="col-md-6 offset-md-3 text-center" style="text-align: center; justify-content: center;">
        <button class="button button1" onclick="toggleReviews()">read other reviews</button>
    </div>

    <div id="reviewsSection" style="display:none;">
        <?php include_once("displayReview.php"); ?>
    </div>


    <script>
         function toggleReviews() {
        var reviewsSection = document.getElementById("reviewsSection");
        if (reviewsSection.style.display === "none") {
            reviewsSection.style.display = "block";
        } else {
            reviewsSection.style.display = "none";
        }
    }
        function getQueryParams() {
            var params = {};
            var queryString = window.location.search.substring(1);
            var pairs = queryString.split("&");
            for (var i = 0; i < pairs.length; i++) {
                var pair = pairs[i].split("=");
                params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
            }
            return params;
        }

        function displayBookDetails() {
            var queryParams = getQueryParams();
            document.getElementById("bookTitle").textContent = queryParams["title"];
            document.getElementById("bookAuthor").textContent = "Author: " + queryParams["author"];
            document.getElementById("bookPublisher").textContent = "Publisher: " + queryParams["publisher"];
            document.querySelector(".card-img-top").src = queryParams["image"];
        }

        window.onload = displayBookDetails;
        
    </script>
</body>
<link rel="stylesheet" type="text/css" href="reviewformat.css">
<link rel="stylesheet" type="text/css" href="css/book.css">

</html>
