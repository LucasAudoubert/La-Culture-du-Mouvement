document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("contact-form");
  if (!form) return;

  const submit = document.querySelector(".contact-submit");
  const feedback = document.getElementById("contact-feedback");
  const textarea = document.getElementById("contact-message");
  const charCount = document.getElementById("contact-char");

  if (textarea && charCount) {
    textarea.addEventListener("input", function () {
      charCount.textContent = textarea.value.length;
    });
  }

  const ICONS = {
    send: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>`,
    spin: `<svg class="contact-spin" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>`,
    check: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>`,
    alert: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`,
  };

  let currentStatus = "idle";

  function setStatus(newStatus, message = "") {
    currentStatus = newStatus;
    if (feedback) {
      feedback.style.display = "none";
      feedback.className = "contact-feedback";
    }

    switch (newStatus) {
      case "loading":
        submit.disabled = true;
        submit.innerHTML = ICONS.spin + " Envoi en cours...";
        break;

      case "success":
        submit.disabled = false;
        submit.innerHTML = ICONS.check + " Message envoyé !";
        setTimeout(() => {
          window.location.href = "/";
        }, 2000);
        break;

      case "error":
        submit.disabled = false;
        submit.innerHTML = ICONS.send + " Envoyer le Message";
        if (feedback) {
          feedback.classList.add("contact-feedback--error");
          feedback.innerHTML = ICONS.alert + " " + message;
          feedback.style.display = "flex";
        }
        setTimeout(() => setStatus("idle"), 5000);
        break;

      case "idle":
      default:
        submit.disabled = false;
        submit.innerHTML = ICONS.send + " Envoyer le Message";
        break;
    }
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    if (currentStatus === "loading") return;

    const name = document.getElementById("contact-name").value.trim();
    const email = document.getElementById("contact-email").value.trim();
    const message = textarea ? textarea.value.trim() : "";
    const datetime = document.getElementById("contact-datetime").value;

    if (!name || !email || !message) {
      setStatus("error", "Veuillez remplir tous les champs obligatoires.");
      return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      setStatus("error", "Adresse email invalide.");
      return;
    }

    setStatus("loading");

    const formData = new FormData();
    formData.append("action", "send_contact");
    formData.append("nonce", contactConfig.nonce);
    formData.append("name", name);
    formData.append("email", email);
    formData.append("datetime", datetime);
    formData.append("subject", "Nouveau message de contact");
    formData.append("message", message);

    fetch(contactConfig.ajax_url, {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          setStatus("success", data.data.message);
          form.reset();
          if (charCount) charCount.textContent = "0";
        } else {
          throw new Error(data.data.message || "Une erreur s'est produite.");
        }
      })
      .catch((err) => {
        setStatus("error", err.message || "Une erreur s'est produite.");
      });
  });
});
