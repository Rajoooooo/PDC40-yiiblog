<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs = array(
    'Comments' => array('index'),
    'Manage',
);

// $this->menu = array(
//     array('label' => 'List Comment', 'url' => array('index')),
//     array('label' => 'Create Comment', 'url' => array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#comment-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");

// Pagination: Limit to 10 comments per page
$dataProvider = $model->search();
$dataProvider->pagination = array('pageSize' => 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Comments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-8">

    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-8">

        <h1 class="text-4xl font-bold mb-6">Manage Comments</h1>

        <p class="text-gray-600 mb-4">Use the dropdown to change the status of comments quickly.</p>

        <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600')); ?>

        <div class="search-form mt-4 hidden">
            <?php $this->renderPartial('_search', array('model' => $model)); ?>
        </div>

        <div class="overflow-x-auto mt-8">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-4">ID</th>
                        <th class="p-4">Content</th>
                        <th class="p-4">Author</th>
                        <th class="p-4">Create Time</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataProvider->getData() as $data): ?>
                        <tr class="border-t">
                            <td class="p-4"><?php echo $data->id; ?></td>
                            <td class="p-4 max-w-xs truncate" title="<?php echo CHtml::encode($data->content); ?>">
                                <?php echo CHtml::encode($data->content); ?>
                            </td>
                            <td class="p-4"><?php echo CHtml::encode($data->author); ?></td>
                            <td class="p-4"><?php echo date('F j, Y', $data->create_time); ?></td>
                            <td class="p-4">
                                <?php echo CHtml::dropDownList('status', $data->status, array(
                                    Comment::STATUS_PENDING => 'Pending',
                                    Comment::STATUS_APPROVED => 'Approved',
                                ), array(
                                    'class' => 'p-2 border rounded',
                                    'onchange' => "updateStatus({$data->id}, this.value)",
                                )); ?>
                            </td>
                            <td class="p-4 flex space-x-4">
                                <a href="<?php echo Yii::app()->createUrl('comment/view', array('id' => $data->id)); ?>" class="text-blue-500 hover:underline" title="View">
                                    View
                                </a>
                                <a href="<?php echo Yii::app()->createUrl('comment/update', array('id' => $data->id)); ?>" class="text-green-500 hover:underline" title="Update">
                                    Update
                                </a>
                                <a href="<?php echo Yii::app()->createUrl('comment/delete', array('id' => $data->id)); ?>" class="text-red-500 hover:underline" title="Delete" onclick="return confirm('Are you sure?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            <?php $this->widget('CLinkPager', array('pages' => $dataProvider->pagination)); ?>
        </div>

    </div>

</body>
</html>