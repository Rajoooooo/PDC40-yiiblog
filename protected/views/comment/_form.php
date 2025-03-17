<?php
/* @var $this CommentController */
/* @var $model Comment */

Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
Yii::app()->clientScript->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 to-gray-300">
    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-4xl">

        <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">Share Your Thoughts</h1>

        <div class="flex justify-center">
            <div class="w-full max-w-3xl">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'comment-form',
                    'enableAjaxValidation' => false,
                )); ?>

                <p class="text-sm text-gray-600 mb-6">Fields marked with <span class="text-red-500">*</span> are required.</p>

                <?php echo $form->errorSummary($model, '<div class="text-red-600 mb-6">', '</div>'); ?>

                <div class="grid grid-cols-2 gap-8">

                    <div class="col-span-2">
                        <?php echo $form->labelEx($model, 'content', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textArea($model, 'content', array(
                            'rows' => 6,
                            'placeholder' => 'Write your comment here...',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'content', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'status', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->dropDownList($model, 'status', array(
                            Comment::STATUS_PENDING => 'Pending',
                            Comment::STATUS_APPROVED => 'Approved',
                        ), array(
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                            'prompt' => 'Select Status',
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
                        <?php echo $form->labelEx($model, 'author', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'author', array(
                            'size' => 60,
                            'maxlength' => 128,
                            'placeholder' => 'Your Name',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'author', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'email', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'email', array(
                            'size' => 60,
                            'maxlength' => 128,
                            'placeholder' => 'Your Email',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'email', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'url', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'url', array(
                            'size' => 60,
                            'maxlength' => 128,
                            'placeholder' => 'Your Website (optional)',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'url', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>

                    <div>
                        <?php echo $form->labelEx($model, 'post_id', array('class' => 'block text-gray-700 font-semibold mb-2')); ?>
                        <?php echo $form->textField($model, 'post_id', array(
                            'placeholder' => 'Post ID',
                            'class' => 'w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition-all',
                        )); ?>
                        <?php echo $form->error($model, 'post_id', array('class' => 'text-red-500 text-sm mt-2')); ?>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit Comment' : 'Update Comment', array(
                        'class' => 'bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-xl shadow-lg hover:from-indigo-700 hover:to-blue-600 transition-transform transform hover:scale-105 duration-300',
                    )); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>

    </div>
</div>
