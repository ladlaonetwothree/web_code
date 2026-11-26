document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("menuToggle");
  const nav = document.getElementById("navLinks");
  if (toggle && nav) toggle.addEventListener("click", () => nav.classList.toggle("open"));
  document.querySelectorAll(".alert").forEach(el => {
    setTimeout(() => { el.style.opacity = "0"; }, 4200);
  });
});
