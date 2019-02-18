<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('prob_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->prob_id), array('view', 'id'=>$data->prob_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avail')); ?>:</b>
	<?php echo CHtml::encode($data->avail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prob_order')); ?>:</b>
	<?php echo CHtml::encode($data->prob_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>
