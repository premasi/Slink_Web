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
  DataUsers.map((user) => {
    var DataPosts = JSON.parse(localStorage.getItem(`data-posts-${user.id}`));
    if (DataPosts !== null && DataPosts.length !== 0) {
      DataPosts.map((post) => {
        list += `
        <div class="media border p-3 mb-3 shadow">
        <div class="media-body">
          <h2>${post.judul}</h2>
          <h5><span style="color: #45625D;">by</span> ${user.username}</h5>
          <a class="btn col-1 mt-1 mb-1 shadow" href="${post.link}" style="background-color:#6aa5a9; color: white;" target="_blank">Go Link</a>
          <p class="mt-1 mb-1">${post.deskripsi}</p>
        </div>
      </div>`;
      });
    }
  });
  console.log(list);
  if (list !== null && list !== "") {
    document.getElementById("postingan").innerHTML = list;
  } else {
    document.getElementById("postingan").innerHTML = '<pre><h4 class="d-flex justify-content-center">Sayang sekali masih belum ada info :( </h4></pre><br><br><pre><h4 class="d-flex justify-content-center">Ayo share info terbaru</h4></pre>';
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
