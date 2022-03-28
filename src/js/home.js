var User = JSON.parse(localStorage.getItem("data-users"));
//var DataPost = JSON.parse(localStorage.getItem("data-posts"));

const showDataUser = (User) => {
    let list = "";
    User.map((item) => {
        var DataPost = JSON.parse(localStorage.getItem(`data-posts-${item.id}`));
        if (DataPost !== null && Data.length !== 0) {
            DataPost.map((items) => {
            list +=`<div class="card" style="width:400px">
                <div class="card-body">
                <h4 class="card-title">${items.judul}</h4>
                <p class="card-text">${items.deskripsi}</p>
                <a href="#" class="btn btn-primary" href="${items.link}">See Posting</a>
                </div>
                </div>`;
          });

        }
        if(list !== null){
            document.getElementById("postingan").innerHTML = list;
        } else {
            document.getElementById("postingan").innerHTML = '<h3 class="d-flex justify-content-center">Belum ada Post</h3>';
        }
});
}
    
  
  // Trigger Tampilkan Data Ketika Page di Load
  window.addEventListener("load", showDataPost(DataPost));