/* Create Statut */
document.addEventListener("DOMContentLoaded", function() {
  let openCreateStatusModalBtn = document.getElementById(
    "openCreateStatusModalBtn"
  );
  let createStatusModal = document.getElementById("createStatusModal");
  let closeBtn = createStatusModal.querySelector(".close");

  function openCreateStatusModal() {
    createStatusModal.style.display = "block";
  }

  function closeCreateStatusModal() {
    createStatusModal.style.display = "none";
  }
  openCreateStatusModalBtn.addEventListener("click", openCreateStatusModal);
  closeBtn.addEventListener("click", closeCreateStatusModal);
  window.addEventListener("click", function(event) {
    if (event.target == createStatusModal) {
      closeCreateStatusModal();
    }
  });
});
/* Create Priorite */
document.addEventListener("DOMContentLoaded", function() {
  let openCreatePrioriteModalBtn = document.getElementById(
    "openCreatePrioriteModalBtn"
  );
  let createPrioritesModal = document.getElementById("createPrioritesModal");
  let closeBtn = createPrioritesModal.querySelector(".close");

  function openCreatePrioritesModal() {
    createPrioritesModal.style.display = "block";
  }

  function closeCreatePrioritesModal() {
    createPrioritesModal.style.display = "none";
  }
  openCreatePrioriteModalBtn.addEventListener("click", openCreatePrioritesModal);
  closeBtn.addEventListener("click", closeCreatePrioritesModal);
  window.addEventListener("click", function(event) {
    if (event.target == createPrioritesModal) {
      closeCreatePrioritesModal();
    }
  });
});

