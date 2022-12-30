const addForm = document.getElementById("add-user-form");
const showAlert = document.getElementById("showAlert");
const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
const tbody = document.querySelector("tbody");
const tbody2 = document.querySelector("animais");


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

    const data = await fetch("php/action_consulta_diagnostico.php", {
      method: "POST",
      body: formData,
    });
    const response = await data.text();
    tbody.innerHTML = response;

    document.getElementById("add-user-btn").value = "Buscar";
    addForm.reset();
    addForm.classList.remove("was-validated");
    addModal.hide();
  }
});
