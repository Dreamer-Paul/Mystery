let slider = document.querySelector(".slider-image img");
let bg = document.querySelector(".bg");
let btns = document.querySelectorAll(".slider-btn img");
let btn = document.querySelector(".btn");

btns.forEach((item) => {
    item.onmouseover = () => {
        slider.src = item.src;
        btn.href = item.dataset.url;
        bg.style.backgroundImage = "url(" + item.src + ")";
    }
})
