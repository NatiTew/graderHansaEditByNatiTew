<?php
$this->breadcrumbs = array(
	'Lesson Probs',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' LessonProb', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' LessonProb', 'url'=>array('admin')),
);
?>

<h1>Lesson Probs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
