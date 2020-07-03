<?php
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);

$charset = \Yii::$app->charset;
$hostname = \Yii::$app->request->hostInfo; // Need to check vulnerability

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= $charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Yuri Somin">
    <meta name="description" content="Test task...">
    <meta name="keywords" content="One, Two, Three...">    
    <link href="<?= $hostname ?>" rel="canonical">

    <?php $this->registerCsrfMetaTags() ?>

    <title>
        <?= Html::encode($this->title) ?>
    </title>

    <style>
        body {
            width: 100%; 
            margin: 0px;
        }
    </style>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

    <header>
    <?php
    //============================
    // NAV
    //============================
    echo $this->render('./main/nav.php');
    //============================
    ?>
    </header>


    <!--
    //============================
    // CONTENT
    //============================
    -->
    <div>
        <?= $content ?>
    </div>
    <!--
    //============================
    -->


    <footer id="footer">
        <div>
            <p>&copy; Yuri Somin <?= date('Y') ?></p>
        </div>
    </footer>



    <script src="/build/js/lib/jquery-3.5.1.min.js" defer></script>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
