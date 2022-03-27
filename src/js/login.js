//Masukan Data
var DataUsers = JSON.parse(localStorage.getItem("data-users"));

const login = (e) => {
     e.preventDefault();
     const logUser = {
        username: document.getElementById("floatingInput").value,
        pass: document.getElementById("floatingPassword").value 
    }

    console.log(logUser);

    let istrue = false;

    DataUsers.map((item) => {
        if(logUser.username == item.username && logUser.pass == item.pass){
            istrue = true;
            localStorage.setItem("log-user", JSON.stringify(item));
            window.location.href = "./cms.html";
        }
    })

    if(istrue === false){
        alert('Kamu siapa... aku siapa... kamu siapa... ibu siapa...')
    }

    console.log(newUser);
    if (DataUsers === null) {
      DataUsers = [];
      DataUsers.push(newUser);
      localStorage.setItem("data-users", JSON.stringify(DataUsers));
      document.location.reload();
    } else {
      DataUsers.push(newUser);
      localStorage.setItem("data-users", JSON.stringify(DataUsers));
      document.location.reload();
    }
  };
document.getElementById("submit_login").addEventListener("click", login);