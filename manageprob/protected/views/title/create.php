<?php
$this->breadcrumbs=array(
	'Titles'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List Title', 'url'=>array('index')),
	array('label'=>'Manage Title', 'url'=>array('admin')),
);
?>

<h1> Create Title </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'title-form',
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
