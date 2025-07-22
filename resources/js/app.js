import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".ripple").forEach((el) => {
    el.addEventListener("click", function (e) {
      const circle = document.createElement("span");
      const rect = el.getBoundingClientRect();
      circle.classList.add("ripple");
      circle.style.left = `${e.clientX - rect.left}px`;
      circle.style.top = `${e.clientY - rect.top}px`;
      el.appendChild(circle);

      setTimeout(() => {
        circle.remove();
      }, 600);
    });
  });
});
