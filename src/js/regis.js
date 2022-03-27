// Masukan Data
var DataUsers = JSON.parse(localStorage.getItem("data-users"));

// const login = (e) => {
//     e.preventDefault();
//     const logUser = {
//         username: document.getElementById("floatingInput").value,
//         pass: document.getElementById("floatingPassword").value 
//     }

//     console.log(logUser);

//     DataUsers.map((item) => {
//         if(logUser.username == item.username && logUser.pass == item.pass){
//             window.location.href = "../cms.html";
//         } else {
//             alert("Kamu siapa... aku siapa... kamu siapa.....")
//         }
//     })


    // console.log(newUser);
    // if (DataUsers === null) {
    //   DataUsers = [];
    //   DataUsers.push(newUser);
    //   localStorage.setItem("data-users", JSON.stringify(DataUsers));
    //   document.location.reload();
    // } else {
    //   DataUsers.push(newUser);
    //   localStorage.setItem("data-users", JSON.stringify(DataUsers));
    //   document.location.reload();
    // }
//   };
// document.getElementById("submit_login").addEventListener("click", login);

//masukin data register user
const Register = (e) => {
    e.preventDefault();
    const newUser = { 
        id: Math.random(),
        nama: document.getElementById("inputnama1").value, 
        namab: document.getElementById("inputnama2").value, 
        laki: document.getElementById("jenisk1").value,
        perempuan: document.getElementById("jenisk2").value,
        telp: document.getElementById("inputTelp").value,
        prof: document.getElementById("inputProfesi").value,
        username: document.getElementById("inputUsername").value,
        pass: document.getElementById("inputPassword").value,
        linked: document.getElementById("inputlinkedin").value
    };

    console.log(newUser);
    if (DataUsers === null) {
      DataUsers = [];
      DataUsers.push(newUser);
      localStorage.setItem("data-users", JSON.stringify(DataUsers));
      //document.location.reload();
      document.location.href = "../src/Login.html";
    } else {
      DataUsers.push(newUser);
      localStorage.setItem("data-users", JSON.stringify(DataUsers));
      //document.location.reload();
      document.location.href = "../src/Login.html";

    }
  };

//nulis data
document.getElementById("submit_user").addEventListener("click", Register);