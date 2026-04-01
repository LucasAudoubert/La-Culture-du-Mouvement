document.addEventListener("DOMContentLoaded", function () {
  const wrapper = document.getElementById("slider-wrapper");
  const slides = document.querySelectorAll(".hero-slide");
  const dots = document.querySelectorAll("#hero-blog-slider .dot");

<<<<<<< style
=======
  // On vérifie que le slider existe sur la page avant de lancer le code
>>>>>>> main
  if (!wrapper || slides.length <= 1) return;

  let currentSlide = 0;

  setInterval(() => {
<<<<<<< style
    currentSlide = (currentSlide + 1) % slides.length;

    wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;

=======
    // Calcul du prochain slide
    currentSlide = (currentSlide + 1) % slides.length;

    // Déplacement du wrapper
    wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;

    // Mise à jour de la couleur des points
>>>>>>> main
    dots.forEach((dot) => dot.classList.remove("active"));
    if (dots[currentSlide]) {
      dots[currentSlide].classList.add("active");
    }
  }, 2000);
});
