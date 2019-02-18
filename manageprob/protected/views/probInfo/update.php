<?php
$this->breadcrumbs=array(
	'Prob Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->prob_id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List ProbInfo', 'url'=>array('index')),
	array('label'=>'Create ProbInfo', 'url'=>array('create')),
	array('label'=>'View ProbInfo', 'url'=>array('view', 'id'=>$model->prob_id)),
	array('label'=>'Manage ProbInfo', 'url'=>array('admin')),
);
?>

<h1> Update ProbInfo #<?php echo $model->prob_id; ?> </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
