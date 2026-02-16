<?php
// 定义要下载的文件名
$file = 'Custom.xaml';

// 获取当前脚本所在目录，并拼接完整路径
$path = __DIR__ . DIRECTORY_SEPARATOR . $file;

// 检查文件是否存在且可读
if (!file_exists($path) || !is_readable($path)) {
    http_response_code(404);
    die('文件不存在或无法访问。');
}

// 设置下载响应头
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream'); // 强制作为二进制流下载
header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Content-Length: ' . filesize($path));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');

// 清空输出缓冲区，防止额外输出干扰文件内容
if (ob_get_level()) {
    ob_end_clean();
}

// 读取文件并输出
readfile($path);
exit;
