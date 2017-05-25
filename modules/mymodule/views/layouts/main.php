<?php use yii\helpers\Html; ?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="eng">
	<head>
		<meta charset="UTF-8"/>
		<?php echo Html::csrfMetaTas() ?>
		<title><?php echo Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body>
		<?php $this->beginBody() ?>
		<?php echo $content ?>
		<?php $this->endBody() ?>
		<?php ?>
	</body>
</html>
<?php $this->endPage() ?>
