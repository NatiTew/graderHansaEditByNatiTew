<?php
$this->breadcrumbs = array(
	'Prob Infos',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ProbInfo', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ProbInfo', 'url'=>array('admin')),
);
?>

<h1>Prob Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
