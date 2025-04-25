let menu = document.querySelector("#menu-icon");
let navbar = document.querySelector(".navbar");

menu.addEventListener("click", () => {
    menu.classList.toggle("bx-x");
    navbar.classList.toggle("active");

    // Ngăn cuộn khi menu mở
    if (navbar.classList.contains("active")) {
        document.body.style.overflow = "hidden";
    } else {
        document.body.style.overflow = "auto";
    }
});

// Khi cuộn trang, chỉ đóng menu nếu nó đang mở
window.addEventListener("scroll", () => {
    if (navbar.classList.contains("active")) {
        menu.classList.remove("bx-x");
        navbar.classList.remove("active");
        document.body.style.overflow = "auto"; // Cho phép cuộn lại
    }
});
