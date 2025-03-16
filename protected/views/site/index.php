<?php
/* @var $this SiteController */
/* @var $posts Post[] */
/* @var $pages CPagination */

Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
?>

<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-6">Welcome to My Blog</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($posts as $post): ?>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold">
                    <?php echo CHtml::link(CHtml::encode($post->title), array('post/view', 'id' => $post->id)); ?>
                </h2>
                <p class="text-gray-600">Published on: <?php echo date('F d, Y', $post->create_time); ?></p>
                <p class="mt-4"> <?php echo nl2br(CHtml::encode($post->content)); ?> </p>
                <div class="mt-4">
                    <?php echo CHtml::link('Comment', array('comment/create', 'id' => $post->id), array('class' => 'bg-blue-500 text-white px-4 py-2 rounded')); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 flex justify-center">
        <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'header' => '',
            'htmlOptions' => array('class' => 'pagination flex space-x-2'),
            'selectedPageCssClass' => 'bg-blue-500 text-white rounded-full px-3 py-1',
            'internalPageCssClass' => 'bg-gray-300 text-black rounded-full px-3 py-1',
        ));
        ?>
    </div>
</div>
