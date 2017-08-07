<?php

namespace app\modules\admin\controllers;

use app\models\Good;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GoodController implements the CRUD actions for Good model.
 */
class GoodController extends Controller
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
        ];
    }

    /**
     * Lists all Good models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Good::find(),
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single Good model.
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
     * Creates a new Good model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
     *@method Image[] getGallery()
     *@property Image $image
     *
     */
    public function actionCreate()
    {
        $model = new Good();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Товар успешно добавлен');
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                debug($_FILES);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {

            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing Good model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Товар успешно обновлен');
            if($model->image!=null){
                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->upload()) {
                    //debug($model);
                    return $this->redirect(['view', 'id' => $model->id]);

                }
                $model->gallery = UploadedFile::getInstances($model, 'gallery');
                if($model->uploadGallery()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }else{
                return $this->redirect(['view', 'id' => $model->id]);
            }


        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Good model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Товар успешно удален');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Good model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Good the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Good::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
