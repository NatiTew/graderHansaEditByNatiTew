<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passwd'); ?>
<?php echo $form->passwordField($model,'passwd',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'passwd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grp'); ?>
<?php echo $form->textField($model,'grp',array('size'=>40,'maxlength'=>40)); ?>
<?php echo $form->error($model,'grp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
<?php echo $form->textField($model,'type',array('size'=>1,'maxlength'=>1)); ?>
<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scid'); ?>
<?php echo $form->textField($model,'scid'); ?>
<?php echo $form->error($model,'scid'); ?>
	</div>


