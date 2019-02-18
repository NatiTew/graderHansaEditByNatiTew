<?php
$this->breadcrumbs=array(
	'Titles'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List Title', 'url'=>array('index')),
	array('label'=>'Create Title', 'url'=>array('create')),
	array('label'=>'View Title', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Title', 'url'=>array('admin')),
);
?>

<h1> Update Title #<?php echo $model->id; ?> </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->