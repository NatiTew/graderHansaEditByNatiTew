<?php
$this->breadcrumbs=array(
	'Lessons'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List Lessons', 'url'=>array('index')),
	array('label'=>'Create Lessons', 'url'=>array('create')),
	array('label'=>'View Lessons', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Lessons', 'url'=>array('admin')),
);
?>

<h1> Update Lessons #<?php echo $model->id; ?> </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lessons-form',
	'enableAjaxValidation'=>true,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
