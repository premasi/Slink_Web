// localStorage.removeItem("data-posts");

// Ambil Data Dari Local
var Data = JSON.parse(localStorage.getItem("data-posts"));

// Tampilkan Data
const showData = (Data) => {
  let list = "";
  if (Data !== null && Data.length !== 0) {
    Data.map((item) => {
      list += `<div class="col-sm-4 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">${item.judul}</h5>
                <p class="card-text">${item.deskripsi}</p>
                <div class="row">
                    <a class="btn btn-primary col-5" href="${item.link}" target="_blank">Go Link</a>		
                    <div class="col-1"></div>					
                    <div class="d-grid gap-2 d-md-flex col-4">
                      <button class="btn btn-outline-danger " type="button" onClick="deletePost(${item.id})" id="delete">Delete</button>
                      <button class="btn btn-outline-success" type="button" onClick="updatePost(${item.id})" id="update"  data-bs-toggle="modal" data-bs-target="#updateDataModal">Update</button>
                    </div>
                </div>
              </div>
            </div>
          </div>`;
    });
    document.getElementById("list_posts").innerHTML = list;
  } else {
    document.getElementById("list_posts").innerHTML = '<h3 class="d-flex justify-content-center">Anda Belum Pernah Post</h3>';
  }
};

// Trigger Tampilkan Data Ketika Page di Load
window.addEventListener("load", showData(Data));

// Masukan Data
const insertPost = (e) => {
  e.preventDefault();
  const newPost = { id: Math.random(), judul: document.getElementById("insert_judul").value, deskripsi: document.getElementById("insert_deskripsi").value, link: document.getElementById("insert_link").value };
  console.log(newPost);
  if (Data === null) {
    Data = [];
    Data.push(newPost);
    localStorage.setItem("data-posts", JSON.stringify(Data));
    document.location.reload();
  } else {
    Data.push(newPost);
    localStorage.setItem("data-posts", JSON.stringify(Data));
    document.location.reload();
  }
};

// Trigger Masukan Data
document.getElementById("submit_insertData").addEventListener("click", insertPost);

// Hapus Data
const deletePost = (id) => {
  for (let i = 0; i < Data.length; i++) {
    if (Data[i].id === id) {
      Data.splice(i, 1);
    }
  }
  localStorage.setItem("data-posts", JSON.stringify(Data));
  document.location.reload();
};

// Trigger Masukan Data
document.getElementById("delete").addEventListener("click", deletePost);

// Update Data
const updatePost = (id) => {
  Data.map((item) => {
    if (item.id === id) {
      document.getElementById("update_judul").value = item.judul;
      document.getElementById("update_deskripsi").value = item.deskripsi;
      document.getElementById("update_link").value = item.link;
      document.getElementById("submit_updateData").addEventListener("click", (e) => {
        e.preventDefault();
        item.judul = document.getElementById("update_judul").value;
        item.deskripsi = document.getElementById("update_deskripsi").value;
        item.link = document.getElementById("update_link").value;
        localStorage.setItem("data-posts", JSON.stringify(Data));
        document.location.reload();
      });
    }
  });
};

// Trigger Update Data
document.getElementById("update").addEventListener("click", updatePost);

// Cari Data
const searchData = (e) => {
  if (document.getElementById("keyword").value === "" || document.getElementById("keyword").value === null) {
    document.location.reload();
  }
  let dataFiltered = Data.filter((item) => {
    return item.judul.includes(document.getElementById("keyword").value) || item.deskripsi.includes(document.getElementById("keyword").value) || item.link.includes(document.getElementById("keyword").value);
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
