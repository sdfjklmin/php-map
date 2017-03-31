<?php
# 路径跳转和时间设置
$conf = array(
	# jump
    'jump'=>[
        'request'=>'http://',
        'host'   =>'127.0.0.1',
        'dir'    =>'/Zin/time/index.php'
    ],
    # rest time
    'time'=>[
        'r'=> 1.5 ,  # rest
        't'=> 60 ,   # mine
    ],

);
# 对应的消息提示
$msg = [
    '哎,好累哦,该休息休息了',
    '眼睛累了,让它休息休息吧',
    '这么久了,起来走走吧',
    '起来起来,该上厕所了',
    '水开了,快去喝水',
    '休息是为了更好地工作',
    '不要看电脑了,电脑受不了了',
    '让电脑休息休息吧'
];
