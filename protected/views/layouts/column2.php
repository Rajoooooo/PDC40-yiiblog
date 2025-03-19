<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="flex gap-8 max-w-7xl mx-auto py-12 px-6">

    <!-- Main Content -->
    <div class="w-3/4" id="content">
        <?php echo $content; ?>
    </div>

    <!-- Sidebar (Visible on all pages) -->
    <div class="w-1/4 flex-shrink-0">
        <div id="sidebar" class="bg-white p-6 shadow-lg rounded-xl h-full min-h-[600px] space-y-6">

            <!-- Operations Section -->
            <?php
                $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Operations'));
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'operations space-y-2'),
                ));
                $this->endWidget();
            ?>

            <!-- User Menu -->
            <?php if (!Yii::app()->user->isGuest) : ?>
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <?php $this->widget('UserMenu'); ?>
                </div>
            <?php endif; ?>

            <!-- Tags Section -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold mb-3">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <?php $this->widget('TagCloud', ['maxTags' => Yii::app()->params['tagCloudCount']]); ?>
                </div>
            </div>

            <!-- Recent Comments Section -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold mb-3">Recent Comments</h3>
                <?php $this->widget('RecentComments', array('maxComments' => 3)); ?>
            </div>

        </div>
    </div>

</div>

<?php $this->endContent(); ?>
