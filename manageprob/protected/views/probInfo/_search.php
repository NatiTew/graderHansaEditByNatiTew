<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'prob_id'); ?>
                <?php echo $form->textField($model,'prob_id',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'avail'); ?>
                <?php echo $form->textField($model,'avail',array('size'=>1,'maxlength'=>1)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'prob_order'); ?>
                <?php echo $form->textField($model,'prob_order'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>300)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
