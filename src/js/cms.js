// Import Data Auth
var DataLog = JSON.parse(localStorage.getItem("log-user"));

// Cek Login Atau Belum
if (DataLog === null) {
  document.location.href = "../index.html";
}

// Import Data Posts sesuai User yang Login
var DataPosts = JSON.parse(localStorage.getItem(`data-posts-${DataLog.id}`));

// Tampilkan Data di CMS
const showData = (Data) => {
  let html = "";
  if (Data !== null && Data.length !== 0) {
    Data.map((post) => {
      html += `<div class="col-sm-4 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">${post.judul}</h5>
                <p class="card-text">${post.deskripsi}</p>
                <div class="row">
                    <a class="btn btn-primary col-5" href="${post.link}" target="_blank">Go Link</a>		
                    <div class="col-1"></div>					
                    <div class="d-grid gap-2 d-md-flex col-4">
                      <button class="btn btn-outline-danger " type="button" onClick="deletePost(${post.id})" id="delete">Delete</button>
                      <button class="btn btn-outline-success" type="button" onClick="updatePost(${post.id})" id="update"  data-bs-toggle="modal" data-bs-target="#updateDataModal">Update</button>
                    </div>
                </div>
              </div>
            </div>
          </div>`;
    });
    document.getElementById("list_posts").innerHTML = html;
  } else {
    document.getElementById("list_posts").innerHTML = '<h3 class="d-flex justify-content-center">Anda Belum Pernah Post</h3>';
  }
};

// Trigger Tampilkan Data di CMS
window.addEventListener("load", showData(DataPosts));

// Tambah Data Post
const insertPost = (e) => {
  e.preventDefault();
  const newPost = { id: Math.random(), judul: document.getElementById("insert_judul").value, deskripsi: document.getElementById("insert_deskripsi").value, link: document.getElementById("insert_link").value };
  console.log(newPost);
  if (DataPosts === null) {
    DataPosts = [];
    DataPosts.push(newPost);
    localStorage.setItem(`data-posts-${DataLog.id}`, JSON.stringify(DataPosts));
    document.location.reload();
  } else {
    DataPosts.push(newPost);
    localStorage.setItem(`data-posts-${DataLog.id}`, JSON.stringify(DataPosts));
    document.location.reload();
  }
};

// Trigger Tambah Data Post
document.getElementById("submit_insertData").addEventListener("click", insertPost);

// Hapus Data Post
const deletePost = (id) => {
  for (let i = 0; i < DataPosts.length; i++) {
    if (DataPosts[i].id === id) {
      DataPosts.splice(i, 1);
    }
  }
  localStorage.setItem(`data-posts-${DataLog.id}`, JSON.stringify(DataPosts));
  document.location.reload();
};

// Trigger Hapus Data Post
document.getElementById("delete").addEventListener("click", deletePost);

// Update Data Post
const updatePost = (id) => {
  console.log(id);
  DataPosts.map((post) => {
    if (post.id === id) {
      document.getElementById("update_judul").value = post.judul;
      document.getElementById("update_deskripsi").value = post.deskripsi;
      document.getElementById("update_link").value = post.link;
      document.getElementById("submit_updateData").addEventListener("click", (e) => {
        e.preventDefault();
        post.judul = document.getElementById("update_judul").value;
        post.deskripsi = document.getElementById("update_deskripsi").value;
        post.link = document.getElementById("update_link").value;
        localStorage.setItem(`data-posts-${DataLog.id}`, JSON.stringify(DataPosts));
        document.location.reload();
      });
    }
  });
};

// Trigger Update Data Post
document.getElementById("update").addEventListener("click", updatePost);

// Cari Data Post yang Mirip dengan Keyword
const searchData = (e) => {
  if (document.getElementById("keyword").value === "" || document.getElementById("keyword").value === null) {
    document.location.reload();
  }
  let dataFiltered = DataPosts.filter((post) => {
    return post.judul.includes(document.getElementById("keyword").value) || post.deskripsi.includes(document.getElementById("keyword").value) || post.link.includes(document.getElementById("keyword").value);
  });
  if (dataFiltered !== null && dataFiltered.length !== 0) {
    showData(dataFiltered);
  } else {
    document.getElementById("list_posts").innerHTML = '<h3 class="d-flex justify-content-center">Data Tidak Ditemukan</h3>';
  }
  e.preventDefault();
};

// Trigger Cari Data
document.getElementById("submit_keyword").addEventListener("click", searchData);

// LogOut
const logout = (e) => {
  localStorage.removeItem("log-user");
};

// Trigger LogOut
document.getElementById("logout").addEventListener("click", logout);
