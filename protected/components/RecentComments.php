<?php

Yii::import('zii.widgets.CPortlet');

class RecentComments extends CPortlet
{
    public $title = '';
    public $maxComments = 3;

    public function getRecentComments()
    {
        return Comment::model()->findRecentComments($this->maxComments);
    }

    protected function renderContent()
    {
        $comments = $this->getRecentComments();

        if (!empty($comments)) {
            echo '<ul class="space-y-3">';
            foreach ($comments as $comment) {
                echo '<li class="border-b pb-2">';
                echo '<strong>' . CHtml::encode($comment->author) . ':</strong>';
                echo '<p class="text-sm text-gray-700">"' . CHtml::encode(substr($comment->content, 0, 50)) . '..."</p>';
                echo '<br>';
                echo '<a href="' . CHtml::normalizeUrl(array('comment/view', 'id' => $comment->id)) . '" class="text-blue-600 hover:underline text-xs">Read more</a>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p class="text-gray-500 text-sm">No recent comments available.</p>';
        }
    }
}
