document.addEventListener("DOMContentLoaded", function () {
  const burger = document.getElementById("burger-menu");
  const nav = document.getElementById("header-right");
  const links = document.querySelectorAll(".main-nav a");

  if (burger && nav) {
    burger.addEventListener("click", function () {
      burger.classList.toggle("active");
      nav.classList.toggle("active");
      document.body.classList.toggle("no-scroll");
    });

    links.forEach((link) => {
      link.addEventListener("click", function () {
        burger.classList.remove("active");
        nav.classList.remove("active");
        document.body.classList.remove("no-scroll");
      });
    });
  }
});
