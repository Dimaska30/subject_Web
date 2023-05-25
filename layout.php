<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <link href="https://unpkg.com/@csstools/normalize.css" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/e0fecb2f50.js" crossorigin="anonymous"></script>
    <?php if ($turn_on_search) {
        print '<script src="js/search.js" type="text/javascript"></script>';
    }
    ?>
    <?= $meta_tags; ?>
</head>

<body>
    <?= $header; ?>
    <?= $content; ?>
    <?= $footer; ?>
    <template id="template_article">
        <?= $template; ?>
    </template>
</body>

</html>