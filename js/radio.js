const dots = document.querySelectorAll(".dot");
const labelDotsTemp = document.querySelectorAll(".radio-group label");
const labelDots = [];

labelDotsTemp.forEach((dot) => {
  if (!dot.classList.contains("dot")) {
    labelDots.push(dot);
  }
});

dots.forEach((dot) => {
  dot.addEventListener("click", () => {
    if (document.querySelector(".active")) {
      document.querySelector(".active").classList.remove("active");
    }
    dot.classList.add("active");
  });
});

labelDots.forEach((label) => {
  label.addEventListener("click", () => {
    if (document.querySelector(".active")) {
      document.querySelector(".active").classList.remove("active");
    }
    label.previousElementSibling.previousElementSibling.classList.add("active");
  });
});
