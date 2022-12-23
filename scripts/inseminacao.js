const addForm = document.getElementById("add-user-form");
const updateForm = document.getElementById("edit-user-form");
const showAlert = document.getElementById("showAlert");
const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
const editModal = new bootstrap.Modal(document.getElementById("editUserModal"));
const tbody = document.querySelector("tbody");

// Add New Ins. Ajax Request
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

    const data = await fetch("php/action_inseminacao.php", {
      method: "POST",
      body: formData,
    });
    const response = await data.text();
    showAlert.innerHTML = response;
    document.getElementById("add-user-btn").value = "Add";
    addForm.reset();
    addForm.classList.remove("was-validated");
    addModal.hide();
    fetchAllUsers();
  }
});

// Fetch All Ins.s Ajax Request
const fetchAllUsers = async () => {
  const data = await fetch("php/action_inseminacao.php?read=1", {
    method: "GET",
  });
  const response = await data.text();
  tbody.innerHTML = response;
};
fetchAllUsers();

// Edit Ins Ajax Request
tbody.addEventListener("click", (e) => {
  if (e.target && e.target.matches("a.editLink")) {
    e.preventDefault();
    let idi = e.target.getAttribute("idi");
    editUser(idi);
  }
});

const editUser = async (idi) => {
  const data = await fetch(`php/action_inseminacao.php?edit=1&idi=${idi}`, {
    method: "GET",
  });
  const response = await data.json();
  document.getElementById("idi").value = response.idi;
  document.getElementById("vaca").value = response.vaca;
  document.getElementById("touro").value = response.touro;
  document.getElementById("data_inseminacao").value = response.data_inseminacao;
  document.getElementById("estacao").value = response.estacao;
  document.getElementById("diagnostico").value = response.diagnostico;
};

// Update Ins. Ajax Request
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

    const data = await fetch("php/action_inseminacao.php", {
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

// Delete User Ajax Request
tbody.addEventListener("click", (e) => {
  if (e.target && e.target.matches("a.deleteLink")) {
    e.preventDefault();
    let idi = e.target.getAttribute("idi");
    deleteUser(idi);
  }
});

const deleteUser = async (idi) => {
  const data = await fetch(`php/action_inseminacao.php?delete=1&idi=${idi}`, {
    method: "GET",
  });
  const response = await data.text();
  showAlert.innerHTML = response;
  fetchAllUsers();
};