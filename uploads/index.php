<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
    <meta charset="UTF-8">
</head>
<body style="font-family:tahoma">

	<hr>

<?php

if(isset($_GET['filedelete'])) {
    $fileName = $_GET['filedelete'];
    $filePath = './' . $fileName;
    
    if(file_exists($filePath)) {
        if(unlink($filePath)) {
            echo "فایل $fileName با موفقیت حذف شد.";
        } else {
            echo "خطا در حذف فایل $fileName.";
        }
    } else {
        echo "فایل $fileName وجود ندارد.";
    }
}



$directory = './'; // مسیر پوشه فعلی

// گرفتن لیست فایل‌ها در پوشه فعلی
$files = scandir($directory);

// حذف . و ..
$files = array_diff($files, array('.', '..'));

// نمایش جدول فایل‌ها
echo '<table border=1>';
echo '<tr><th>نام فایل</th><th>سایز (بایت)</th><th>زمان ایجاد</th><th>عملیات</th></tr>';

foreach ($files as $file) {
    // بررسی نام فایل
    if ($file === 'index.php' || $file === 'delete.php') {
        continue; // نادیده گرفتن فایل
    }

    $filePath = $directory . $file;
    $fileSize = filesize($filePath);
    $fileCreationTime = filectime($filePath);

    echo '<tr>';
    echo '<td><a href="' . $filePath . '" target="_blank">' . $file . '</a></td>';
    echo '<td>' . $fileSize . '</td>';
    echo '<td>' . date("Y-m-d H:i:s", $fileCreationTime) . '</td>';
    echo '<td><button onclick="deleteFile(\'' . $file . '\')" style="background-color: red;">حذف</button></td>';
    echo '</tr>';
}

echo '</table>';
	echo '<h2><a href="/.." >Upload</a></h2>';

?>

<script>
function deleteFile(fileName) {
    if (confirm('آیا از حذف فایل مطمئن هستید؟')) {
        window.location.href = 'index.php?filedelete=' + fileName; // فرستادن درخواست حذف به فایل delete.php
    }
}
</script>



</body>
</html>