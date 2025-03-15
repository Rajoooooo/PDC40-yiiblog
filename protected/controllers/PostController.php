<?php

class PostController extends Controller
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
            'accessControl', // Access control for CRUD operations
            'postOnly + delete', // Only allow deletion via POST request
        );
    }

    /**
     * Specifies access control rules.
     * @return array Access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // Allow all users to access 'index' and 'view'
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // Allow authenticated users to access 'create' and 'update'
                'actions' => array('create', 'update', 'admin'),
                'users' => array('@'),
            ),
            array('allow', // Allow 'admin' to delete posts
                'actions' => array('delete'),
                'users' => array('admin'),
            ),
            array('deny', // Deny all other users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to display
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new post model.
     */
    public function actionCreate()
    {
        $model = new Post;

        // AJAX validation
        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * @param integer $id the ID of the model to update
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // AJAX validation
        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * @param integer $id the ID of the model to delete
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel($id)->delete();

            // Redirect if not an AJAX request
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Post');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
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

    /**
     * Loads the data model based on the primary key.
     * @param integer $id the ID of the model
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Post::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs AJAX validation.
     * @param Post $model the model to validate
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
