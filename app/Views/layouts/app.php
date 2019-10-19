<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/news">News</a></li>
        </ul>

        <div class="content">
            <?php $this->getContent(); ?>
        </div>
    </div>
</body>
</html>