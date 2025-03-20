<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array('Posts');

function formatDate($timestamp) {
    return date('F d, Y', $timestamp);
}
$dataProvider->criteria->order = 'create_time DESC';
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

            <?php
            if (isset($_GET['tag'])) {
                echo "<h2>Posts filtered by tag: <strong>" . CHtml::encode($_GET['tag']) . "</strong></h2>";
            }
            ?>

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
            <div class="flex justify-center mt-12">
                <?php $this->widget('CLinkPager', array(
                    'pages' => $dataProvider->pagination,
                    'header' => '',
                    'htmlOptions' => array('class' => 'flex space-x-2'),
                    'selectedPageCssClass' => 'px-4 py-2 rounded-lg bg-blue-600 text-white',
                    'previousPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                    'nextPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                    'firstPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                    'lastPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                    'internalPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300',
                    'prevPageLabel' => 'Previous',
                    'nextPageLabel' => 'Next',
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                )); ?>
            </div>

        </div>

    </div>

</body>

</html>
