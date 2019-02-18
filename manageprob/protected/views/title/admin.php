<?php
$this->breadcrumbs=array(
	'Titles'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
		array('label'=>Yii::t('app',
				'List Title'), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create Title'),
				'url'=>array('create')),
			);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('title-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1> Manage&nbsp;Titles</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'title-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'gender_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
