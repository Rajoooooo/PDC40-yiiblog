<?php

class PostController extends Controller
{
    // Set layout to 'column2.php' in the 'layouts' folder
    public $layout = '//layouts/column2';

    // Define filters for access control and deletion
    public function filters()
    {
        return array(
            'accessControl',      // Controls access permissions
            'postOnly + delete',  // Allows deletion only via POST
        );
    }

    // Define access rules for different user roles
    public function accessRules()
    {
        return array(
            // Allow all users to view posts
            array('allow', 'actions' => array('index', 'view'), 'users' => array('*')),

            // Allow authenticated users to create, update, and manage posts
            array('allow', 'actions' => array('create', 'update', 'admin'), 'users' => array('@')),

            // Allow only 'admin' user to delete posts
            array('allow', 'actions' => array('delete'), 'users' => array('admin')),

            // Deny all other users
            array('deny', 'users' => array('*')),
        );
    }

    // Display the list of posts (including tag filtering)
    public function actionIndex()
    {
        $criteria = new CDbCriteria();

        if (isset($_GET['tag'])) {
            $tag = $_GET['tag'];
            $criteria->addSearchCondition('tags', $tag);
        }

        $dataProvider = new CActiveDataProvider('Post', array(
            'criteria'   => $criteria,
            'pagination' => array('pageSize' => 10),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    // Display a single post and handle comments
    public function actionView($id)
{
    $post = $this->loadModel($id);
    $approvedComments = Comment::approvedComments($id); // Fetch only approved comments

    $comment = new Comment();
    $comment->post_id = $post->id; // Assign post_id to comment model

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


    // Create a new post
    public function actionCreate()
    {
        $model = new Post;

        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes  = $_POST['Post'];
            $model->author_id   = Yii::app()->user->id;
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

    // Update an existing post
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes  = $_POST['Post'];
            $model->update_time = time();

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    // Delete a post
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

    // Manage posts (Admin view)
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

    // Load a specific post model by ID
    public function loadModel($id)
    {
        $model = Post::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    // Validate the post model via AJAX
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}