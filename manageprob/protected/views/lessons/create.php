<?php
$this->breadcrumbs=array(
	'Lessons'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List Lessons', 'url'=>array('index')),
	array('label'=>'Manage Lessons', 'url'=>array('admin')),
);
?>

<h1> Create Lessons </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Create')); ?>
</div>

<?php $this->endWidget(); ?>

</div>
