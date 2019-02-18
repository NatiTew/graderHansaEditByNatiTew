<?php
$this->breadcrumbs=array(
	'Prob Infos'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List ProbInfo', 'url'=>array('index')),
	array('label'=>'Manage ProbInfo', 'url'=>array('admin')),
);
?>

<h1> Create ProbInfo </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prob-info-form',
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
