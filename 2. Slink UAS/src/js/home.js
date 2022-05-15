$(() => {
  $(".like_button").on("click", function () {
    var post_id = $(this).data("id");
    $clicked_btn = $(this);

    // Menentukan Aksi yang Dilakukan User
    if ($clicked_btn.hasClass("bi bi-heart")) {
      action = "like";
    } else if ($clicked_btn.hasClass("bi bi-heart-fill")) {
      action = "unlike";
    }

    //Ajax untuk Mengubah Tombol dan Manipulasi data Likes di DB Secara Async
    $.ajax({
      url: "async_home.php",
      data: {
        action: action,
        post_id: post_id,
      },
      method: "POST",
      crossDomain: true,
      success: function (data) {
        // Ubah Tombol Secara Real-Time
        if (action == "like") {
          $clicked_btn.removeClass("bi bi-heart");
          $clicked_btn.addClass("bi bi-heart-fill text-danger");
        } else if (action == "unlike") {
          $clicked_btn.removeClass("bi bi-heart-fill text-danger");
          $clicked_btn.addClass("bi bi-heart");
        }

        // Menampilkan Jumlah Like
        $clicked_btn.siblings("span.likes").html(`<span class='likes'>${data} Likes</span`);
      },
      error: function (jqXhr, textStatus, errorMessage) {
        alert(errorMessage);
      },
    });
  });

  $(".bookmark_button").on("click", function () {
    var post_id = $(this).data("id");
    $clicked_btn = $(this);
    if ($clicked_btn.hasClass("bi bi-bookmark")) {
      action = "mark";
    } else if ($clicked_btn.hasClass("bi bi-bookmark-fill")) {
      action = "unmark";
    }

    $.ajax({
      url: "async_home.php",
      data: {
        action: action,
        post_id: post_id,
      },
      method: "POST",
      crossDomain: true,
      success: function (data) {
        if (action == "mark") {
          $clicked_btn.removeClass("bi bi-bookmark");
          $clicked_btn.addClass("bi bi-bookmark-fill text-primary");
        } else if (action == "unmark") {
          $clicked_btn.removeClass("bi bi-bookmark-fill text-primary");
          $clicked_btn.addClass("bi bi-bookmark");
        }
      },
      error: function (jqXhr, textStatus, errorMessage) {
        alert(errorMessage);
      },
    });
  });
});
