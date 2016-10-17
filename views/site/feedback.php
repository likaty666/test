<?php
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']])?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'email'); ?>
<?= $form->field($model, 'age')->input('number'); ?>
<?= $form->field($model, 'inn'); ?>
<?= $form->field($model, 'about')->textarea(); ?>
<?= $form->field($model,'file')->fileInput()?>
<?= \yii\helpers\Html::submitButton("Send")?>
<?php ActiveForm::end(); ?>
