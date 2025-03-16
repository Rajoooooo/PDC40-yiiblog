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

            <!-- Fetch and Display Author's Name -->
            <p>
                Author: <span class="font-semibold">
                    <?php
                    // Get author's name from tbl_user
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

        <!-- Action Buttons -->
        <div class="flex space-x-4 mt-6">
            <!-- Create New Post -->
            <a href="<?php echo Yii::app()->createUrl('post/create'); ?>" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Create New Post</a>

            <!-- Update Post -->
            <a href="<?php echo Yii::app()->createUrl('post/update', array('id' => $model->id)); ?>" 
               class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">Update Post</a>

            <!-- Delete Post -->
            <form action="<?php echo Yii::app()->createUrl('post/delete'); ?>" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                <input type="hidden" name="id" value="<?php echo $model->id; ?>">
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete Post</button>
            </form>

            <!-- Manage Posts -->
            <a href="<?php echo Yii::app()->createUrl('post/admin'); ?>" 
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Manage Posts</a>
        </div>
    </div>

</body>

</html>
