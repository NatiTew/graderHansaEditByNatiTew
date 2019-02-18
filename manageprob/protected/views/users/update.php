<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1> Update Users #<?php echo $model->id; ?> </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>true,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'ปรับปรุง')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
