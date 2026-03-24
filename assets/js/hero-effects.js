// 1. Cache les sélections (On ne cherche les éléments qu'une seule fois)
const girl = document.querySelector(".hero-parallax-girl");
const uiLeft = document.querySelector(".hero-content");
const uiRight = document.querySelector(".hero-visual");
const canvas = document.getElementById("hero-canvas");

let targetX = 0,
  targetY = 0;
let currentX = 0,
  currentY = 0;
const lerpFactor = 0.08; // Plus c'est bas, plus c'est fluide et "lourd"

// 2. Écouteur ultra-léger (juste pour récupérer les coordonnées)
document.addEventListener("mousemove", (e) => {
  targetX = window.innerWidth / 2 - e.pageX;
  targetY = window.innerHeight / 2 - e.pageY;
});

function updateHero() {
  currentX += (targetX - currentX) * lerpFactor;
  currentY += (targetY - currentY) * lerpFactor;

  if (uiLeft)
    uiLeft.style.transform = `translate(${currentX / 0}px, ${currentY / 0}px)`;
  if (uiRight)
    uiRight.style.transform = `translate(${currentX / 80}px, ${currentY / 80}px)`;
  if (girl)
    girl.style.transform = `translate(${currentX / 55}px, ${currentY / 55}px)`;
  if (canvas)
    canvas.style.transform = `translate(${currentX / 55}px, ${currentY / 55}px)`;

  if (canvas) {
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    particles.forEach((p) => {
      ctx.fillStyle = `rgba(255, 255, 255, ${p.opacity})`;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
      ctx.fill();

      p.x += p.speedX;
      p.y += p.speedY;

      if (p.x < -10) {
        p.x = canvas.width + 10;
        p.y = Math.random() * canvas.height;
      }
    });
  }

  requestAnimationFrame(updateHero);
}

// --- Init Particles ---
let particles = [];
const particleCount = 600;

function initCanvas() {
  if (!canvas) return;
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

window.addEventListener("resize", initCanvas);
initCanvas();
updateHero(); // On lance la boucle unique
