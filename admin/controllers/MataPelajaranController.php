<?php

namespace admin\controllers;

use Yii;
use common\models\MataPelajaran;
use admin\models\MataPelajaranSearch;
use common\models\GuruMataPelajaran;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * MataPelajaranController implements the CRUD actions for MataPelajaran model.
 */
class MataPelajaranController extends Controller
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
     * Lists all MataPelajaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MataPelajaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        // $query = MataPelajaran::find();
        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [
        //         'pageSize' => 5
        //     ]
        // ]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }


    /**
     * Displays a single MataPelajaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "MataPelajaran ",
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
     * Creates a new MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MataPelajaran();
        $dataTingkatKelas =  ArrayHelper::map(\common\models\RefTingkatKelas::find()->asArray()->all(), 'id', 'tingkat_kelas');
        $dataJurusan =  ArrayHelper::map(\common\models\RefJurusan::find()->asArray()->all(), 'id', 'jurusan');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah MataPelajaran",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataTingkatKelas' => $dataTingkatKelas,
                        'dataJurusan' => $dataJurusan,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah MataPelajaran",
                    'content' => '<span class="text-success">Create MataPelajaran berhasil</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Tambah MataPelajaran",
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
     * Updates an existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataTingkatKelas =  ArrayHelper::map(\common\models\RefTingkatKelas::find()->asArray()->all(), 'id', 'tingkat_kelas');
        $dataJurusan =  ArrayHelper::map(\common\models\RefJurusan::find()->asArray()->all(), 'id', 'jurusan');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah MataPelajaran",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'dataTingkatKelas' => $dataTingkatKelas,
                        'dataJurusan' => $dataJurusan,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "MataPelajaran ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah MataPelajaran ",
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
     * Delete an existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->deleteGuruMapel($id);
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
     * Delete multiple existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        // $row = explode(',', $request->post('pilihHapus')); // Array or selected records primary keys
        $row = $request->post('pilihHapus'); // Array or selected records primary keys


        // foreach ($row as $value) {
        //     $model = $this->findModel($value);
        //     $model->delete();
        // }


        // if ($request->isPost) {
        //     $row = $request->post('pilihHapus');
        //     if ($request->post('pilihHapus')) {
        //         foreach ($row as $value) {
        //             $mapel = $this->findModel($value);
        //             $mapel->delete();
        //         }

        //         Yii::$app->response->format = Response::FORMAT_JSON;
        //         return [
        //             'forceReload' => '#crud-datatable-pjax',
        //             'title' => "MataPelajaran ",
        //             'content' => '<span class="text-success">Data berhasil Dihapus</span>',
        //             'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
        //         ];
        //     } else {
        //         Yii::$app->response->format = Response::FORMAT_JSON;
        //         return [
        //             'forceReload' => '#crud-datatable-pjax',
        //             'title' => "Peringatan ",
        //             'content' =>
        //             '<span class="text-danger">Pilih Data Terlebih Dahulu!</span>',
        //             'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
        //         ];
        //     }
        // }

        if ($row) {
            if ($request->isAjax) {

                /*
            *   Process for ajax request
            */
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "MataPelajaran ",
                    'content' =>
                    print_r($row),
                    exit(),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
                ];
                // Yii::$app->response->format = Response::FORMAT_JSON;
                // return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
            } else {
                /*
            *   Process for non-ajax request
            */
                return $this->redirect(['index']);
            }
        }
    }

    /**
     * Finds the MataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MataPelajaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
