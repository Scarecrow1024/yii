<?php

return [
    'urlManager'=>array(  
             'enablePrettyUrl' => true, //对url进行美化 
             'showScriptName' => false,//隐藏index.php   
             'suffix' => '.html',//后缀
             'enableStrictParsing'=>FALSE,//不要求网址严格匹配，则不需要输入rules
             'rules' => []//网址匹配规则
),
];
