<?php
/* @var $this CommentController */
/* @var $model Comment */

Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
Yii::app()->clientScript->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
?>

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl mx-auto">

        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Leave a Comment</h1>

        <div class="flex justify-center">
            <div class="w-full max-w-3xl">
                <?php $this->renderPartial('_form', ['model' => $model]); ?>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="<?php echo Yii::app()->createUrl('comment/index'); ?>" class="text-blue-600 hover:underline font-medium">&larr; Back to Comments</a>
        </div>

    </div>
</div>
