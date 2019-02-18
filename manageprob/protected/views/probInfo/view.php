<?php
$this->breadcrumbs=array(
	'Prob Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProbInfo', 'url'=>array('index')),
	array('label'=>'Create ProbInfo', 'url'=>array('create')),
	array('label'=>'Update ProbInfo', 'url'=>array('update', 'id'=>$model->prob_id)),
	array('label'=>'Delete ProbInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->prob_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProbInfo', 'url'=>array('admin')),
);
?>

<h1>View ProbInfo #<?php echo $model->prob_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'prob_id',
		'name',
		'avail',
		'prob_order',
		'description',
	),
)); ?>


<br /><h2> This Lessons belongs to this ProbInfo: </h2>
<ul><?php foreach($model->lessons as $foreignobj) { 

				printf('<li>%s</li>', CHtml::link($foreignobj->name, array('lessons/view', 'id' => $foreignobj->id)));

				} ?></ul>