<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'lpid'); ?>
                <?php echo $form->textField($model,'lpid'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'lesson_id'); ?>
                <?php echo $form->textField($model,'lesson_id'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'prob_id'); ?>
                <?php echo $form->textField($model,'prob_id',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'active'); ?>
                <?php echo $form->textField($model,'active'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'rank'); ?>
                <?php echo $form->textField($model,'rank'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'limit'); ?>
                <?php echo $form->textField($model,'limit'); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
