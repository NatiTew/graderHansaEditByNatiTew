<?php
$this->breadcrumbs = array(
	'Genders',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Gender', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Gender', 'url'=>array('admin')),
);
?>

<h1>Genders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
