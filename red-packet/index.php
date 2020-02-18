<?php
error_reporting(0);

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($_GET['love'] && $_GET['works'] && $_GET['avatar']){
    $status = 2;
    
	$love = test_input($_GET['love']);
	$works = strtolower(test_input($_GET['works']));
	$avatar = strtolower(test_input($_GET['avatar']));
	
	$check_works = preg_match("/single|主题|模板|单身/", $works);
	$check_avatar = preg_match("/akari|阿卡林|灯里/", $avatar);
	
	if($love == "妹子" && $check_works && $check_avatar){
		$check = true;
	}
}
else if($_GET['love'] || $_GET['works'] || $_GET['avatar']){
    $status = 1;
}
else{
    $status = 0;
}

if($status == 0){
	$text = array("title" => "祝你新年快乐", "text" => "奇趣保罗 敬上！", "btn" => "开");
}
else if($status == 1){
	$text = array("title" => "未完成！", "text" => "请点击重新填写内容", "btn" => "重填");
}
else if($status == 2){
	if($check){
		$text = array("title" => "答对了！", "text" => "请点击这里获取奖励吧", "btn" => "开");
	}
	else{
		$text = array("title" => "不对哦！", "text" => "你回答的内容不正确哦，再想想吧！", "btn" => "重填");
	}
}

$ip = $_SERVER['REMOTE_ADDR'];
$time = date("Y-m-d H:i:s");
$file = fopen("save.txt","a+");
fwrite($file, str_pad($ip, 15, " ", 1)." ".$time." ".$love." ".$works." ".$avatar."\n");
fclose($file);

?>
<!DOCTYPE html>
<html lang="zh-cmn-hans">
<head>
    <meta charset="UTF-8">
    <title>保罗送你红包啦~</title>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1"/>
    <style>
        *{
            box-sizing: border-box;
        }

        html{
            width: 100%;
            height: 100%;
            display: table;
        }

        body{
            margin: 0;
            display: table-cell;
            vertical-align: middle;
            font: lighter 16px "微软雅黑";
            background: url(memphis.png) center fixed;
        }

        h1, h2, h3{
            font-weight: lighter;
        }

        img{
            height: auto;
            max-width: 100%;
        }

        input, select{
            width: 100%;
            border: none;
            padding: .5em;
            outline: none;
            font: inherit;
            display: block;
            border-radius: .25em;
        }

        .red-packet{
            color: #fff;
            padding: 1em;
            max-width: 25em;
            min-height: 35em;
            margin: 2em auto;
            overflow: hidden;
            position: relative;
            border-radius: 1em;
            background: #c40b00;
            transition: font-size .3s;
            animation: red-packet .75s both cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        @media screen and (max-width: 768px){
            .red-packet{
                font-size: .8em;
            }
        }

        .red-packet header{
            top: -14.5em;
            left: 0;
            right: 0;
            width: 100%;
            height: 25em;
            position: absolute;
            border-radius: 100%;
            background: #b00b00;
        }
        .red-packet img{
            left: 0;
            right: 0;
            bottom: -2em;
            margin: auto;
            max-width: 5em;
            position: absolute;
            border-radius: 100%;
            border: .25em solid #fff;
        }

        .red-packet main{
            padding: 0 3em;
            margin-top: 15em;
            text-align: center;
        }
        .red-packet .author{
            opacity: .7;
        }
        .red-packet .open{
            outline: 0;
            width: 3em;
            height: 3em;
            border: none;
            color: #362f19;
            display: block;
            font-size: 2em;
            cursor: pointer;
            margin: 1em auto;
            background: #ebcd97;
            border-radius: 100%;
            transition: background .3s, transform .3s;
        }
        .red-packet .open:hover{
            transform: scale(1.1);
        }
        .red-packet .open:active{
            background: #d7ba86;
        }

        .red-packet .open.active{
            animation: rotate .2s infinite alternate;
        }

        @keyframes red-packet{
            from{
                opacity: 0;
                transform: scale(0);
            }
            to{
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes rotate{
            from{
                transform: scaleX(1);
            }
            to{
                transform: scaleX(0);
            }
        }

    </style>
</head>
<body>
<div class="red-packet">
    <header>
        <img src="avatar.jpg"/>
    </header>
    <main>
        <h1><?php echo $text["title"]; ?></h1>
        <p class="author"><?php echo $text["text"]; ?></p>
        <button class="open"><?php echo $text["btn"]; ?></button>
    </main>
</div>

<script>
    var button = document.getElementsByClassName("open")[0];

    button.onclick = function () {
        button.className = "open active";
        setTimeout(function () {
<?php if($check): ?>
			location.href = "https://paul.ren";
<?php else: ?>
            var main = document.getElementsByTagName("main")[0];
            main.innerHTML = "<form action=\"index.php\">\n" +
                "<p>我喜欢什么？</p>\n" +
                "<select title=\"我喜欢什么\" name=\"love\">\n" +
                "<option>汉子</option>\n" +
                "<option>妹子</option>\n" +
                "</select>\n" +
                "<p>我目前最火的作品是什么？</p>\n" +
                "<input type=\"text\" name=\"works\" placeholder=\"回答：\"/>\n" +
                "<p>我曾用过哪个二次元妹子的头像？</p>\n" +
                "<input type=\"text\" name=\"avatar\" placeholder=\"回答：\"/>\n" +
                "<button class=\"open\" type=\"submit\">提交</button>\n" +
                "</form>";
<?php endif; ?>
        }, 1500);
    };
</script>

</body>
</html>