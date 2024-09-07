<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar</title>
</head>
<body>
    <h2>Upload Gambar untuk OCR</h2>
    <form action="<?php echo site_url('ocr/process_image'); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <button type="submit">Konversi Gambar</button>
    </form>
</body>
</html>
