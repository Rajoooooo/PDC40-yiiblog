<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<div class="container mx-auto" id="page">

<header class="flex justify-between items-center py-6 px-4 bg-black shadow-md text-white">
    <div id="logo" class="text-2xl font-bold">
        <?php echo CHtml::encode(Yii::app()->name); ?>
    </div>

    <!-- Navigation -->
    <nav>
        <ul class="flex space-x-8">
            <?php
            $menuItems = array(
                array('label' => 'Home', 'url' => array('/site/index')),
                array('label' => 'Post', 'url' => array('/post/index')),
                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                array('label' => 'Contact', 'url' => array('/site/contact')), 
                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
            );

            foreach ($menuItems as $item) {
                if (isset($item['visible']) && !$item['visible']) continue;
                echo '<li><a href="' . CHtml::normalizeUrl($item['url']) . '" class="text-gray-300 hover:text-blue-400 transition">' . CHtml::encode($item['label']) . '</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>


    <!-- Main Content -->
    <main class="p-8">
        <?php if (isset($this->breadcrumbs)): ?>
            <nav class="text-sm text-gray-500 mb-4">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs)); ?>
            </nav>
        <?php endif; ?>

        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-gray-500 text-sm">
        &copy; <?php echo date('Y'); ?> by My Company. All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </footer>

</div>

</body>

</html>
