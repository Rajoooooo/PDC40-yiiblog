<?php
/* @var $this CommentController */
/* @var $model Comment */

Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
Yii::app()->clientScript->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 to-gray-300">
    <div class="bg-white shadow-xl rounded-2xl p-12 w-full max-w-3xl">

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Leave a Comment</h1>

        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'comment-form',
            'enableAjaxValidation' => false,
        ]); ?>

        <p class="text-sm text-gray-500 mb-8">
            Fields with <span class="text-red-500">*</span> are required.
        </p>

        <?php echo $form->errorSummary($model, '<div class="text-red-600 mb-6">', '</div>'); ?>

        <div class="space-y-6">

            <!-- Author -->
            <div>
                <?php echo $form->labelEx($model, 'author', ['class' => 'block text-gray-700 font-medium mb-2']); ?>
                <?php echo $form->textField($model, 'author', [
                    'placeholder' => 'Enter your name',
                    'class' => 'w-full p-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-400 transition',
                ]); ?>
                <?php echo $form->error($model, 'author', ['class' => 'text-red-500 text-sm mt-1']); ?>
            </div>

            <!-- Email -->
            <div>
                <?php echo $form->labelEx($model, 'email', ['class' => 'block text-gray-700 font-medium mb-2']); ?>
                <?php echo $form->textField($model, 'email', [
                    'placeholder' => 'Enter your email',
                    'class' => 'w-full p-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-400 transition',
                ]); ?>
                <?php echo $form->error($model, 'email', ['class' => 'text-red-500 text-sm mt-1']); ?>
            </div>

            <!-- Content -->
            <div>
                <?php echo $form->labelEx($model, 'content', ['class' => 'block text-gray-700 font-medium mb-2']); ?>
                <?php echo $form->textArea($model, 'content', [
                    'rows' => 5,
                    'placeholder' => 'Share your thoughts...',
                    'class' => 'w-full p-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-400 transition',
                ]); ?>
                <?php echo $form->error($model, 'content', ['class' => 'text-red-500 text-sm mt-1']); ?>
            </div>

            <?php if (!Yii::app()->user->isGuest) : ?>
                <!-- Status (Visible to Admins Only) -->
                <div>
                    <?php echo $form->labelEx($model, 'status', ['class' => 'block text-gray-700 font-medium mb-2']); ?>
                    <?php echo $form->dropDownList($model, 'status', [
                        Comment::STATUS_PENDING => 'Pending',
                        Comment::STATUS_APPROVED => 'Approved',
                    ], [
                        'prompt' => 'Select Status',
                        'class' => 'w-full p-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-400 transition',
                    ]); ?>
                    <?php echo $form->error($model, 'status', ['class' => 'text-red-500 text-sm mt-1']); ?>
                </div>
            <?php endif; ?>

            <!-- Hidden Create Time Field -->
            <?php echo $form->hiddenField($model, 'create_time', ['value' => time()]); ?>

            <!-- Submit Button -->
            <div class="text-center mt-8">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit Comment' : 'Update Comment', [
                    'class' => 'bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transform transition hover:scale-105 duration-300',
                ]); ?>
            </div>

        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
