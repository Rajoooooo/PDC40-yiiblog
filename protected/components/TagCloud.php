<?php

Yii::import('zii.widgets.CPortlet');

class TagCloud extends CPortlet
{
    public $title = '';
    public $maxTags = 20;

    protected function renderContent()
    {
        $tags = Tag::model()->findTagWeights($this->maxTags);

        foreach ($tags as $tag => $weight) {
            $link = CHtml::link(
                CHtml::encode($tag),
                array('post/index', 'tag' => $tag),
                ['class' => 'tag-button px-2 py-1 rounded-full bg-blue-500 text-white hover:bg-blue-600 transition']
            );

            echo CHtml::tag('button', [
                
                'style' => "font-size:12pt;",
                'class' => 'inline-flex items-center justify-center',
                'onclick' => "window.location.href='" . CHtml::normalizeUrl(array('post/index', 'tag' => $tag)) . "'"
            ], $link) . "\n";
        }
    }
}
