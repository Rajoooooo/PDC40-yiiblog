<?php

class Post extends CActiveRecord
{
    public function tableName()
    {
        return '{{post}}';
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

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('update_time', $this->update_time);
        $criteria->compare('author_id', $this->author_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
