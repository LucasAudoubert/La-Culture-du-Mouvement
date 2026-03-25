document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".tab-btn");
  const panes = document.querySelectorAll(".tab-pane");

  buttons.forEach((btn) => {
    btn.addEventListener("click", function () {
      const target = this.getAttribute("data-target");

      buttons.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");

      panes.forEach((pane) => {
        pane.classList.remove("active");
        if (pane.id === target) {
          pane.classList.add("active");
        }
      });

      // CORRECTIF : Si on clique sur l'onglet planning, on force le recalcul
      if (target === "tab-calendar") {
        window.dispatchEvent(new Event("resize"));
      }
    });
  });
});
