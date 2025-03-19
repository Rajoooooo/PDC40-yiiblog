<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 p-8">

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-8">
        <!-- Post Title -->
        <h1 class="text-4xl font-bold mb-4"> <?php echo htmlspecialchars($model->title); ?> </h1>

        <!-- Metadata -->
        <div class="text-sm text-gray-600 mb-6">
            <p>Published on: <span class="font-semibold"> <?php echo date('F j, Y', $model->create_time); ?> </span></p>
            <p>
                Author: <span class="font-semibold">
                    <?php
                    $authorName = Yii::app()->db
                        ->createCommand()
                        ->select('username')
                        ->from('tbl_user')
                        ->where('id=:id', array(':id' => $model->author_id))
                        ->queryScalar();
                    echo htmlspecialchars($authorName);
                    ?>
                </span>
            </p>
        </div>

        <!-- Content -->
        <div class="prose max-w-none mb-8"> <?php echo nl2br(htmlspecialchars($model->content)); ?> </div>

        <!-- Tags -->
        <?php if (!empty($model->tags)): ?>
            <div class="mb-6">
                <span class="font-semibold">Tags:</span>
                <?php foreach (explode(',', $model->tags) as $tag): ?>
                    <span class="inline-block bg-gray-200 text-sm px-3 py-1 rounded-full mr-2">
                        <?php echo htmlspecialchars(trim($tag)); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Comment Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Comments</h2>
            <?php if (!empty($comments)): ?>
                <div class="space-y-4">
                    <?php foreach ($comments as $comment): ?>
                        <div class="flex items-center mb-4 p-4 bg-gray-100 rounded-lg">
                            <p class="font-semibold mr-2"> <?php echo CHtml::encode($comment->author); ?>:</p>
                            <p><?php echo CHtml::encode($comment->content); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600">No comments yet.</p>
            <?php endif; ?>
        </div>

        <!-- Comment Button -->
        <div class="mt-6">
            <?php if (Yii::app()->user->isGuest): ?>
                <a href="<?php echo Yii::app()->createUrl('comment/create', array('post_id' => $model->id)); ?>"
                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Leave a Comment</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>