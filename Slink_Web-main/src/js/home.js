var DataUsers = JSON.parse(localStorage.getItem("data-users"));

const showAllPosts = () => {
  let list = "";
  DataUsers.map((user) => {
    var DataPosts = JSON.parse(localStorage.getItem(`data-posts-${user.id}`));
    if (DataPosts !== null && DataPosts.length !== 0) {
      DataPosts.map((post) => {
        list += `<div class="col-sm-4 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">${post.judul}</h5>
            <p class="card-text">${post.deskripsi}</p>
            <div class="row">
                <a class="btn btn-primary col-5" href="${post.link}" target="_blank">Go Link</a>		
                <div class="col-1"></div>					
                <div class="d-grid gap-2 d-md-flex col-6 justify-content-end">
                  <p>By: ${user.username}</p>
                </div>
            </div>
          </div>
        </div>
      </div>`;
      });
    }
  });
  console.log(list);
  if (list !== null) {
    document.getElementById("postingan").innerHTML = list;
  } else {
    document.getElementById("postingan").innerHTML = '<h3 class="d-flex justify-content-center">Belum ada Post</h3>';
  }
};

// Trigger Tampilkan Data Ketika Page di Load
window.addEventListener("load", showAllPosts);
