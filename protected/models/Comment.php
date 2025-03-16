<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The following are the available columns in table '{{comment}}':
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 *
 * The following are the available model relations:
 * @property Post $post
 */
class Comment extends CActiveRecord
{
    // Comment Status Constants
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{comment}}';
    }

    public function rules()
    {
        return array(
            array('content, author, email, post_id', 'required'),
            array('status, create_time, post_id', 'numerical', 'integerOnly' => true),
            array('author, email, url', 'length', 'max' => 128),
            array('id, content, status, create_time, author, email, url, post_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'content' => 'Comment',
            'author' => 'Author',
            'email' => 'Email',
            'url' => 'URL',
            'status' => 'Status',
            'create_time' => 'Created At',
            'post_id' => 'Post',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('post_id', $this->post_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

	public function approvedComments($postId)
	{
		// Fetch only approved comments for the post
		return $this->findAllByAttributes(
			array('post_id' => $postId, 'status' => self::STATUS_APPROVED),
			array('order' => 'create_time DESC')
		);
	}
	

}
