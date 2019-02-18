<?php
$this->breadcrumbs=array(
	'User Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->user_id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List UserInfo', 'url'=>array('index')),
	array('label'=>'Create UserInfo', 'url'=>array('create')),
	array('label'=>'View UserInfo', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage UserInfo', 'url'=>array('admin')),
);
?>

<h1> Update UserInfo #<?php echo $model->user_id; ?> </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
