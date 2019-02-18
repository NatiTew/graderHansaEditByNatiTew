<?php
$this->breadcrumbs = array(
	'Lessons',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Lessons', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Lessons', 'url'=>array('admin')),
);
?>

<h1>Lessons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
