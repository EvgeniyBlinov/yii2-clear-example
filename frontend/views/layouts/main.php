<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

//$this->beginPage();
$this->title = 'title'; 

$revisionContent = @file_get_contents(\Yii::getAlias('@webroot') . '/static/js/revision.js');

$revision = '';
if (!empty($revisionContent)) {
    preg_match('~APP_VERSION\s*=\s*(?<revision>[\d]+)~', $revisionContent, $matches);
    if (!empty($matches['revision'])) {
        $revision = $matches['revision'];
    }
}
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php
    $currentRoute = (substr(Yii::$app->requestedRoute, 0, 1) == '/') ? Yii::$app->requestedRoute : '/' . Yii::$app->requestedRoute;
?>
<body data-url="<?= $currentRoute ?>">
    <!-- Page Content -->
    <section id="page">
        <?php echo $content; ?>
    </section>

    <!-- Footer -->
    <footer>
    </footer>


    <script src="/static/vendor/bower/requirejs/require.js"></script>
    <script src="/static/js/main.js?<?= $revision ?>"></script>

</body>
</html>
