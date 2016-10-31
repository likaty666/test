<?php

use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin()?>

    <?= $form->field($comments, 'name'); ?>
    <?= $form->field($comments, 'comment'); ?>
    <?= \yii\helpers\Html::submitButton("Send")?>
<?php \yii\widgets\ActiveForm::end()?>

<!--
<h4>First Name : <?= $comments->name?><br></h4>
<h4>Comment : <?= $comments->comment?><br></h4>
    <ul>

        <?php foreach ($comments as $c) :?>
            <li><?= $c->name." : ".$c->comment?></li>
        <? endforeach;?>
    </ul>

-->
