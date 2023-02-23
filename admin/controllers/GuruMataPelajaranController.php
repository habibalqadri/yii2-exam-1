<?php

namespace admin\controllers;

use Yii;
use common\models\GuruMataPelajaran;
use admin\models\GuruMataPelajaranSearch;
use admin\models\GuruSearch;
use common\models\Guru;
use common\models\MataPelajaran;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * GuruMataPelajaranController implements the CRUD actions for GuruMataPelajaran model.
 */
class GuruMataPelajaranController extends Controller
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
     * Lists all GuruMataPelajaran models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new GuruMataPelajaranSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);
        $mataPelajaran = MataPelajaran::find()->where(['id' => $id])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mataPelajaran' => $mataPelajaran,
            'id' => $id
        ]);
    }

    /**
     * Displays a single GuruMataPelajaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "GuruMataPelajaran ",
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
     * Creates a new GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $id_guru)
    {
        $request = Yii::$app->request;
        $model = new GuruMataPelajaran();
        $dataMataPelajaran =  MataPelajaran::find()->where(['id' => $id])->one();

        $searchModel = new GuruSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataGuru = Guru::find()->all();

        $modelMataPelajaran = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id])->one();
        $modelGuru = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id])->all();

        if (!$id_guru) {
            if ($request->isAjax) {

                /*
            *   Process for ajax request
            */
                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($request->isGet) {
                    return [
                        'title' => "Tambah Guru Mata Pelajaran",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'dataMataPelajaran' => $dataMataPelajaran,
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                            'id' => $id,
                            'dataGuru' => $dataGuru,
                            'modelMataPelajaran' => $modelMataPelajaran,
                            'modelGuru' => $modelGuru,

                        ]),
                        'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])

                    ];
                }
                // else if ($model->load($request->post())) {
                //    if ($id = '') {
                //     # code...
                //    }
                //     if ($model->save()) {
                //         return [
                //             'forceReload' => '#crud-datatable-pjax',
                //             'title' => "Tambah GuruMataPelajaran",
                //             'content' => '<span class="text-success">Create Guru Mata Pelajaran berhasil</span>',
                //             'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                //                 Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                //         ];
                //     }
                // } 
                else {
                    return [
                        'title' => "Tambah GuruMataPelajaran",
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
        } else {
            $model->id_guru = $id_guru;
            $model->id_mata_pelajaran = $id;
            if ($request->isAjax) {
                /*
            *   Process for ajax request
            */
                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($request->isGet) {
                    if ($model->save()) {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tambah Guru Mata Pelajaran",
                            'content' => $this->renderAjax('create', [ //catatan 'create' ganti 'index'
                                'model' => $model,
                                'dataMataPelajaran' => $dataMataPelajaran,
                                'dataProvider' => $dataProvider,
                                'searchModel' => $searchModel,
                                'id' => $id,
                                'dataGuru' => $dataGuru,
                                'modelMataPelajaran' => $modelMataPelajaran,
                                'modelGuru' => $modelGuru,

                            ]),
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])

                        ];
                    }
                } else {
                    return [
                        'title' => "Tambah GuruMataPelajaran",
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
    }

    /**
     * Updates an existing GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataGuru =  ArrayHelper::map(\common\models\Guru::find()->asArray()->all(), 'id', 'nama_guru');
        $dataMataPelajaran =  MataPelajaran::find()->where(['id' => $model->id_mata_pelajaran])->one();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah GuruMataPelajaran",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'dataGuru' => $dataGuru,
                        'dataMataPelajaran' => $dataMataPelajaran,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "GuruMataPelajaran ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah GuruMataPelajaran ",
                    'content' => $this->renderAjax('update', [
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
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
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
     * Delete multiple existing GuruMataPelajaran model.
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
     * Finds the GuruMataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuruMataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuruMataPelajaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
