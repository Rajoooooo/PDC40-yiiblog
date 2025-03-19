<?php

class CommentController extends Controller
{
    /**
     * @var string the default layout for the views.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // allow deletion only via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index', 'view', and 'create' actions
                'actions' => array('index', 'view', 'create'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated users to perform advanced actions
                'actions' => array('create', 'update', 'admin', 'delete', 'approve', 'pending', 'changeStatus'),
                'users' => array('@'),
            ),
            array('deny', // deny all other users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model and its approved comments.
     * @param integer $id the ID of the post to be displayed
     */
    public function actionView($id)
    {
        $post = $this->loadModel($id);
        $approvedComments = Comment::approvedComments($id); // Fetch only approved comments
    
        $comment = new Comment();
        $comment->post_id = $post->id; // Ensure post_id is assigned correctly
    
        if (isset($_POST['Comment'])) {
            $comment->attributes = $_POST['Comment'];
            $comment->post_id = $post->id;
    
            if ($comment->save()) {
                Yii::app()->user->setFlash('commentSubmitted', 'Thank you for your comment. It will be displayed once approved.');
                $this->refresh();
            }
        }
    
        $this->render('view', array(
            'model' => $post,
            'comment' => $comment,
            'comments' => $approvedComments, // Pass approved comments to the view
        ));
    }
    

    /**
     * Creates a new comment associated with a post.
     */
    public function actionCreate($post_id = null)
    {
        $model = new Comment();
    
        // Ensure post_id is set from parameter or query
        if ($post_id === null) {
            $post_id = Yii::app()->request->getQuery('id');
        }
    
        if (isset($_POST['Comment'])) {
            $model->attributes = $_POST['Comment'];
            $model->post_id = $post_id; // Ensure post_id is set
    
            if ($model->validate() && $model->save()) {
                Yii::app()->user->setFlash('success', 'Your comment has been submitted.');
                $this->redirect(array('post/view', 'id' => $model->post_id));
            }
        }
    
        $this->render('create', array('model' => $model, 'post_id' => $post_id));
    }

    /**
     * Updates a particular comment.
     * @param integer $id the ID of the comment to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Comment'])) {
            $model->attributes = $_POST['Comment'];

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Comment updated successfully.');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array('model' => $model));
    }

    /**
     * Deletes a particular comment.
     * @param integer $id the ID of the comment to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Approves a pending comment.
     * @param integer $id the ID of the comment to be approved
     */
    public function actionApprove($id)
    {
        $comment = $this->loadModel($id);

        if ($comment->status == Comment::STATUS_PENDING) {
            $comment->status = Comment::STATUS_APPROVED;

            if ($comment->save()) {
                Yii::app()->user->setFlash('success', 'Comment approved.');
            }
        }

        $this->redirect(array('post/view', 'id' => $comment->post_id));
    }

    /**
     * Lists all pending comments.
     */
    public function actionPending()
    {
        $model = new Comment('search');
        $model->status = Comment::STATUS_PENDING;

        $this->render('pending', array('model' => $model));
    }

    /**
     * Changes the status of a comment.
     * @param integer $id the ID of the comment
     * @param integer $status the new status (1 = Pending, 2 = Approved)
     */
    public function actionChangeStatus($id, $status)
    {
        $comment = $this->loadModel($id);

        $comment->status = $status;
        if ($comment->save()) {
            Yii::app()->user->setFlash('success', 'Comment status updated successfully.');
        } else {
            Yii::app()->user->setFlash('error', 'Failed to update comment status.');
        }

        $this->redirect(array('comment/index'));
    }

    /**
     * Lists all comments.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Comment');

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all comments.
     */
    public function actionAdmin()
    {
        $model = new Comment('search');
        $model->unsetAttributes();

        if (isset($_GET['Comment'])) {
            $model->attributes = $_GET['Comment'];
        }

        $this->render('admin', array('model' => $model));
    }

    /**
     * Loads a model based on its primary key.
     * @param integer $id the ID of the model to be loaded
     * @return Comment the loaded model
     * @throws CHttpException if the model is not found
     */
    public function loadModel($id)
    {
        $model = Comment::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'The requested comment does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Comment $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}