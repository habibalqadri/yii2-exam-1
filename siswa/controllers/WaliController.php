<?php

namespace siswa\controllers;

use common\models\RefStatusWali;
use common\models\Siswa;
use common\models\SiswaWali;
use Yii;
use common\models\Wali;
use siswa\models\WaliSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use function PHPSTORM_META\map;

/**
 * WaliController implements the CRUD actions for Wali model.
 */
class WaliController extends Controller
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
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Wali models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WaliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Wali model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Wali ",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Ubah', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Wali model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Wali();
        $dataStatusWali = ArrayHelper::map(RefStatusWali::find()->asArray()->all(), 'id', 'status_wali');


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah Wali",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataStatusWali' => $dataStatusWali,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {



                if ($model->save()) {
                    $id_user = Yii::$app->user->identity->id;
                    $id_siswa = Siswa::find()->where(['id_user' => $id_user])->one();

                    $siswaWali = new SiswaWali();
                    $siswaWali->id_siswa = $id_siswa->id;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tambah Wali",
                            'content' => '<span class="text-success">Create Wali berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                        ];
                    }
                }


                // return [
                //     'forceReload' => '#crud-datatable-pjax',
                //     'title' => "Tambah Wali",
                //     'content' => '<span class="text-success">Create Wali berhasil</span>',
                //     'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                //         Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                // ];
            } else {
                return [
                    'title' => "Tambah Wali",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Wali model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataStatusWali = ArrayHelper::map(RefStatusWali::find()->asArray()->all(), 'id', 'status_wali');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah Wali",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'dataStatusWali' => $dataStatusWali,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Wali ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah Wali ",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'dataStatusWali' => $dataStatusWali,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataStatusWali' => $dataStatusWali,
                ]);
            }
        }
    }

    /**
     * Delete an existing Wali model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $siswaWali = SiswaWali::find()->where(['id_wali' => $id])->one();
        $siswaWali->delete();
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Wali model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Wali model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wali the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wali::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
