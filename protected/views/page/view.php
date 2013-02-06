<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="PageContent">
    <h1><?php echo $model->pageName ?></h1>

    <div class="content"><?php echo $model->pageContent ?></div>
<?php if (Yii::app()->user->id) { ?>
        <a href="<?php echo $this->createUrl('update', array('id'=>$model->id)); ?>">Edit this page </a>
    <?php } ?>

</div>