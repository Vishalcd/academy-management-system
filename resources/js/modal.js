const modal = document.querySelector("#modal");
const modalContainer = document.querySelector("#modal-container");

// hide modal
const hideModal = () => {
    // hide modal
    modal.classList.add("hidden");
    modal.classList.remove("flex");

    // clear modal content
    modalContainer.innerHTML = "";

    // clear hash url
    window.location.hash = ``;
};

["hashchange", "load"].forEach((event) => {
    window.addEventListener(event, function (e) {
        const hash = window.location.hash;

        if (!hash || hash === "#filter") return;

        // find content  with hash id
        const template = document.querySelector(hash);

        // load content from template
        const clone = template.content.cloneNode(true);

        // show modal
        modal.classList.remove("hidden");
        modal.classList.add("flex");

        // insert content
        modalContainer.innerHTML = "";
        modalContainer.appendChild(clone);

        modal
            .querySelector("#btn-close")
            .addEventListener("click", () => hideModal());

        window.addEventListener("keypress", (e) => {
            if (e.key === "Escape") hideModal;
        });

        document.addEventListener("click", (e) => {
            if (e.target === modal) hideModal();
        });

        document.querySelectorAll("#btn-cancel").forEach((btn) => {
            btn?.addEventListener("click", () => hideModal());
        });
    });
});
