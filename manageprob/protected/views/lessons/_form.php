<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'Lessons[date]',
								 //'language'=>'de',
								 'value'=>$model->date,
								 'htmlOptions'=>array('size'=>10, 'style'=>'width:80px !important'),
									 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,                                      
									 'changeYear'=>true,
									 ),
								 )
							 );
					; ?>
<?php echo $form->error($model,'date'); ?>
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


<label for="ProbInfo">Belonging ProbInfo</label><?php 
					$this->widget('application.components.Relation', array(
							'model' => $model,
							'relation' => 'probInfos',
							'fields' => 'name',
							'allowEmpty' => false,
							'style' => 'checkbox',
							)
						); ?>
			