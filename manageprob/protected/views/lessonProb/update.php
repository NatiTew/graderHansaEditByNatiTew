<?php
$this->breadcrumbs=array(
	'Lesson Probs'=>array('index'),
	$model->lpid=>array('view','id'=>$model->lpid),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List LessonProb', 'url'=>array('index')),
	array('label'=>'Create LessonProb', 'url'=>array('create')),
	array('label'=>'View LessonProb', 'url'=>array('view', 'id'=>$model->lpid)),
	array('label'=>'Manage LessonProb', 'url'=>array('admin')),
);
?>

<h1> Update LessonProb #<?php echo $model->lpid; ?> </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
