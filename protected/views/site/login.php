<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array('Login');

if (!Yii::app()->user->isGuest) {
    $redirectUrl = (Yii::app()->user->name === 'admin') ? array('admin/index') : array('post/index');
    $this->redirect($redirectUrl);
}
?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold mb-6">Login</h1>

        <p class="text-sm text-gray-600 mb-4">Please fill out the following form with your login credentials:</p>

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array('validateOnSubmit' => true),
        )); ?>

        <div class="mb-4">
            <?php echo $form->labelEx($model, 'username', array('class' => 'block text-gray-700')); ?>
            <?php echo $form->textField($model, 'username', array('class' => 'w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500')); ?>
            <?php echo $form->error($model, 'username', array('class' => 'text-red-500 text-sm mt-1')); ?>
        </div>

        <div class="mb-4">
            <?php echo $form->labelEx($model, 'password', array('class' => 'block text-gray-700')); ?>
            <?php echo $form->passwordField($model, 'password', array('class' => 'w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500')); ?>
            <?php echo $form->error($model, 'password', array('class' => 'text-red-500 text-sm mt-1')); ?>
            <p class="text-gray-500 text-sm mt-1">Hint: Use <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.</p>
        </div>

        <div class="mb-4">
            <?php echo $form->checkBox($model, 'rememberMe', array('class' => 'mr-2')); ?>
            <?php echo $form->label($model, 'rememberMe', array('class' => 'text-gray-700')); ?>
            <?php echo $form->error($model, 'rememberMe', array('class' => 'text-red-500 text-sm mt-1')); ?>
        </div>

        <div class="mt-6">
            <?php echo CHtml::submitButton('Login', array('class' => 'w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

<?php
if (isset($_POST['LoginForm'])) {
    $model->attributes = $_POST['LoginForm'];
    if ($model->validate() && $model->login()) {
        $redirectUrl = (Yii::app()->user->name === 'admin') ? array('admin/index') : array('post/index');
        $this->redirect($redirectUrl);
    }
}
?>