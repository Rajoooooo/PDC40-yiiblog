<?php

Yii::import('zii.widgets.CPortlet');

class RecentComments extends CPortlet
{
    public $title = 'Recent Comments';
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
                echo '<span class="text-xs text-gray-500">';
                echo ($comment->status == Comment::STATUS_APPROVED) ? '<span class="text-green-600">[Approved]</span>' : '<span class="text-red-600">[Pending]</span>';
                echo '</span>';
                echo '<br>';
                // Corrected Read More link to go to the comment ID, not post ID
                echo '<a href="' . CHtml::normalizeUrl(array('comment/view', 'id' => $comment->id)) . '" class="text-blue-600 hover:underline text-xs">Read more</a>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p class="text-gray-500 text-sm">No recent comments available.</p>';
        }
    }
}
