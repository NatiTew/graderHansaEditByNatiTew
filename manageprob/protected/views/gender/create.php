<?php
$this->breadcrumbs=array(
	'Genders'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List Gender', 'url'=>array('index')),
	array('label'=>'Manage Gender', 'url'=>array('admin')),
);
?>

<h1> Create Gender </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gender-form',
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
