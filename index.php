<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

echo '<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; minimum-scale=1.0; maximum-scale=1.0">
    <title>' . (isset($_REQUEST["name"]) ? $_REQUEST["name"] . ' - ' : '') . '图片库 - By zgcwkj</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/zoomify.css" rel="stylesheet" type="text/css">
</head>
<body>
';
$go_Name = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
$go_FilePath = dirname(__FILE__) . '/img/' . $go_Name; //获取当前路径
$go_FilePath = iconv('UTF-8', 'GBK', $go_FilePath); //处理中文乱码问题
$go_Files = scandir($go_FilePath); //获取所有的文件
for ($i = 0; $i < count($go_Files); $i++) {
    $go_File = $go_Files[$i];
    if ($go_File == '.' || $go_File == '..' || strpos($go_File, '.php') || strpos($go_File, '.exe')) continue;
    $go_File = iconv('GBK', 'UTF-8',  $go_File);
    $go_File = $go_Name ? $go_Name . "/" . $go_File : $go_File;
    if (strpos($go_File, '.jpg') || strpos($go_File, '.jpeg') || strpos($go_File, '.png') || strpos($go_File, '.bmp')) {
        $html = "<img class='phpImg' height='200' src='img/" . $go_File . "' alt = '" . $go_File . "'>";
    } else {
        $html = "<div class='phpDiv'>";
        $html .= "<a href='index.php?name=" . $go_File . "' target='_blank'>" . $go_File . "</a>";
        $html .= "</div>";
    }
    echo $html;
}
echo '
    <footer>
        <p>本站图片由 <a href="http://www.mzitu.com/" target="_blank">妹子图</a> 提供，使用 <a href="http://blog.zgcwkj.cn/archives/854.html" target="_blank">MzituGrab</a> 程序采集</p>
        <p>Powered by <a href="http://blog.zgcwkj.cn/" target="_blank">zgcwkj</a></p>
    </footer>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/zoomify.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(".phpImg").zoomify();
    </script>
</body>
</html>
';
