$(() => {
  getComments($("#post_id").val());

  // Trigger untuk Membuat Komentar
  $("#comment_form").on("submit", function (event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    var formData = $(this).serialize();

    $.ajax({
      url: "async_post.php",
      method: "POST",
      data: formData,
      crossDomain: true,
      success: function (data) {
        $("#comment_form")[0].reset();
        $("#parent_comment_id").val("0");
        getComments($("#post_id").val());
      },
      error: function (errorMessage) {
        alert(errorMessage);
      },
    });
  });

  // Trigger Melakukan Reply Pada Komentar
  $(document).on("click", ".reply", function () {
    let parent_comment_id = $(this).attr("id");
    $("#parent_comment_id").val(parent_comment_id);
    $("#comment").focus();
  });

  // Fungsi untuk Menampilkan Komentar
  function getComments(post_id) {
    $.ajax({
      url: "async_post.php",
      method: "POST",
      data: { getComments: true, post_id: post_id },
      success: function (data) {
        $("#comments").html(data);
      },
      error: function (errorMessage) {
        alert(errorMessage);
      },
    });
  }
});
