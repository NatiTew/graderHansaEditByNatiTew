<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lesson_id'); ?>
<?php echo $form->textField($model,'lesson_id'); ?>
<?php echo $form->error($model,'lesson_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prob_id'); ?>
<?php echo $form->textField($model,'prob_id',array('size'=>20,'maxlength'=>20)); ?>
<?php echo $form->error($model,'prob_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
<?php echo $form->textField($model,'active'); ?>
<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rank'); ?>
<?php echo $form->textField($model,'rank'); ?>
<?php echo $form->error($model,'rank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit'); ?>
<?php echo $form->textField($model,'limit'); ?>
<?php echo $form->error($model,'limit'); ?>
	</div>


