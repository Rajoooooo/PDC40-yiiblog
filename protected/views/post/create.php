<?php
/* @var $this PostController */
/* @var $model Post */

Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
Yii::app()->clientScript->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 to-gray-300">
    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-4xl">

        <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">Create a New Post</h1>

        <div class="flex justify-center">
            <div class="w-full max-w-3xl">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'post-form',
                    'enableAjaxValidation' => false,
                )); ?>

                <p class="text-sm text-gray-600 mb-6">Fields marked with <span class="text-red-500">*</span> are required.</p>

                <?php echo $form->errorSummary($model, '<div class="text-red-600 mb-6">', '</div>'); ?>

                <div class="grid grid-cols-2 gap-8">

                    <div class="col-span-2">
                        <?php echo $form->labelEx($model, 'title', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'title', array(
                            'size' => 60,
                            'maxlength' => 128,
                            'placeholder' => 'Post Title',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'title', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div class="col-span-2">
                        <?php echo $form->labelEx($model, 'content', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textArea($model, 'content', array(
                            'rows' => 6,
                            'placeholder' => 'Write your post content here...',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'content', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'tags', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textArea($model, 'tags', array(
                            'rows' => 2,
                            'placeholder' => 'Comma-separated tags (e.g., tech, coding, Yii)',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'tags', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'status', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'status', array(
                            'placeholder' => 'Status (e.g., 1 for Published)',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'status', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'create_time', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'create_time', array(
                            'placeholder' => 'YYYY-MM-DD HH:MM:SS',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'create_time', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'author_id', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'author_id', array(
                            'placeholder' => 'Author ID',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'author_id', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                </div>

                <div class="mt-10 flex justify-between">
                    <button type="button" onclick="window.history.back();" class="bg-gray-500 text-white px-8 py-4 rounded-xl shadow-lg hover:bg-gray-700 transition-transform transform hover:scale-105 duration-300">Back</button>

                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Post' : 'Update Post', array(
                        'class' => 'bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-xl shadow-lg hover:from-indigo-700 hover:to-blue-600 transition-transform transform hover:scale-105 duration-300',
                    )); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>

    </div>
</div>