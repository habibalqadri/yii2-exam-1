<?php

namespace admin\controllers;

use Yii;
use common\models\Siswa;
use admin\models\SiswaSearch;
use common\models\AuthAssignment;
use common\models\Kelas;
use common\models\User;
use common\models\RefStatusWali;
use common\models\SignupForm;
use common\models\SiswaRwKelas;
use common\models\UserPengguna;
use yii\data\ActiveDataProvider;
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
        $searchModel = new SiswaSearch();

        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Siswa::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }
    public function actionIndex2($id)
    {
        $id_kelas = Kelas::find()->where(['id' => $id])->one();
        $searchModel = new SiswaSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['id_kelas' => $id_kelas->id]);

        $request = Yii::$app->request;

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "List Siswa ",
                // 'content' => $this->renderAjax('view', [
                //     'model' => $this->findModel($id),

                // ]),
                'content' => $this->renderAjax('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,

                ]),

                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
            ];
        } else {

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

            ]);
        }


        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,

        // ]);
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
    public function actionLihatAkun($id)
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Siswa ",
                'content' => $this->renderAjax('lihat_akun', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Ubah Akun', ['ubah-akun', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
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
    public function actionBuatAkun($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataUser = new SignupForm();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Buat Akun",
                    'content' => $this->renderAjax('buat_akun', [
                        // 'model' => $model,
                        'dataUser' => $dataUser,

                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($dataUser->load(Yii::$app->request->post()) && $dataUser->signup()) {
                // && $dataUser->signup()

                $user = User::find()->orderBy(['id' => SORT_DESC])->one();
                $model->id_user = $user->id;

                if ($model->save()) {
                    $modelAuth = new AuthAssignment();
                    $modelAuth->item_name = 'Siswa';
                    $modelAuth->user_id = $user->id;
                    if ($modelAuth->save()) {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tambah Akun",
                            'content' => '<span class="text-success">Tambah Akun berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
                            // .
                            //     Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                        ];
                    }
                }
            } else {
                return [
                    'title' => "Tambah Akun",
                    'content' => $this->renderAjax('buat_akun', [
                        // 'model' => $model,
                        'dataUser' => $dataUser,
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
                    // 'dataUser' => $dataUser,
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

    public function actionUbahAkun($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $dataUser = UserPengguna::find()->where(['id' => $model->id_user])->one();


        // echo $dataUser;
        // exit;
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah Siswa",
                    'content' => $this->renderAjax('ubah_akun', [

                        'dataUser' => $dataUser

                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($dataUser->load(Yii::$app->request->post()) && $dataUser->save(false)) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Siswa ",
                    'content' => $this->renderAjax('lihat_akun', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
                ];
            } else {
                return [
                    'title' => "Ubah Akun",
                    'content' => $this->renderAjax('ubah_akun', [
                        'dataUser' => $dataUser,
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

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Siswa();
        $dataKelas = ArrayHelper::map(Kelas::find()->all(), 'id', 'nama_kelas');


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
                        'dataKelas' => $dataKelas,

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
                    'dataKelas' => $dataKelas,
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
            } else if ($model->load($request->post())) {

                $modelKelas = Kelas::find()->where(['id' => $model->id_kelas])->one();
                $modelRiwayat = SiswaRwKelas::find()->where(['id_siswa' => $model->id, 'id_tahun_ajaran' => $modelKelas->id_tahun_ajaran])->one();

                if ($modelRiwayat) {
                    $modelRiwayat->id_kelas = $model->id_kelas;
                    $modelRiwayat->nama_kelas = $modelKelas->nama_kelas;

                    if ($modelRiwayat->save() && $model->save()) {

                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Ubah Siswa",
                            'content' => '<span class="text-success">Ubah Siswa berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
                        ];
                    }
                } else {
                    $SiswaRwKelas = new SiswaRwKelas();
                    $SiswaRwKelas->id_siswa = $model->id;
                    $SiswaRwKelas->id_kelas = $model->id_kelas;
                    $SiswaRwKelas->nama_kelas = $modelKelas->nama_kelas;

                    $modelKelas = Kelas::find()->where(['id' => $model->id_kelas])->one();
                    $SiswaRwKelas->id_tahun_ajaran = $modelKelas->id_tahun_ajaran;
                    $SiswaRwKelas->nama_kelas = $modelKelas->nama_kelas;
                    $SiswaRwKelas->id_tingkat = $modelKelas->id_tingkat;
                    $SiswaRwKelas->id_wali_kelas = $modelKelas->id_wali_kelas;

                    if ($model->save() && $SiswaRwKelas->save()) {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Ubah Siswa",
                            'content' => '<span class="text-success">Ubah Siswa berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Tambah Lagi', ['tambahSiswa'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    } else {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Ubah Siswa",
                            'content' => '<span class="text-danger">Ubah Siswa Gagal</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
                        ];
                    }
                }
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

        $modelSiswa = Siswa::find()->where(['id' => $id])->one();


        if ($modelSiswa->id_user == null) {
            $modelRiwayat = SiswaRwKelas::find()->where(['id_siswa' => $id])->one();
            if ($modelRiwayat) {
                $modelRiwayat->deleteAll(['id_siswa' => $id]);
            }

            $this->findModel($id)->delete();
        } else {
            $modelUser = User::find()->where(['id' => $modelSiswa->id_user])->one();
            $modelAuth = AuthAssignment::find()->where(['user_id' => $modelUser->id])->one();
            $modelAuth->delete();
            $modelUser->delete();

            $modelRiwayat = SiswaRwKelas::find()->where(['id_siswa' => $id])->one();
            if ($modelRiwayat) {
                $modelRiwayat->deleteAll(['id_siswa' => $id]);
            }

            $this->findModel($id)->delete();
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
