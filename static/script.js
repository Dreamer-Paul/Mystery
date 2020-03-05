let obj = {
    bg: document.querySelector(".bg"),
    btn: document.querySelector(".slider-btn"),
    url: document.querySelector(".slider-action .btn"),
    room: document.querySelector(".image-room")
}

let items = [
    {
        url: "robot.html",
        img: "robot.jpg"
    },
    {
        url: "acgm.html",
        img: "acgm.jpg"
    },
    {
        url: "red-packet/index.html",
        img: "packet.jpg"
    },
    {
        url: "roll/index.html",
        img: "roll.jpg"
    },
    {
        url: "binkic.html",
        img: "binkic.jpg"
    },
    {
        url: "mole.html",
        img: "mole.jpg"
    }
];

// 生成对象
items.forEach((item, value) => {
    let newObj = document.createElement("img");
    newObj.src = "static/" + item.img;

    obj.room.appendChild(newObj);

    let newBtn = document.createElement("span");
    newBtn.innerHTML = `<img src="static/${item.img}"/>`;
    newBtn.onmouseover = () => {
        obj.btn.href = item.url;
        obj.room.style.transform = `translateX(-${(value) * 100}%)`;
        obj.bg.style.backgroundImage = "url(static/" + item.img + ")";
    }

    obj.btn.appendChild(newBtn);
});

let stat = {
    current: 0,
    count: items.length,
    transform: 100 / items.length
};
