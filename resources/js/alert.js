const alert = document.getElementById("alert");

setTimeout(function () {
    if (!alert) return;
    alert.remove();
}, 5000);
