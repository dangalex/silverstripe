<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'page-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <input type="hidden" name="id" value="<?php echo $model->id ?>" />
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'pageName'); ?>
        <?php echo $form->textField($model, 'pageName', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'pageName'); ?>
    </div>
 <div class="row">
        <?php echo $form->labelEx($model, 'isHomePage'); ?>
        <?php echo $form->checkBox($model, 'isHomePage', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'isHomePage'); ?>
    </div>

 <div class="row">
        <?php echo $form->labelEx($model, 'pageContent'); ?>
        <?php echo $form->textArea($model, 'pageContent', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'pageContent'); ?>
    </div>
<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>