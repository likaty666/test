<?php
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'email'); ?>
<?= \yii\helpers\Html::submitButton("Send")?>
<?php ActiveForm::end(); ?>
