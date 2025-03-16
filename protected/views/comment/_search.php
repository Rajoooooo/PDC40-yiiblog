<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="bg-gray-100 p-6 rounded-lg shadow-md">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <h2 class="text-2xl font-semibold mb-4">Search Comments</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <?php echo $form->label($model, 'ID', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'id', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Content', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textArea($model, 'content', array('rows' => 3, 'class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Status', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'status', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Created Time', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'create_time', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Author', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'author', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Email', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'email', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'URL', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'url', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Post ID', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'post_id', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

    </div>

    <div class="mt-6">
        <?php echo CHtml::submitButton('Search', array('class' => 'px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>