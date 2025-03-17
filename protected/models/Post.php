<?php

class Post extends CActiveRecord
{
    const STATUS_UNPUBLISHED = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_ARCHIVED = 3;

    public function tableName()
    {
        return '{{post}}';  // Table name in your database
    }

    public function rules()
    {
        return array(
            array('title, content, status, author_id', 'required'),
            array('status, create_time, update_time, author_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 128),
            array('tags', 'safe'),
            array('id, title, content, tags, status, create_time, update_time, author_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'comments' => array(self::HAS_MANY, 'Comment', 'post_id'),
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
        );
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->create_time = time();
        }
        $this->update_time = time();
        return parent::beforeSave();
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'tags' => 'Tags',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_id' => 'Author',
        );
    }

    // Used for the admin panel (shows all posts including archived)
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'create_time DESC'; // Show newest posts first

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    // Used for the index page (excludes archived posts)
    public function searchForIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'status != :archived'; // Exclude archived posts
        $criteria->params = array(':archived' => self::STATUS_ARCHIVED);
        $criteria->order = 'create_time DESC';
    
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
    }
    

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
