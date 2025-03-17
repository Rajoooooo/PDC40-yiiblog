<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array('Posts');

function formatDate($timestamp) {
    return date('F d, Y', $timestamp);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed">

    <div class="max-w-7xl mx-auto py-12 px-6 flex gap-8">

        <!-- Main Content (Posts) -->
        <div class="w-3/8">
            <h1 class="text-5xl font-extrabold tracking-tight mb-12">Latest Posts</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <?php foreach ($dataProvider->getData() as $data): ?>
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <!-- Post Title -->
                            <h2 class="text-2xl font-semibold mb-4">
                                <a href="<?php echo $this->createUrl('view', array('id' => $data->id)); ?>"
                                   class="hover:text-blue-600 transition-colors duration-300">
                                    <?php echo CHtml::encode($data->title); ?>
                                </a>
                            </h2>

                            <!-- Post Content (Excerpt) -->
                            <p class="text-gray-600 mb-6">
                                <?php echo CHtml::encode(mb_substr($data->content, 0, 120)) . '...'; ?>
                            </p>

                            <!-- Metadata & Read More -->
                            <div class="flex justify-between items-center text-sm text-gray-400">
                                <span>Published on: <?php echo formatDate($data->create_time); ?></span>
                                <a href="<?php echo $this->createUrl('view', array('id' => $data->id)); ?>"
                                   class="text-blue-600 hover:underline">Read More →</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <?php $this->widget('CLinkPager', array(
                    'pages' => $dataProvider->pagination,
                    'header' => '',
                    'htmlOptions' => array('class' => 'flex justify-center space-x-3'),
                    'selectedPageCssClass' => 'bg-blue-600 text-white rounded-lg',
                    'prevPageLabel' => '← Previous',
                    'nextPageLabel' => 'Next →',
                )); ?>
            </div>
        </div>

    </div>

</body>

</html>
