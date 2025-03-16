<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="bg-gray-100 p-6 rounded-lg shadow-md">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <h2 class="text-2xl font-semibold mb-4">Advanced Search</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <?php echo $form->label($model, 'ID', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'id', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Title', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'title', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Content', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textArea($model, 'content', array('rows' => 3, 'class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Tags', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textArea($model, 'tags', array('rows' => 3, 'class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Status', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'status', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Created At', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'create_time', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Updated At', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'update_time', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

        <div>
            <?php echo $form->label($model, 'Author ID', array('class' => 'block text-sm font-medium text-gray-700')); ?>
            <?php echo $form->textField($model, 'author_id', array('class' => 'mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500')); ?>
        </div>

    </div>

    <div class="mt-6">
        <?php echo CHtml::submitButton('Search', array('class' => 'px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>