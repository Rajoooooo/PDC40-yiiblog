<?php

class CommentController extends Controller
{
	/**
	 * @var string the default layout for the views.
	 */
	public $layout='//layouts/column2';

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
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to perform 'create', 'update', 'admin', and 'delete' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
			),
			array('deny', // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
{
    $model = $this->loadModel($id);  // Post model
    $comments = Comment::model()->approvedComments($id);  // Get only approved and pending comments

    $this->render('view', array(
        'model' => $model,
        'comments' => $comments,
    ));
}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
{
    $model = new Comment;

    if (isset($_POST['Comment'])) {
        $model->attributes = $_POST['Comment'];
        $model->status = Comment::STATUS_PENDING; // Set new comments as pending
        $model->create_time = time();

        if ($model->save()) {
            Yii::app()->user->setFlash('success', 'Your comment is pending approval.');
            $this->redirect(array('post/view', 'id' => $model->post_id));
        }
    }

    $this->render('create', array('model' => $model));
}


	/**
	 * Updates a particular model.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update', array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Comment');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('admin', array(
			'model'=>$model,
		));
	}

	/**
	 * Lists pending comments.
	 */
	public function actionPending()
	{
		$model = new Comment('search');
		$model->status = Comment::STATUS_PENDING;

		$this->render('pending', array('model' => $model));
	}

	/**
	 * Approves a comment.
	 * @param integer $id the ID of the comment to approve
	 */
	public function actionApprove($id)
{
    $comment = $this->loadModel($id);
    if ($comment->status == Comment::STATUS_PENDING) {
        // Set the status to approved and save
        $comment->status = Comment::STATUS_APPROVED;
        if ($comment->save()) {
            Yii::app()->user->setFlash('success', 'Comment approved.');
        }
    }
    $this->redirect(array('post/view', 'id' => $comment->post_id)); // Redirect back to the post view
}


	/**
	 * Rejects (deletes) a comment.
	 * @param integer $id the ID of the comment to reject
	 */
	public function actionReject($id)
	{
		$this->loadModel($id)->delete();
		Yii::app()->user->setFlash('warning', 'Comment rejected and deleted.');
		$this->redirect(array('pending'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
