<?php

namespace backend\controllers;

use Yii;
use common\models\AdminUser;
use common\models\SearchAdminUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CommonUtil;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\LoginRec;

/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends Controller
{
public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
           
        ];
    }

    /**
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchAdminUser();
        $searchModel->role=['99','98','97','96'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionSpUser()
    {
        $searchModel = new SearchAdminUser();
        $searchModel->role=['89','88','87','86'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('sp-user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLoginRec($id)
    {
        $model=AdminUser::findOne($id);
        $dataProvider = new ActiveDataProvider([
            'query'=>LoginRec::find()->andWhere(['user_guid'=>$model->user_guid])->orderBy('time desc')
        ]);
        
        return $this->render('login-rec', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUser();

        if ($model->load(Yii::$app->request->post())) {
            $admin=AdminUser::findOne(['username'=>$model->username]);
            if(!empty($admin)){
                yii::$app->getSession()->setFlash('error','用户名已存在,不能再创建!');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->user_guid=CommonUtil::createUuid();
            $model->parent_user=yii::$app->user->identity->user_guid;
            $model->setPassword($model->password);
            $model->password=md5($model->password);
            $model->created_at=time();
            if(  $model->save())
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password);
            $model->password=md5($model->password);
            $model->password_origin=$model->password;
            $model->updated_at=time();
            if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        yii::$app->getSession()->setFlash('success','删除成功!');
        return $this->redirect(yii::$app->request->referrer);
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
