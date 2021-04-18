<?php

/** @var $model \app\models\LoginForm */

use thecodeholic\phpmvc\form\Form;

?>

<h1>Login</h1>

<?php $form = Form::begin('', 'post') ?>
    <input type="text" name="name" id="name">
    <input type="text" name="password" id="password">
    <?php /*echo $form->field($model, 'email') */?><!--
    --><?php /*echo $form->field($model, 'password')->passwordField() */?>
    <button class="btn btn-success">Submit</button>
<?php Form::end() ?>