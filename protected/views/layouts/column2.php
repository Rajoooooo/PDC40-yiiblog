<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="flex gap-8 max-w-7xl mx-auto py-12 px-6">

    <!-- Main Content -->
    <div class="<?php echo (Yii::app()->controller->id == 'post' && Yii::app()->controller->action->id == 'index') ? 'w-3/8' : 'w-full'; ?>" id="content">
        <?php echo $content; ?>
    </div>

    <!-- Sidebar (Visible only on post/index.php) -->
    <?php if (Yii::app()->controller->id == 'post' && Yii::app()->controller->action->id == 'index'): ?>
        <div class="w-1/4 flex-grow ml-4 mt-36">
            <div id="sidebar" class="bg-white p-6 shadow-lg rounded-xl h-full min-h-[600px]">
                <?php
                $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Operations'));
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'operations'),
                ));
                $this->endWidget();

                if (!Yii::app()->user->isGuest) $this->widget('UserMenu');
                ?>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php $this->endContent(); ?>
