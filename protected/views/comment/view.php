<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs = array(
    'Comments' => array('index'),
    $model->id,
);

// Generate URLs for menu items
$listUrl = Yii::app()->createUrl('comment/index');
$createUrl = Yii::app()->createUrl('comment/create');
$updateUrl = Yii::app()->createUrl('comment/update', array('id' => $model->id));
$deleteUrl = Yii::app()->createUrl('comment/delete', array('id' => $model->id));
$manageUrl = Yii::app()->createUrl('comment/admin');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Comment #<?php echo $model->id; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-4xl mx-auto">

        <!-- Page Title -->
        <h1 class="text-4xl font-bold text-gray-800 mb-8">View Comment #<?php echo $model->id; ?></h1>

        <!-- Menu Buttons -->
        <div class="flex space-x-4 mb-8">
            <!-- <a href="<?php echo $listUrl; ?>" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">List Comment</a> -->
            <!-- <a href="<?php echo $createUrl; ?>" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Create Comment</a> -->
            <a href="<?php echo $updateUrl; ?>" class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">Update Comment</a>
            <form method="post" action="<?php echo $deleteUrl; ?>" onsubmit="return confirm('Are you sure you want to delete this item?');">
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>">
            <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete Comment</button>
        </form>
            <a href="<?php echo $manageUrl; ?>" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Manage Comment</a>
        </div>

        <!-- Comment Details -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Content:</h2>
                    <p class="text-gray-600 mt-2">"<?php echo nl2br(htmlspecialchars($model->content)); ?>"</p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Status:</h2>
                    <p class="text-gray-600 mt-2"><?php echo ($model->status == 1) ? 'Pending' : 'Approved'; ?></p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Author:</h2>
                    <p class="text-gray-600 mt-2"><?php echo htmlspecialchars($model->author); ?></p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Email:</h2>
                    <p class="text-gray-600 mt-2"><?php echo htmlspecialchars($model->email); ?></p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">URL:</h2>
                    <p class="text-gray-600 mt-2">
                        <?php echo $model->url ? '<a href="' . htmlspecialchars($model->url) . '" target="_blank" class="text-blue-500 underline">' . htmlspecialchars($model->url) . '</a>' : 'N/A'; ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Post ID:</h2>
                    <p class="text-gray-600 mt-2"><?php echo htmlspecialchars($model->post_id); ?></p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Created On:</h2>
                    <p class="text-gray-600 mt-2"><?php echo date('Y-m-d', $model->create_time); ?></p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>