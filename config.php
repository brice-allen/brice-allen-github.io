<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php print $PAGE_TITLE;?></title>

    <?php if ($CURRENT_PAGE == "Index") { ?>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
    <?php } ?>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.5.0/css/bootstrap.min.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #main-content {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 14px;
            text-align: center;
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-top: 20px;
        }
    </style>
</head>
