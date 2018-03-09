<?php

namespace backend\controllers;

use common\models\Articalstatus;
use common\models\User;
use Yii;
use common\models\Artical;
use common\models\Articalsearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticalController implements the CRUD actions for Artical model.
 */
class ArticalController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
           /* 'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions'=>['index','view'],
                        'allow'=>true,
                        'roles'=>['?'],
                    ],
                    [
                        'actions'=>['logout','index','create','update'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ]
            ]*/
        ];
    }

    /**
     * Lists all Artical models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Articalsearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /*var_dump($dataProvider);
        exit(0);*/
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Artical model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $artica = $this->findModel($id);
        $status = Articalstatus::findOne($artica->status);
        $auther = User::findOne($artica->user_id);
        return $this->render('view', [
            'model' => $artica,
            'sta'=>$status,
            'auther'=>$auther,
        ]);
    }

    /**
     * Creates a new Artical model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createPost')){
            throw new ForbiddenHttpException('对不起  您没有进行该操作的权限');
        }
        $model = new Artical();
        //$model->create_time=time();
        //$model->update_time=time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            /*print_r($model);
            exit();*/
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Artical model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updatePost')){
            throw new ForbiddenHttpException('对不起  您没有进行该操作的权限');
        }
        $model = $this->findModel($id);
        //$model->update_time=time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*print_r($model->update_time);
            exit(0);*/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Artical model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deletePost')){
            throw new ForbiddenHttpException('对不起  您没有进行该操作的权限');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Artical model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Artical the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artical::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
