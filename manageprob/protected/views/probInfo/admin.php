<?php
$this->breadcrumbs=array(
	'Prob Infos'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
		array('label'=>Yii::t('app',
				'List ProbInfo'), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create ProbInfo'),
				'url'=>array('create')),
			);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('prob-info-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1> Manage&nbsp;Prob Infos</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'prob-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'prob_id',
		'name',
		'avail',
		'prob_order',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
