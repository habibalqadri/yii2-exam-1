<?php

namespace siswa\controllers;

use common\models\RefStatusWali;
use Yii;
use common\models\Siswa;
use common\models\SiswaWali;
use common\models\Wali;
use siswa\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
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
     * Lists all Siswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_user = Yii::$app->user->identity->id;
        $searchModel = new SiswaSearch();
        // echo $id_user;
        // exit;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['id_user' => $id_user]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Siswa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Siswa ",
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
     * Creates a new Siswa model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDetailWali($id)
    {
        $request = Yii::$app->request;

        $dataSiswa = Siswa::find()->where(['id' => $id])->one();

        $model = SiswaWali::find()->where(['id_siswa' => $id])->all();


        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Siswa ",
                'content' => $this->renderAjax('lihat_wali', [
                    'model' => $model,
                    'dataSiswa' => $dataSiswa

                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Tambah', ['tambah-wali'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('lihat_wali', [
                'model' => $model,
                'dataSiswa' => $dataSiswa

            ]);
        }
    }

    public function actionLihatDetailWali($id)
    {
        $request = Yii::$app->request;
        $modelWali = Wali::find()->where(['id' => $id])->one();

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Detail Wali ",
                'content' => $this->renderAjax('lihat_detail_wali', [
                    'modelWali' => $modelWali,

                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Ubah', ['ubah-wali', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'modelWali' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Wali model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Creates a new Siswa model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTambahWali()
    {
        $request = Yii::$app->request;
        $data = ArrayHelper::map(RefStatusWali::find()->all(), 'id', 'status_wali');
        $model = new Wali();
        $id_user = Yii::$app->user->identity->id;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah Wali",
                    'content' => $this->renderAjax('tambah_wali', [
                        'model' => $model,
                        'data' => $data,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {
                $siswa = Siswa::find()->where(['id_user' => $id_user])->one();
                // 
                $id_siswa = null;
                if ($siswa) {
                    $id_siswa = $siswa->id;
                }

                if ($model->save()) {
                    // $siswaWali = SiswaWali::find()->where(['id_siswa' => $id_siswa, 'id_wali' => $model->id])->one();
                    $siswaWali = new SiswaWali();

                    // if (!$siswaWali) {
                    //     $siswaWali = new SiswaWali();
                    // }

                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tambah Wali",
                            'content' => '<span class="text-success">Create Wali berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Tambah Lagi', ['tambah-wali'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    }
                }


                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Wali",
                    'content' => '<span class="text-danger">Create Wali gagal!</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])

                ];
            } else {
                return [
                    'title' => "Tambah Wali",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'data' => $data,

                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $siswa = Siswa::find()->where(['id_user' => $id_user])->one();
                // 
                $id_siswa = null;
                if ($siswa) {
                    $id_siswa = $siswa->id;
                }

                if ($model->save()) {
                    // $siswaWali = SiswaWali::find()->where(['id_siswa' => $id_siswa])->one();

                    // if (!$siswaWali) {
                    //     $siswaWali = new SiswaWali();
                    // }
                    $siswaWali = new SiswaWali();
                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('create', [
                    'model' => $model,
                    'data' => $data,

                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'data' => $data,

                ]);
            }
        }
    }

    public function actionUbahWali($id)
    {
        $request = Yii::$app->request;
        $model = Wali::find()->where(['id' => $id])->one();
        $data = ArrayHelper::map(RefStatusWali::find()->all(), 'id', 'status_wali');
        $id_user = Yii::$app->user->identity->id;
        $dataSiswa = Siswa::find()->where(['id_user' => $id_user])->one();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah Wali",
                    'content' => $this->renderAjax('ubah_wali', [
                        'model' => $model,
                        'data' => $data,
                    ]),

                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {

                $id_siswa = $model->siswaWali->id_siswa;


                if ($model->save()) {
                    $siswaWali = SiswaWali::find()->where(['id_siswa' => $id_siswa, 'id_wali' => $model->id])->one();


                    if (!$siswaWali) {
                        $siswaWali = new SiswaWali();
                    }
                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        $model = SiswaWali::find()->where(['id_siswa' => $dataSiswa->id])->one();
                        // $modelWali = Wali::find()->where(['id' => $id])->one();
                        return [

                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Wali ",

                            'content' => '<span class="text-success">Ubah Wali berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Kembali', ['detail-wali', 'id' => $model->id_siswa], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    }
                }


                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Wali",
                    'content' => '<span class="text-danger">Create Wali gagal!</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah Wali ",
                    'content' => $this->renderAjax('update', [
                        'data' => $data,
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
            if ($model->load($request->post())) {
                $id_siswa = $model->siswaWali->id_siswa;

                if ($model->save()) {
                    $siswaWali = SiswaWali::find()->where(['id_siswa' => $id_siswa])->one();

                    if (!$siswaWali) {
                        $siswaWali = new SiswaWali();
                    }
                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('create', [
                    'model' => $model,
                    'data' => $data,

                ]);
            } else {
                return $this->render('update', [
                    'data' => $data,
                    'model' => $model,
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
    /**
     * Updates an existing Wali model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionHapusWali($id)
    {
        $request = Yii::$app->request;

        $id_user = Yii::$app->user->identity->id;
        $dataSiswa = Siswa::find()->where(['id_user' => $id_user])->one();
        $model = SiswaWali::find()->where(['id_siswa' => $dataSiswa->id])->one();
        $modelWali = Wali::find()->where(['id' => $id])->one();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah Wali",
                    'content' => $this->renderAjax('hapus_wali', [
                        'model' => $modelWali,

                    ]),

                    // 'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    //     Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Hapus', ['hapus-data-wali', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            }

            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "Tambah Wali",
                'content' => '<span class="text-danger">Gagal menghapus wali!</span>',
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Kembali', ['detail-wali', 'id', $model->id_siswa], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        }
    }

    /**
     * Delete multiple existing Siswa model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionHapusDataWali($id)
    {
        $modelWali = Wali::find()->where(['id' => $id])->one();
        $id_user = Yii::$app->user->identity->id;
        $dataSiswa = Siswa::find()->where(['id_user' => $id_user])->one();
        $model = SiswaWali::find()->where(['id_siswa' => $dataSiswa->id])->one();
        $modelSiswaWali = SiswaWali::find()->where(['id_wali' => $id])->one();

        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($modelSiswaWali->delete() && $modelWali->delete()) {
            return [

                'forceReload' => '#crud-datatable-pjax',
                'title' => "Wali ",
                'content' => '<span class="text-success">Wali berhasil dihapus!</span>',
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Kembali', ['detail-wali', 'id' => $model->id_siswa], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        }
    }
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Siswa();
        $dataKelas =
            ArrayHelper::map(\common\models\Kelas::find()->asArray()->all(), 'id', 'nama_kelas');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah Siswa",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataKelas' => $dataKelas
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Siswa",
                    'content' => '<span class="text-success">Create Siswa berhasil</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Tambah Siswa",
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
     * Updates an existing Siswa model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataKelas =  ArrayHelper::map(\common\models\Kelas::find()->asArray()->all(), 'id', 'nama_kelas');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah Siswa",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'dataKelas' => $dataKelas
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Siswa ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah Siswa ",
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
     * Delete an existing Siswa model.
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
     * Delete multiple existing Siswa model.
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
     * Finds the Siswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Siswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
