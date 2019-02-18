<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'user_id'); ?>
                <?php echo $form->textField($model,'user_id',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'passwd'); ?>
                <?php echo $form->passwordField($model,'passwd',array('size'=>10,'maxlength'=>10)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'grp'); ?>
                <?php echo $form->textField($model,'grp',array('size'=>40,'maxlength'=>40)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'type'); ?>
                <?php echo $form->textField($model,'type',array('size'=>1,'maxlength'=>1)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'scid'); ?>
                <?php echo $form->textField($model,'scid'); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
