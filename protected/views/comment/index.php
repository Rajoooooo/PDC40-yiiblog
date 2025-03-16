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

// Fetch comments from the database in newest-to-oldest order
$criteria = new CDbCriteria();
$criteria->order = 'create_time'; // Newest comment first
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

                        <!-- Approve Button -->
                        <?php if ($comment->status == 0) : ?>
                            <form method="post" action="<?php echo Yii::app()->createUrl('comment/approve', array('id' => $comment->id)); ?>">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Approve</button>
                            </form>
                        <?php else : ?>
                            <span class="text-green-600 font-medium">Approved</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-gray-600">No comments available.</p>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>
