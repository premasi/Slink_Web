// Import Data
var DataUsers = JSON.parse(localStorage.getItem("data-users"));
var DataLog = JSON.parse(localStorage.getItem("log-user"));

// Cek Login atau Belum
if (DataLog === null) {
  document.location.href = "../index.html";
}

// Menampilkan Post dari Semua User
const showAllPosts = () => {
  let list = "";
  let list_comment = [];
  let temp_postid = [];

  DataUsers.map((user) => {
    var DataPosts = JSON.parse(localStorage.getItem(`data-posts-${user.id}`));
    if (DataPosts !== null && DataPosts.length !== 0) {
      DataPosts.map((post) => {
        list += `<div class="media border p-3 mb-3 shadow">
        <div class="media-body">
          <h2>${post.judul}</h2>
          <h5><span style="color: #45625D;">by</span> ${user.username}</h5>
          <a class="btn col-1 mt-1 mb-1 shadow" href="${post.link}" style="background-color:#6aa5a9; color: white;" target="_blank">Go Link</a>
          <p class="mt-1 mb-1">${post.deskripsi}</p>
          <div class="row mt-2">
            <div class="col-2">
              <input type="text" class="form-control" id="comment_penulis-${post.id}" placeholder="nama..." />
            </div>
            <div class="col-4">
              <input type="text" class="form-control" id="comment_deskripsi-${post.id}" placeholder="komentar..." />
            </div>
            <button type="button" class="btn btn-outline-primary col-2" id="submit_comment" onClick="addComment(${post.id})">Kirim</button>
          </div>
          <div class="row">
            <div class="col-8">
              <table class="table mt-3">
                <thead class="table-dark table-responsive">
                  <tr>
                    <th>Nama</th>
                    <th>Komentar</th>
                  </tr>
                </thead>
                <tbody id="komentar-${post.id}">
              
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>`;
        temp_postid.push(post.id);
        if (post.comment !== null && post.comment.length !== 0) {
          let temp_comment = "";
          post.comment.map((item) => {
            temp_comment += `
              <tr>
                <td>${item.penulis}</td>
                <td>${item.deskripsi}</td>
              </tr>
              `;
          });
          console.log(temp_comment);
          list_comment.push(temp_comment);
        }
      });
    }
  });

  if (list !== null && list !== "") {
    document.getElementById("postingan").innerHTML = list;
    for (let i = 0; i < temp_postid.length; i++) {
      if (list_comment.length !== 0) {
        document.getElementById(`komentar-${temp_postid[i]}`).innerHTML = list_comment[i];
      }
    }
  } else {
    document.getElementById("postingan").innerHTML = '<h4 class="d-flex justify-content-center">Sayang sekali masih belum ada info :( </h4><br><br><h4 class="d-flex justify-content-center">Ayo share info terbaru</h4>';
  }
};

// Trigger Tampilkan Data Ketika Page di Load
window.addEventListener("load", showAllPosts);

// LogOut
const logout = (e) => {
  localStorage.removeItem("log-user");
};

// Trigger LogOut
document.getElementById("logout").addEventListener("click", logout);

// buat komentar
const addComment = (id) => {
  newComment = {
    penulis: document.getElementById(`comment_penulis-${id}`).value,
    deskripsi: document.getElementById(`comment_deskripsi-${id}`).value,
  };

  DataUsers.map((user) => {
    var DataPosts = JSON.parse(localStorage.getItem(`data-posts-${user.id}`));
    if (DataPosts !== null && DataPosts.length !== 0) {
      DataPosts.map((post) => {
        if (post.id === id) {
          post.comment.push(newComment);
          localStorage.setItem(`data-posts-${user.id}`, JSON.stringify(DataPosts));
          document.location.reload();
        }
      });
    }
  });
};
