document.querySelectorAll("#mobile-nav").forEach((btn) => {
    if (!btn) return;

    btn.addEventListener("click", () => {
        document.getElementById("nav").classList.toggle("show");
    });
});
