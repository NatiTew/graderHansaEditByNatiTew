<?php
$this->breadcrumbs=array(
	'Genders'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Gender', 'url'=>array('index')),
	array('label'=>'Create Gender', 'url'=>array('create')),
	array('label'=>'Update Gender', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gender', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gender', 'url'=>array('admin')),
);
?>

<h1>View Gender #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>


<br /><h2> This Title belongs to this Gender: </h2>
<ul><?php foreach($model->titles as $foreignobj) { 

				printf('<li>%s</li>', CHtml::link($foreignobj->name, array('title/view', 'id' => $foreignobj->id)));

				} ?></ul><br /><h2> This Users belongs to this Gender: </h2>
<ul><?php foreach($model->users as $foreignobj) { 

				printf('<li>%s</li>', CHtml::link($foreignobj->username, array('users/view', 'id' => $foreignobj->id)));

				} ?></ul>