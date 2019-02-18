<?php
$this->breadcrumbs = array(
	'Titles',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Title', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Title', 'url'=>array('admin')),
);
?>

<h1>Titles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
