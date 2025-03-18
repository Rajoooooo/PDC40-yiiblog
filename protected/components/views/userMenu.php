<?php if (!Yii::app()->user->isGuest): ?>
    <ul class="space-y-2">
        <li class="p-3 bg-gray-100 rounded-lg shadow-sm">
            <?php echo CHtml::link('Create New Post', array('post/create'), [
                'class' => 'text-blue-600 hover:underline',
            ]); ?>
        </li>
        <li class="p-3 bg-gray-100 rounded-lg shadow-sm">
            <?php echo CHtml::link('Manage Posts', array('post/admin'), [
                'class' => 'text-blue-600 hover:underline',
            ]); ?>
        </li>
        <li class="p-3 bg-gray-100 rounded-lg shadow-sm">
            <?php 
                // Get the count of approved comments
                $approvedCount = Comment::model()->count('status=' . Comment::STATUS_APPROVED);
                echo CHtml::link('Approve Comments', array('comment/index'), [
                    'class' => 'text-green-600 hover:underline',
                ]) . ' (' . $approvedCount . ')';
            ?>
        </li>
        <li class="p-3 bg-gray-100 rounded-lg shadow-sm">
            <?php echo CHtml::link('Logout', array('site/logout'), [
                'class' => 'text-red-600 hover:underline',
            ]); ?>
        </li>
    </ul>
<?php endif; ?>
