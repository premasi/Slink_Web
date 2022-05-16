$(() => {
  // Trigger Like dan Unlike
  $(".like_button").on("click", function () {
    let post_id = $(this).data("id");
    let $clicked_btn = $(this);

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
      error: function (errorMessage) {
        alert(errorMessage);
      },
    });
  });

  // Trigger Bookmark
  $(".bookmark_button").on("click", function () {
    let post_id = $(this).data("id");
    let $clicked_btn = $(this);
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
      error: function (errorMessage) {
        alert(errorMessage);
      },
    });
  });

  // Trigger Komentar
  $(".comment_button").on("click", function () {
    let post_id = $(this).data("id");
    $("#post_id").val(post_id);

    // Ajax untuk Menampilkan Komentar
    $.ajax({
      url: "async_home.php",
      method: "POST",
      data: {
        post_id: post_id,
        getComments: true,
      },
      crossDomain: true,
      success: function (data) {
        $(".modal-body").html(data);
      },
      error: function (errorMessage) {
        alert(errorMessage);
      },
    });

    // Trigger untuk Membuat Komentar
    $("#comment_form").on("submit", function (event) {
      event.preventDefault();
      var formData = $(this).serialize();
      console.log(formData);
      $.ajax({
        url: "async_home.php",
        method: "POST",
        data: formData,
        crossDomain: true,
        success: function (data) {
          $("#comment_form")[0].reset();
          $("#parent_comment_id").val("0");
          showComments(post_id);
        },
        error: function (errorMessage) {
          alert(errorMessage);
        },
      });
    });
  });

  $(document).on("click", ".reply", function () {
    let parent_comment_id = $(this).attr("id");
    $("#parent_comment_id").val(parent_comment_id);
    $("#comment").focus();
  });

  // Fungsi untuk Menampilkan Komentar
  function showComments(post_id) {
    $.ajax({
      url: "async_home.php",
      method: "POST",
      data: { getComments: true, post_id: post_id },
      success: function (data) {
        $(".modal-body").html(data);
      },
      error: function (errorMessage) {
        alert(errorMessage);
      },
    });
  }
});
