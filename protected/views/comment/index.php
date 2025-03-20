<?php
/*
    @var $this CommentController 
    @var $dataProvider CActiveDataProvider 

    $this->breadcrumbs = array(
        'Comments',
    );

    $this->menu = array(
        array('label' => 'Create Comment', 'url' => array('create')),
        array('label' => 'Manage Comment', 'url' => array('admin')),
    );
*/

// Fetch comments with pagination
$criteria = new CDbCriteria();
$criteria->order = 'create_time DESC'; 

// Set up pagination (10 comments per page)
$pages = new CPagination(Comment::model()->count($criteria));
$pages->pageSize = 10;
$pages->applyLimit($criteria);

// Retrieve paginated comments
$comments = Comment::model()->findAll($criteria);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold mb-8">Comments</h1>

        <!-- Navigation Links -->
        <div class="flex space-x-4 mb-8">
            <a href="<?php echo Yii::app()->createUrl('comment/create'); ?>" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Create Comment</a>
            <a href="<?php echo Yii::app()->createUrl('comment/admin'); ?>" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Manage Comment</a>
        </div>

        <!-- Comments Grid (Newest to Oldest) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php if (!empty($comments)) : ?>
                <?php foreach ($comments as $comment) : ?>
                    <div class="bg-white shadow-md rounded-lg p-6 transition-transform hover:scale-105">
                        <!-- Link to comment view -->
                        <a href="<?php echo Yii::app()->createUrl('comment/view', array('id' => $comment->id)); ?>" class="block">
                            <h2 class="text-xl font-semibold mb-4">
                                By: <?php echo htmlspecialchars($comment->author); ?>
                            </h2>

                            <p class="text-gray-700 mb-4">"<?php echo nl2br(htmlspecialchars($comment->content)); ?>"</p>

                            <!-- Display the comment date (YYYY-MM-DD) -->
                            <p class="text-sm text-gray-500 mb-4">Comment on: <?php echo date('Y-m-d', $comment->create_time); ?></p>
                        </a>

                        <!-- Status Label -->
                        <?php if ($comment->status == 1) : ?>
                            <span class="px-3 py-1 text-sm font-medium text-yellow-600 bg-yellow-100 rounded-lg">Pending</span>
                        <?php elseif ($comment->status == 2) : ?>
                            <span class="px-3 py-1 text-sm font-medium text-green-600 bg-green-100 rounded-lg">Approved</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-gray-600">No comments available.</p>
            <?php endif; ?>

        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pages,
                'header' => '',
                'htmlOptions' => array('class' => 'flex space-x-2'),
                'selectedPageCssClass' => 'bg-blue-600 text-white',
                'previousPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                'nextPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                'firstPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                'lastPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400',
                'selectedPageCssClass' => 'px-4 py-2 rounded-lg bg-blue-600 text-white',
                'internalPageCssClass' => 'px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300',
                'prevPageLabel' => 'Previous',
                'nextPageLabel' => 'Next',
                'firstPageLabel' => 'First',
                'lastPageLabel' => 'Last',
            )); ?>
        </div>

    </div>

</body>

</html>