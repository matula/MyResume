<?php
$files = [
'li' => 'http://developer.linkedin.com/sites/default/files/LinkedIn_Logo16px.png',
'tw' => 'http://i.imgur.com/nk29M.png',
'so' => 'http://i.imgur.com/ZgIqc.png',
'git' => 'http://i.imgur.com/kAs5X.png'
];
$mime = 'image/png';

foreach ($files as $k => $v) {
	echo $k  . '<br><br><textarea style="width: 200px">' . data_uri($v, $mime) . '</textarea><hr>';
}


function data_uri($file, $mime) {
    return "data:$mime;base64," . base64_encode(file_get_contents($file));
}
