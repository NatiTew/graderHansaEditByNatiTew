<?php
$this->breadcrumbs=array(
	'Titles'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Title', 'url'=>array('index')),
	array('label'=>'Create Title', 'url'=>array('create')),
	array('label'=>'Update Title', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Title', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Title', 'url'=>array('admin')),
);
?>

<h1>View Title #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'gender.name',
	),
)); ?>


<br /><h2> This Users belongs to this Title: </h2>
<ul><?php foreach($model->users as $foreignobj) { 

				printf('<li>%s</li>', CHtml::link($foreignobj->username, array('users/view', 'id' => $foreignobj->id)));

				} ?></ul>