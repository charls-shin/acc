<?php

use app\core\form\Form;

?>

<h1>Register</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'name') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
    <?php echo $form->field($model, 'email')->emailField() ?>
    <button class="btn btn-success">Submit</button>
<?php Form::end() ?>
