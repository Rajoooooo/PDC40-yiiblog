<?php

/**
 * This is the model class for table "{{tag}}".
 *
 * The followings are the available columns in table '{{tag}}':
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Tag the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name.
     */
    public function tableName()
    {
        return '{{tag}}'; // Matches tbl_tag
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('frequency', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('id, name, frequency', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'posts' => array(self::MANY_MANY, 'Post', 'tbl_post_tag(post_id, tag_id)'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('frequency', $this->frequency);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Finds the weight of tags for displaying in the tag cloud.
     * Only includes tags from published posts (status = 2).
     * @param int $limit Number of tags to fetch
     * @return array List of tags with weights
     */
    public function findTagWeights($limit = 20)
    {
        $posts = Yii::app()->db->createCommand("
            SELECT tags FROM tbl_post WHERE status = 2
        ")->queryColumn();

        $tagCounts = [];

        foreach ($posts as $tags) {
            $tagArray = explode(',', $tags); // Assuming tags are comma-separated in the 'tags' column
            foreach ($tagArray as $tag) {
                $tag = trim($tag);
                if ($tag !== '') {
                    if (!isset($tagCounts[$tag])) {
                        $tagCounts[$tag] = 1;
                    } else {
                        $tagCounts[$tag]++;
                    }
                }
            }
        }

        arsort($tagCounts); // Sort tags by frequency

        // Limit the number of tags
        $tagCounts = array_slice($tagCounts, 0, $limit, true);

        // Adjust weights for better visibility
        $result = [];
        foreach ($tagCounts as $tag => $count) {
            $result[$tag] = $count + 10;
        }

        return $result;
    }
}
