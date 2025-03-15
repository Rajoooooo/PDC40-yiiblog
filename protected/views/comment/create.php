<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs = array(
    'Comments' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Comment', 'url' => array('index')),
    array('label' => 'Manage Comment', 'url' => array('admin')),
);

Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
?>

<style>
    .form-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        color: #333;
        font-weight: bold;
    }

    .form-button {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s;
    }

    .form-button:hover {
        background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
    }
</style>

<div class="container mx-auto p-6 flex justify-center">
    <div class="max-w-lg w-full form-container">
        <h1 class="text-3xl form-title text-center mb-6">Create Comment</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>

        <div class="mt-6 text-center">
            <a href="<?php echo Yii::app()->createUrl('comment/index'); ?>" class="form-button text-white px-6 py-2 rounded-full">Back to Comments</a>
        </div>
    </div>
</div>