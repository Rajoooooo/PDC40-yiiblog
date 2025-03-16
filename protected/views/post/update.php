<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showSuccessMessage() {
            alert("Blog post updated successfully!");
        }
    </script>
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-8">Update Post <?php echo htmlspecialchars($model->id); ?></h1>

        <!-- Form for Updating Post -->
        <form action="<?php echo Yii::app()->createUrl('post/update', array('id' => $model->id)); ?>" method="POST" onsubmit="showSuccessMessage()">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($model->id); ?>">

            <!-- Title Field -->
            <label class="block text-lg font-semibold mb-2" for="title">Title</label>
            <input type="text" id="title" name="Post[title]" value="<?php echo htmlspecialchars($model->title); ?>"
                   class="w-full p-3 mb-6 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                   placeholder="Enter post title" required>

            <!-- Content Field -->
            <label class="block text-lg font-semibold mb-2" for="content">Content</label>
            <textarea id="content" name="Post[content]" rows="6"
                      class="w-full p-3 mb-6 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                      placeholder="Write your content here..." required><?php echo htmlspecialchars($model->content); ?></textarea>

            <!-- Tags Field -->
            <label class="block text-lg font-semibold mb-2" for="tags">Tags</label>
            <input type="text" id="tags" name="Post[tags]" value="<?php echo htmlspecialchars($model->tags); ?>"
                   class="w-full p-3 mb-6 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                   placeholder="Enter tags, separated by commas">

            <!-- Action Buttons -->
            <div class="flex space-x-4">
                <button type="submit" name="save" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save Changes
                </button>
                <a href="<?php echo Yii::app()->createUrl('post/index'); ?>" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Navigation Buttons -->
        <div class="mt-8 flex space-x-4">
            <a href="<?php echo Yii::app()->createUrl('post/index'); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">List Posts</a>
            <a href="<?php echo Yii::app()->createUrl('post/create'); ?>" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Create Post</a>
            <a href="<?php echo Yii::app()->createUrl('post/view', array('id' => $model->id)); ?>" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">View Post</a>
            <a href="<?php echo Yii::app()->createUrl('post/admin'); ?>" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Manage Posts</a>
        </div>

    </div>

</body>

</html>
