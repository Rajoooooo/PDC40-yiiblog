<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'create_time DESC';
        $count = Post::model()->count();

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $posts = Post::model()->findAll($criteria);

        $this->render('index', array(
            'posts' => $posts,
            'pages' => $pages,
        ));
    }

    /**
     * Handles external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page.
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if (isset($_POST['ContactForm'])) {
            $model->attributes = array_map('trim', $_POST['ContactForm']); // Trim input

            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page.
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $redirectUrl = (Yii::app()->user->name === 'admin') ? 'admin/index' : 'post/index';
            $this->redirect(Yii::app()->createUrl($redirectUrl));
        }

        $model = new LoginForm();

        if (isset($_POST['LoginForm']) && is_array($_POST['LoginForm'])) {
            $model->attributes = array_map('trim', $_POST['LoginForm']); // Fix trim() error

            if ($model->validate() && $model->login()) {
                // Redirect user after successful login
                $redirectUrl = (Yii::app()->user->name === 'admin') ? 'admin/index' : 'post/index';
                $this->redirect(Yii::app()->createUrl($redirectUrl));
            }
        }

        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirects to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}
