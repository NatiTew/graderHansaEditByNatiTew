<?php
$this->breadcrumbs=array(
	'Lesson Probs'=>array('index'),
	$model->lpid,
);

$this->menu=array(
	array('label'=>'List LessonProb', 'url'=>array('index')),
	array('label'=>'Create LessonProb', 'url'=>array('create')),
	array('label'=>'Update LessonProb', 'url'=>array('update', 'id'=>$model->lpid)),
	array('label'=>'Delete LessonProb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->lpid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LessonProb', 'url'=>array('admin')),
);
?>

<h1>View LessonProb #<?php echo $model->lpid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lpid',
		'lesson_id',
		'prob_id',
		'active',
		'rank',
		'limit',
	),
)); ?>


