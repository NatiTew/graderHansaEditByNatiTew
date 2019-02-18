<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('lpid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->lpid), array('view', 'id'=>$data->lpid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lesson_id')); ?>:</b>
	<?php echo CHtml::encode($data->lesson_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prob_id')); ?>:</b>
	<?php echo CHtml::encode($data->prob_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rank')); ?>:</b>
	<?php echo CHtml::encode($data->rank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit')); ?>:</b>
	<?php echo CHtml::encode($data->limit); ?>
	<br />


</div>
