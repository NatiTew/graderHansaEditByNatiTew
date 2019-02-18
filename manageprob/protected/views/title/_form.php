<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
			</div>


<label for="Gender">Belonging Gender</label><?php 
					$this->widget('application.components.Relation', array(
							'model' => $model,
							'relation' => 'gender',
							'fields' => 'name',
							'allowEmpty' => true,
							'style' => 'dropdownlist',
							)
						); ?>
			