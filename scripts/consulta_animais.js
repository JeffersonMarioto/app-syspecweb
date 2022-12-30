const showAlert = document.getElementById("showAlert");
const tbody = document.querySelector("tbody");

// Fetch All Ins.s Ajax Request
const fetchAllAnimals = async () => {
  const data = await fetch("php/action_consulta_animais.php?read=1", {
    method: "GET",
  });
  const response = await data.text();
  tbody.innerHTML = response;
};
fetchAllAnimals();