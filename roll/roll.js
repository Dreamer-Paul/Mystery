var body = ks.select(".wrap");
var wrap = ks.select(".row");

// 被抽奖的大佬们
var text = [
    "小但",
    "一飞冲车王",
    "BWmelon",
    "soulmate",
    "伳影",
    "萌新",
    "七越",
    "惶心",
    "不朽千秋",
    "Taskeren",
    "Whitiy"
];

// 三个奖项的列表
var group = {
    f: [],
    s: [],
    t: []
};

// 三个奖项抽的人数
var info = {
    f: 1,
    s: 2,
    t: 5
};

// 随机数
function rand(min, max) {
    return Math.floor(Math.random() * (Math.floor(parseInt(min)) - parseInt(max))) + Math.ceil(max);
}

(function () {
    var res_1 = rand(0, text.length);
    var box_1 = ks.create("div", {
        class: "col-m-4",
        child: [
            ks.create("h2", {
                class: "group",
                text: "一等奖获得者是："
            }),
            ks.create("span", {
                class: "group-item",
                text: text[res_1]
            })
        ]
    });

    text.splice(res_1, 1);
    wrap.appendChild(box_1);

    // 二等奖
    var box_2 = ks.create("div", {
        class: "col-m-4",
        html: "<h2 class='group'>二等奖获得者有：</h2>"
    });

    for(var j = 0; j < info.s; j++){
        var res_2 = rand(0, text.length);
        box_2.appendChild(ks.create("span", {class: "group-item", text: text[res_2]}));
        text.splice(res_2, 1);
    }

    wrap.appendChild(box_2);

    // 三等奖
    var box_3 = ks.create("div", {
        class: "col-m-4",
        html: "<h2 class='group'>三等奖获得者有：</h2>"
    });

    for(var k = 0; k < info.t; k++){
        var res_3 = rand(0, text.length);
        box_3.appendChild(ks.create("span", {class: "group-item", text: text[res_3]}));
        text.splice(res_3, 1);
    }

    wrap.appendChild(box_3);

})();