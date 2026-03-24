document.addEventListener("mousemove", function (e) {
  const girl = document.querySelector(".hero-parallax-girl");
  const uiLeft = document.querySelector(".hero-content");
  const uiRight = document.querySelector(".hero-visual");
  const canvas = document.getElementById("hero-canvas");

  const centerX = window.innerWidth / 2;
  const centerY = window.innerHeight / 2;

  const mouseX = centerX - e.pageX;
  const mouseY = centerY - e.pageY;

  if (uiLeft)
    uiLeft.style.transform = `translate(${mouseX / 100}px, ${mouseY / 100}px)`;
  if (uiRight)
    uiRight.style.transform = `translate(${mouseX / 100}px, ${mouseY / 100}px)`;
  if (girl)
    girl.style.transform = `translate(${mouseX / 75}px, ${mouseY / 75}px)`;
  if (canvas)
    canvas.style.transform = `translate(${mouseX / 75}px, ${mouseY / 75}px)`;
});

const canvas = document.getElementById("hero-canvas");
if (canvas) {
  const ctx = canvas.getContext("2d");
  let particles = [];
  const particleCount = 200;

  function init() {
    canvas.width = window.innerWidth * 1.1;
    canvas.height = window.innerHeight * 1.1;
    particles = [];
    for (let i = 0; i < particleCount; i++) {
      particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        size: Math.random() * 1.5 + 0.5,
        speedX: (Math.random() * 0.5 + 0.2) * -1,
        speedY: Math.random() * 0.2 - 0.1,
        opacity: Math.random() * 0.5 + 0.1,
      });
    }
  }

  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach((p) => {
      ctx.fillStyle = `rgba(255, 255, 255, ${p.opacity})`;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
      ctx.fill();
      p.x += p.speedX;
      p.y += p.speedY;
      if (p.x < -10) p.x = canvas.width + 10;
    });
    requestAnimationFrame(animate);
  }

  window.addEventListener("resize", init);
  init();
  animate();
}
