function filterService(type) {
    let buttons = document.querySelectorAll(".filter-btn");
    buttons.forEach(btn => btn.classList.remove("active"));

    if (type === "argent") {
        buttons[0].classList.add("active");
        console.log("Filtre : Paiement en argent");
    } else {
        buttons[1].classList.add("active");
        console.log("Filtre : Échange de services");
    }
}
