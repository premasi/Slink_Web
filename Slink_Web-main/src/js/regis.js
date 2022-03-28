// Import Data
var DataUsers = JSON.parse(localStorage.getItem("data-users"));

//registrasi User
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
    linked: document.getElementById("inputlinkedin").value,
  };

  console.log(newUser);
  if (DataUsers === null) {
    DataUsers = [];
    DataUsers.push(newUser);
    localStorage.setItem("data-users", JSON.stringify(DataUsers));
    document.location.href = "../src/Login.html";
  } else {
    DataUsers.push(newUser);
    localStorage.setItem("data-users", JSON.stringify(DataUsers));
    document.location.href = "../src/Login.html";
  }
};

// Trigger Registrasi User
document.getElementById("submit_user").addEventListener("click", Register);
