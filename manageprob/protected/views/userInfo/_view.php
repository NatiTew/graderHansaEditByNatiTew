<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passwd')); ?>:</b>
	<?php echo CHtml::encode($data->passwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grp')); ?>:</b>
	<?php echo CHtml::encode($data->grp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scid')); ?>:</b>
	<?php echo CHtml::encode($data->scid); ?>
	<br />


</div>
