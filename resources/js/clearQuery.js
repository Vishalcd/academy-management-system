function clearUrlQueries() {
    const baseUrl = window.location.origin + window.location.pathname;
    history.pushState(null, "", baseUrl);
    location.reload();
}
document.querySelectorAll("#filter-box #btn-cancel")?.forEach((btn) => {
    btn.addEventListener("click", clearUrlQueries);
});
