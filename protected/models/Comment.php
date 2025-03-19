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
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;

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
            array('content, author, email', 'required'),
            array('post_id', 'safe'), // Allow automatic post_id assignment
            array('status, create_time, post_id', 'numerical', 'integerOnly' => true),
            array('author, email, url', 'length', 'max' => 128),
            array('email', 'email'), // Ensure valid email format
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
            'id'          => 'ID',
            'content'     => 'Comment',
            'author'      => 'Name',
            'email'       => 'Email',
            'url'         => 'URL',
            'status'      => 'Status',
            'create_time' => 'Created At',
            'post_id'     => 'Post ID',
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

    /**
     * Finds recent approved comments.
     * @param int $limit Number of comments to fetch
     * @return Comment[] List of recent comments
     */
    public function findRecentComments($limit = 3)
    {
        return $this->with('post')->findAll(array(
            'order' => 't.create_time DESC',
            'limit' => $limit,
        ));
    }

    /**
     * Retrieves approved comments for a specific post.
     * @param int $postId The post ID
     * @return Comment[] List of approved comments
     */
    public static function approvedComments($postId)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'post_id = :post_id AND status = :status';
        $criteria->params = array(':post_id' => $postId, ':status' => self::STATUS_APPROVED);
        $criteria->order = 'create_time DESC';
    
        return self::model()->findAll($criteria);
    }    

    /**
     * Adds a comment to the post and sets the approval status.
     * @param Comment $comment The comment model
     * @return bool Whether the comment was successfully saved
     */
    public function addComment($comment)
    {
        if (Yii::app()->params['commentNeedApproval']) {
            $comment->status = self::STATUS_PENDING;
        } else {
            $comment->status = self::STATUS_APPROVED;
        }

        $comment->post_id = $this->id; // Auto-assign the post_id

        return $comment->save();
    }
}