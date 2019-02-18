<?php
$this->breadcrumbs=array(
	'Lessons'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Lessons', 'url'=>array('index')),
	array('label'=>'Create Lessons', 'url'=>array('create')),
	array('label'=>'Update Lessons', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lessons', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lessons', 'url'=>array('admin')),
);
?>

<h1>View Lessons #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'date',
		'active',
		'rank',
	),
)); ?>


<br /><h2> This ProbInfo belongs to this Lessons: </h2>
<ul><?php foreach($model->probInfos as $foreignobj) { 

				printf('<li>%s</li>', CHtml::link($foreignobj->name, array('probinfo/view', 'id' => $foreignobj->id)));

				} ?></ul>