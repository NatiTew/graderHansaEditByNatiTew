<?php
$this->breadcrumbs=array(
	'Genders'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List Gender', 'url'=>array('index')),
	array('label'=>'Create Gender', 'url'=>array('create')),
	array('label'=>'View Gender', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gender', 'url'=>array('admin')),
);
?>

<h1> Update Gender #<?php echo $model->id; ?> </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
