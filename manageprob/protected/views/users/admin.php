<?php
$this->breadcrumbs=array(
	'Users'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
		array('label'=>Yii::t('app',
				'List Users'), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create Users'),
				'url'=>array('create')),
			);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('users-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1> Manage&nbsp;Users</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
//		'password',
		'name',
		'surname',
		'email',
		/*
		'gender_id',
		'title_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
