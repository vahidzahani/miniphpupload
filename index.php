<!DOCTYPE html>
<html>
<head>
    <title>آپلود فایل</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: tahoma;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="submit"] {
            background-color: yellow;
        }

        @media only screen and (max-width: 600px) {
            /* استایل‌هایی که در صفحات با عرض کوچکتر از 600 پیکسل اعمال می‌شود */
            form {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <form action="index.php" method="POST" enctype="multipart/form-data">
       <input type="hidden" name="MAX_FILE_SIZE" value="50000000"> <!-- حداکثر اندازه مجاز فایل بر حسب بایت (این مقدار معادل 50 مگابایت است) -->
        <label for="file">فایل را انتخاب کنید:</label>
        <input type="file" name="file" id="file">
		<br>
        <input type="submit" value="آپلود" style="background-color: yellow;">
    </form>
	<hr>
	<h3>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDirectory = 'uploads/'; // مسیر ذخیره فایل آپلود شده
    $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)); // پسوند فایل آپلود شده
	$time=time();
    $fileName = $time . '.' . $fileExtension; // نام فایل جدید با استفاده از زمان فعلی و پسوند

    $targetFile = $targetDirectory . basename($fileName); // مسیر کامل فایل آپلود شده
    
    // بررسی آیا فایلی با همین نام در مسیر ذخیره وجود دارد یا خیر
    if (file_exists($targetFile)) {
        echo 'فایل با همین نام در حال حاضر وجود دارد.';
    } else {
        // آپلود فایل
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            echo 'فایل با موفقیت آپلود شد.<h1>کد ردگیری '.$time . '</h1>';
        } else {
            echo 'مشکلی در آپلود فایل رخ داد.';
        }
    }
}
#vahid.zahani@gmail.com
?>

</h3>

</body>
</html>


