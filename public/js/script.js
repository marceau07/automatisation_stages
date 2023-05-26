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