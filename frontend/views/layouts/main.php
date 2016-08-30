<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript" src="<?php echo Url::base() ?>/node_modules/angular/angular.min.js" ></script>
</head>
<body>

<?php $this->beginBody() ?>
   <?= $content ?>
<?= \dilden\feedbackwidget\DildenFeedback::widget(['ajaxURL' => 'pinneapple/feedback', 'highlightElement' => 0,]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
