let e = document.getElementById("successMsg");
if (e) {
    setTimeout(function(){ e.style.transform = "scale(1)" }, 1000);
    setTimeout(function () {
        e.style.transition = ".5s", e.style.transform = "scale(0)"
    }, 1e4);
    let t = document.getElementById("crossHide");
    t.addEventListener("click", () => {
        t.parentNode.style.transform = "scale(0)", t.parentNode.style.transition = ".5s"
    })
}
