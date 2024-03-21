function logout() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.href = "process_logout.php";
    }
  };
  xhr.open("GET", "process_logout.php", true);
  xhr.send();
}
function loadMoviesByGenre(genre) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = xhr.responseText;
      document.getElementById("movies-container").innerHTML = response;
    }
  };
  xhr.open("GET", "load_movies_genres.php?genre=" + genre, true);
  xhr.send();
}

function loadMoviesByCountry(country) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = xhr.responseText;
      document.getElementById("movies-container").innerHTML = response;
    }
  };
  xhr.open("GET", "load_movies_countries.php?country=" + country, true);
  xhr.send();
}
function searchMovies() {
  var contentTitle = document.getElementById("content-title");
  var searchInput = document.getElementById("search").value.trim();
  if (searchInput !== "") {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = xhr.responseText;
        document.getElementById("movies-container").innerHTML = response;
        contentTitle.innerHTML =
          'Kết quả tìm kiếm cho từ khóa "' + searchInput + '".';
        document.getElementById("search").value = "";
      }
    };
    xhr.open("GET", "search_movies.php?search=" + searchInput, true);
    xhr.send();
  } else {
    window.location.reload();
  }
}
function favoriteMovies() {
  var contentTitle = document.getElementById("content-title");
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = xhr.responseText;
      document.getElementById("movies-container").innerHTML = response;
      contentTitle.innerHTML = "Danh sách yêu thích";
    }
  };
  xhr.open("GET", "load_favorite_movies.php", true);
  xhr.send();
}
function historyMovies() {
  var contentTitle = document.getElementById("content-title");
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = xhr.responseText;
      document.getElementById("movies-container").innerHTML = response;
      contentTitle.innerHTML = "Lịch sử xem";
    }
  };
  xhr.open("GET", "load_history_movies.php", true);
  xhr.send();
}
function toggleFavorite() {
  var movieID = document.getElementById("movie_id").value;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        var response = xhr.responseText;
        if (response === "success_favorite") {
          document.getElementById("favorite-icon").classList.add("fas");
          document.getElementById("favorite-icon").classList.remove("far");
        } else if (response === "success_unfavorite") {
          document.getElementById("favorite-icon").classList.remove("fas");
          document.getElementById("favorite-icon").classList.add("far");
        } else {
          console.error("Lỗi không xác định: " + response);
        }
      } else {
        console.error("Lỗi kết nối: " + xhr.statusText);
      }
    }
  };
  xhr.open("POST", "favorite_movie.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("movie_id=" + movieID);
}
var selectedRating = 0;
function rateVideo(rating) {
  selectedRating = rating;
  var stars = document.querySelectorAll(".star");
  stars.forEach(function (star) {
    star.classList.remove("selected");
  });
  for (var i = 1; i <= rating; i++) {
    var star = document.querySelector(".star:nth-child(" + i + ")");
    star.classList.add("selected");
  }
  var movieID = document.getElementById("movie_id").value;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        var response = xhr.responseText;
        if (response === "success_rating") {
          console.log("Đã đánh giá thành công!");
        } else {
          console.error("Lỗi không xác định: " + response);
        }
      } else {
        console.error("Lỗi kết nối: " + xhr.statusText);
      }
    }
  };
  xhr.open("POST", "rate_movie.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("movie_id=" + movieID + "&rating=" + rating);
}
window.addEventListener("load", function () {
  var ratedStars = document.querySelectorAll(".star");
  if (ratedStars.length > 0) {
    selectedRating = ratedStars.length;
    var movieID = document.getElementById("movie_id").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          var response = xhr.responseText;
          if (response !== "no_rating") {
            selectedRating = parseInt(response);
            updateRatingInterface(selectedRating);
          }
        } else {
          console.error("Lỗi kết nối: " + xhr.statusText);
        }
      }
    };
    xhr.open("GET", "get_user_rating.php?movie_id=" + movieID, true);
    xhr.send();
  }
});
function updateRatingInterface(selectedRating) {
  var stars = document.querySelectorAll(".star");
  stars.forEach(function (star, index) {
    if (index < selectedRating) {
      star.classList.add("selected");
    } else {
      star.classList.remove("selected");
    }
  });
}
