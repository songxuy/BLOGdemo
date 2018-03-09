<?php

namespace frontend\controllers;

use common\models\Comments;
use common\models\Tag;
use common\models\User;
use Yii;
use common\models\Artical;
use common\models\Articalsearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticalController implements the CRUD actions for Artical model.
 */
class ArticalController extends Controller
{
    public $added=0;
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
            'httpCache'=>[
                'class'=> 'yii\filters\HttpCache',
                'only'=>['detail'],
                'lastModified'=>function($action,$params){
                    $q = new Query();
                    return $q->from('artical')->max('update_time');
                }
            ],
        ];
    }

    /**
     * Lists all Artical models.
     * @return mixed
     */
    public function actionIndex()
    {
        $comment = Comments::findRecentComments();
        $tag = Tag::findTagWeight();
        $searchModel = new Articalsearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags'=>$tag,
            'recentComments'=>$comment
        ]);
    }

    /**
     * Displays a single Artical model.
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
     * Creates a new Artical model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Artical();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDetail($id){
        $model = $this->findModel($id);
        $tag = Tag::findTagWeight();
        $recentComment = Comments::findRecentComments();

        $user = User::findOne(Yii::$app->user->id);
        //var_dump(Yii::$app->user->id);exit(0);
        $comment = new Comments();
        $comment->email = $user->email;
        $comment->user_id = $user->id;

        if($comment->load(Yii::$app->request->post())){
                $comment->status=2;
                $comment->artical_id=$id;
                if($comment->save()){
                    $this->added=1;
                }

        }

        return $this->render('detail',[
            'model'=>$model,
            'tags'=>$tag,
            'recentComment'=>$recentComment,
            'comment'=>$comment,
            'added'=>$this->added
        ]);
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
