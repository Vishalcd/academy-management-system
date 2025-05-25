document.querySelectorAll("#filter")?.forEach((btn) => {
    btn?.addEventListener("click", function (e) {
        const filterBox = document.querySelector("#filter-box");
        filterBox.classList.toggle("hidden");

        document.addEventListener("click", function (e) {
            console.log(e.target.classList.contains("#filter-box"));
        });
    });
});
