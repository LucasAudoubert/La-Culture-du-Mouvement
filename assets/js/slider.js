document.addEventListener("DOMContentLoaded", function () {
  const wrapper = document.getElementById("slider-wrapper");
  const slides = document.querySelectorAll(".hero-slide");
  const dots = document.querySelectorAll("#hero-blog-slider .dot");

  if (!wrapper || slides.length <= 1) return;

  let currentSlide = 0;

  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;

    wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;

    dots.forEach((dot) => dot.classList.remove("active"));
    if (dots[currentSlide]) {
      dots[currentSlide].classList.add("active");
    }
  }, 2000);
});
