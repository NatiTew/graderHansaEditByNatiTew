<?php
$this->breadcrumbs = array(
	'User Infos',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' UserInfo', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' UserInfo', 'url'=>array('admin')),
);
?>

<h1>User Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
