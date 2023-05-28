const modals = document.querySelectorAll('[data-modal]');

modals.forEach(function (trigger) {
  trigger.addEventListener('click', function (event) {
    event.preventDefault();
    const modal = document.getElementById(trigger.dataset.modal);
    modal.classList.add('open');
    const exits = modal.querySelectorAll('.modal-exit');
    exits.forEach(function (exit) {
      exit.addEventListener('click', function (event) {
        event.preventDefault();
        modal.classList.remove('open');
      });
    });
  });
});

async function recupererDonnees() {
    var formData = new FormData();
    formData.append('recupererDonnees', 1);

    await fetch("../src/c/c_requetes.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.json())
        .then((result) => {
            document.getElementById("tables-stages").innerHTML = result;
        });

}

recupererDonnees();