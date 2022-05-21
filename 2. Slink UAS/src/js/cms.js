// Jquery Untuk Manipulasi Modal
$(() => {
  // Sesuaikan Modal Form untuk Keperluan Inset Data
  $("#trigger_createPost").click(function () {
    $("#modal_label").html("Tambah Data Post");
    $("#modal_button").attr("name", "submit_createPost");
    $("#modal_button").html("Submit");
    $("#id").val("");
    $("#user_id").val("");
    $("#judul").val("");
    $("#deskripsi").val("");
    $("#link").val("");
    $("#cat_title").val("");
  });

  // Sesuaikan Modal Form untuk Keperluan Update Data
  $(".trigger_updatePost").click(function () {
    let id = $(this).data("id");
    $("#modal_label").html("Update Data Post");
    $("#modal_button").attr("name", "submit_updatePost");
    $("#modal_button").html("Update");

    console.log(id);
    // AJAX untuk Get Data Mahasiswa Sesuai Id Tertentu
    $.ajax({
      url: "async_cms.php",
      data: { id: id },
      method: "POST",
      dataType: "JSON",
      crossDomain: true,
      success: function (data) {
        // Inisialisasi Form dalam Modal untuk di Update
        $("#id").val(data.id);
        $("#judul").val(data.judul);
        $("#deskripsi").val(data.deskripsi);
        $("#link").val(data.link);
        $("#cat_title").val(data.post_cat);
      },
    });
  });
});
