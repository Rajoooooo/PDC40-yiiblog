<?php

class PostController extends Controller
{
    public $layout = '//layouts/column2';

    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('index', 'view'), 'users' => array('*')),
            array('allow', 'actions' => array('create', 'update', 'admin'), 'users' => array('@')),
            array('allow', 'actions' => array('delete'), 'users' => array('admin')),
            array('deny', 'users' => array('*')),
        );
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'status = :status'; 
        $criteria->params = array(':status' => Post::STATUS_PUBLISHED);
    
        $pages = new CPagination(Post::model()->count($criteria));
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
    
        $posts = Post::model()->findAll($criteria);
    
        $this->render('index', array(
            'posts' => $posts,
            'pages' => $pages,
        ));
    }
    

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $comments = Comment::model()->approvedComments($id);

        $this->render('view', array(
            'model' => $model,
            'comments' => $comments,
        ));
    }

    public function actionCreate()
    {
        $model = new Post;

        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->id;
            $model->create_time = time();
            $model->update_time = time();

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            $model->update_time = time();

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel($id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request.');
        }
    }

    public function actionAdmin()
    {
        $model = new Post('search');
        $model->unsetAttributes();

        if (isset($_GET['Post'])) {
            $model->attributes = $_GET['Post'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = Post::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}