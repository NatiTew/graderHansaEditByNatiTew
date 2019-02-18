<?php
$this->breadcrumbs=array(
	'Lesson Probs'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List LessonProb', 'url'=>array('index')),
	array('label'=>'Manage LessonProb', 'url'=>array('admin')),
);
?>

<h1> Create LessonProb </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lesson-prob-form',
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
