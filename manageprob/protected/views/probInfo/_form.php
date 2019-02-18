<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avail'); ?>
<?php echo $form->textField($model,'avail',array('size'=>1,'maxlength'=>1)); ?>
<?php echo $form->error($model,'avail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prob_order'); ?>
<?php echo $form->textField($model,'prob_order'); ?>
<?php echo $form->error($model,'prob_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>300)); ?>
<?php echo $form->error($model,'description'); ?>
	</div>


<label for="Lessons">Belonging Lessons</label><?php 
					$this->widget('application.components.Relation', array(
							'model' => $model,
							'relation' => 'lessons',
							'fields' => 'name',
							'allowEmpty' => false,
							'style' => 'checkbox',
							)
						); ?>
			