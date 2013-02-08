<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'page-form',
        'enableClientValidation' => true,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <input type="hidden"  id='id' name="id" value="<?php echo $model->id ?>" />
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
<script type='text/javascript'>
    
  
     $(function(){
                    
        bindEvent();
      
       
    });
    function bindEvent(){
        $('#Page_pageName').bind('blur', function(){
            //ajax call to validate email already existed or not
            $.ajax({
               dataType:'JSON',
                type:'get',
                success: function(data) {                    
                    if(data['exists']){
                       $('#Page_pageName_em_').html('Page name exists');                        
                       $('#Page_pageName_em_').attr('style', 'dislay:block;');
                    } else {
                        $('#Page_pageName_em_').html('');                        
                       $('#Page_pageName_em_').attr('style', 'dislay:none;');
                    }                    
                }, 
                beforeSend:function() {     
                    //waiting show up
                },
                url:"<?php echo Yii::app()->getBaseUrl(true);?>?r=page/checkName",                
                data: {'name':$('#Page_pageName').val(), 'id':$('#id').val()}
                
            });
        });
    }
</script>
