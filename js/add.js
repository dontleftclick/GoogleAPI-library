$(document).ready(function() {
    var item, title, publisher, author, bookLink, bookImg;
    var outputList = document.getElementById("list-output");
    var bookUrl = "https://www.googleapis.com/books/v1/volumes?q=";
    var placeHldr = '<img src="https://via.placeholder.com/150"></img>';
    var searchData; 

    $("#search").click(function(){
        outputList.innerHTML = "";
        searchData = $("#search-box").val();

        if (searchData === "" || searchData === null) {
           displayError();
           console.log("")
        }
        else {
            $.ajax({
                url: bookUrl + searchData,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.totalItems === 0) {
                        alert("No results! Try again");
                    }
                    else {
                        
                        $(".book-list").css('visibility', 'visible');
                        displayResults(response);
                        $(".book-list")[0].scrollIntoView({ behavior: 'smooth' });
                        
                    }
                },
                error: function() {
                    alert("Something went wrong... <br>"+" Try again!");
                }
            });
        }
        $('#search-box').val("");
    });

    function displayResults(res) {
        var outputList = $("#list-output");
        outputList.empty(); // Clear previous results

        for(var i = 0; i < res.items.length; i++    ) {
            var item = res.items[i];
            var title = item.volumeInfo.title;
            var author = item.volumeInfo.authors ? item.volumeInfo.authors.join(', ') : 'Unknown Author';
            var publisher = item.volumeInfo.publisher ? item.volumeInfo.publisher : 'Unknown Publisher';
            var bookLink = 'book.php';
            var bookImg = item.volumeInfo.imageLinks ? item.volumeInfo.imageLinks.thumbnail : 'https://via.placeholder.com/150';

            // hold all info in the url
            var bookLink = 'book.php?title=' + encodeURIComponent(title) + '&author=' + encodeURIComponent(author) + '&publisher=' + encodeURIComponent(publisher) + '&image=' + encodeURIComponent(bookImg);

            var bookItem = $('<div class="col-md-6 mb-3"><div class="card"><div class="row g-0"><div class="col-md-4"><img src="' + bookImg + '" class="img-fluid rounded-start" alt="Book Cover"></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">' + title + '</h5><p class="card-text">Author: ' + author + '</p><p class="card-text">Publisher: ' + publisher + '</p><a href="' + bookLink + '" target="_blank" class="btn btn-primary">Read More</a></div></div></div></div></div>');

            if (i % 2 === 0) {
         
                var newRow = $('<div class="row"></div>');
                outputList.append(newRow);
            }
      
            outputList.append(bookItem);
        }
    }

});
