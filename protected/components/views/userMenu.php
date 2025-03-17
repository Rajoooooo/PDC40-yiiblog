<?php if (!Yii::app()->user->isGuest): ?>
    <ul class="space-y-4">
        <li>
            <?php echo CHtml::link('Create New Post', array('post/create'), [
                'class' => 'inline-block text-left bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition',
            ]); ?>
        </li>
        <li>
            <?php echo CHtml::link('Manage Posts', array('post/admin'), [
                'class' => 'inline-block text-left bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition',
            ]); ?>
        </li>
        <li>
            <?php echo CHtml::link('Logout', array('site/logout'), [
                'class' => 'inline-block text-left bg-red-600 text-white py-2 px-6 rounded-lg hover:bg-red-700 transition',
            ]); ?>
        </li>
    </ul>
<?php endif; ?>