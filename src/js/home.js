var DataPost = JSON.parse(localStorage.getItem("data-posts"));

const showDataPost = (DataPost) => {
    let html = "";
    if (DataPost !== null && Data.length !== 0) {
        DataPost.map((item) => {
        list +=`<div class="card" style="width:400px">
            <div class="card-body">
            <h4 class="card-title">${item.judul}</h4>
            <p class="card-text">${item.deskripsi}</p>
            <a href="#" class="btn btn-primary" href="${item.link}">See Posting</a>
            </div>
        </div>`;
      });
      document.getElementById("postingan").innerHTML = list;
    } else {
      document.getElementById("postingan").innerHTML = '<h3 class="d-flex justify-content-center">Belum ada Post</h3>';
    }
  };
  
  // Trigger Tampilkan Data Ketika Page di Load
  window.addEventListener("load", showDataPost(DataPost));