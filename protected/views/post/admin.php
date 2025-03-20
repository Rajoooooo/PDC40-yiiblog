<?php
    $dataProvider = $model->search();
    $posts = $dataProvider->getData();
    $pagination = $dataProvider->pagination;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-2xl">
        <h1 class="text-4xl font-extrabold mb-8">Manage Posts</h1>

        <!-- Navigation Buttons -->
        <div class="mb-8 flex flex-wrap gap-4">
            <a href="<?php echo Yii::app()->createUrl('post/index'); ?>" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">List Posts</a>
            <a href="<?php echo Yii::app()->createUrl('post/create'); ?>" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Create Post</a>
            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700" onclick="toggleSearch()">Advanced Search</button>
        </div>

        <!-- Advanced Search (Hidden by Default) -->
        <div id="search-form" class="hidden mb-8">
            <?php $this->renderPartial('_search', array('model' => $model)); ?>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto max-h-[600px] rounded-lg border border-gray-300">
            <table class="w-full table-auto text-sm">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Title</th>
                        <th class="p-4 text-left">Content</th>
                        <th class="p-4 text-left">Tags</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Created At</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    <?php if (!empty($posts)) : ?>
                        <?php foreach ($posts as $post) : ?>
                            <tr>
                                <td class="p-4"> <?php echo htmlspecialchars($post->id); ?> </td>
                                <td class="p-4"> <?php echo htmlspecialchars($post->title); ?> </td>
                                <td class="p-4 max-w-xs truncate"> <?php echo htmlspecialchars($post->content); ?> </td>
                                <td class="p-4"> <?php echo htmlspecialchars($post->tags); ?> </td>
                                <td class="p-4"> <?php echo htmlspecialchars($post->status); ?> </td>
                                <td class="p-4"> <?php echo date('F d, Y', $post->create_time); ?> </td>
                                <td class="p-4 relative">
                                    <button onclick="toggleDropdown(<?php echo $post->id; ?>)" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                                        &#x22EE;
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div id="dropdown-<?php echo $post->id; ?>" class="hidden absolute right-0 bg-white shadow-lg rounded-lg mt-2 z-10 w-32">
                                        <a href="<?php echo Yii::app()->createUrl('post/view', array('id' => $post->id)); ?>" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                            📄 View
                                        </a>
                                        <a href="<?php echo Yii::app()->createUrl('post/update', array('id' => $post->id)); ?>" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                            ✏️ Update
                                        </a>
                                        <a href="<?php echo Yii::app()->createUrl('post/delete', array('id' => $post->id)); ?>" class="flex items-center px-4 py-2 hover:bg-gray-100" onclick="return confirm('Are you sure you want to delete this post?');">
                                            ❌ Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-500">No posts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pagination,
                'header' => '',
                'htmlOptions' => array('class' => 'flex space-x-2'),
                'nextPageLabel' => 'Next',
                'prevPageLabel' => 'Previous',
                'firstPageLabel' => 'First',
                'lastPageLabel' => 'Last',
                'selectedPageCssClass' => 'bg-indigo-600 text-white px-4 py-2 rounded-lg',
                'hiddenPageCssClass' => 'hidden',
                'internalPageCssClass' => 'px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300',
            )); ?>
        </div>

    </div>

    <script>
        // Toggle Search Form
        function toggleSearch() {
            document.getElementById('search-form').classList.toggle('hidden');
        }

        // Toggle Dropdown Menu
        function toggleDropdown(id) {
            document.querySelectorAll('[id^=dropdown-]').forEach(menu => menu.classList.add('hidden'));
            document.getElementById(`dropdown-${id}`).classList.toggle('hidden');
        }

        // Hide dropdown on outside click
        document.addEventListener('click', (e) => {
            if (!e.target.closest('[onclick^=toggleDropdown]')) {
                document.querySelectorAll('[id^=dropdown-]').forEach(menu => menu.classList.add('hidden'));
            }
        });
    </script>

</body>

</html>
