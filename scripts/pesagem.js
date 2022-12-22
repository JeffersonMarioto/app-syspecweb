const addForm = document.getElementById("add-user-form");
const updateForm = document.getElementById("edit-user-form");
const showAlert = document.getElementById("showAlert");
const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
const editModal = new bootstrap.Modal(document.getElementById("editUserModal"));
const tbody = document.querySelector("tbody");

// Add New User Ajax Request
addForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(addForm);
  formData.append("add", 1);

  if (addForm.checkValidity() === false) {
    e.preventDefault();
    e.stopPropagation();
    addForm.classList.add("was-validated");
    return false;
  } else {
    document.getElementById("add-user-btn").value = "Please Wait...";

    const data = await fetch("php/action_pesagem.php", {
      method: "POST",
      body: formData,
    });
    const response = await data.text();
    showAlert.innerHTML = response;
    document.getElementById("add-user-btn").value = "Add Pesagem";
    addForm.reset();
    addForm.classList.remove("was-validated");
    addModal.hide();
    fetchAllUsers();
  }
});

// Fetch All Users Ajax Request
const fetchAllUsers = async () => {
  const data = await fetch("php/action_pesagem.php?read=1", {
    method: "GET",
  });
  const response = await data.text();
  tbody.innerHTML = response;
};
fetchAllUsers();

// Edit Pesagem Ajax Request
tbody.addEventListener("click", (e) => {
  if (e.target && e.target.matches("a.editLink")) {
    e.preventDefault();
    let idp = e.target.getAttribute("idp");
    editUser(idp);
  }
});

const editUser = async (idp) => {
  const data = await fetch(`php/action_pesagem.php?edit=1&idp=${idp}`, {
    method: "GET",
  });
  const response = await data.json();
  document.getElementById("idp").value = response.idp;
  document.getElementById("numero").value = response.numero;
  document.getElementById("data_atual").value = response.data_atual;
  document.getElementById("peso_atual").value = response.peso_atual;
  document.getElementById("peso_anterior").value = response.peso_anterior;
  document.getElementById("data_anterior").value = response.data_anterior;
  document.getElementById("resultado").value = response.resultado;
  document.getElementById("idade").value = response.idade;
  document.getElementById("media").value = response.media;
  document.getElementById("era").value = response.era;
};

// Update User Ajax Request
updateForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(updateForm);
  formData.append("update", 1);

  if (updateForm.checkValidity() === false) {
    e.preventDefault();
    e.stopPropagation();
    updateForm.classList.add("was-validated");
    return false;
  } else {
    document.getElementById("edit-user-btn").value = "Please Wait...";

    const data = await fetch("php/action_pesagem.php", {
      method: "POST",
      body: formData,
    });
    const response = await data.text();

    showAlert.innerHTML = response;
    document.getElementById("edit-user-btn").value = "Update";
    updateForm.reset();
    updateForm.classList.remove("was-validated");
    editModal.hide();
    fetchAllUsers();
  }
});

// Delete Pesagem Ajax Request
tbody.addEventListener("click", (e) => {
  if (e.target && e.target.matches("a.deleteLink")) {
    e.preventDefault();
    let idp = e.target.getAttribute("idp");
    deleteUser(idp);
  }
});

const deleteUser = async (idp) => {
  const data = await fetch(`php/action_pesagem.php?delete=1&idp=${idp}`, {
    method: "GET",
  });
  const response = await data.text();
  showAlert.innerHTML = response;
  fetchAllUsers();
};