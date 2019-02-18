<?php
$this->breadcrumbs=array(
	'User Infos'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List UserInfo', 'url'=>array('index')),
	array('label'=>'Manage UserInfo', 'url'=>array('admin')),
);
?>

<h1> Create UserInfo </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-info-form',
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
