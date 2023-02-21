<?php

namespace admin\controllers;

use Yii;
use common\models\Kelas;
use admin\models\KelasSearch;
use common\models\RefTahunAjaran;
use common\models\Siswa;
use common\models\SiswaRwKelas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;



/**
 * KelasController implements the CRUD actions for Kelas model.
 */
class KelasController extends Controller
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
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Kelas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;


        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Kelas ",
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
     * Creates a new Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Kelas();
        $dataTahunAjaran =
            ArrayHelper::map(\common\models\RefTahunAjaran::find()->all(), 'id', 'tahun_ajaran');
        $dataTingkatKelas =  ArrayHelper::map(\common\models\RefTingkatKelas::find()->all(), 'id', 'tingkat_kelas');
        $dataWaliKelas =  ArrayHelper::map(\common\models\Guru::find()->all(), 'id', 'nama_guru');
        $dataJurusan =  ArrayHelper::map(\common\models\RefJurusan::find()->all(), 'id', 'jurusan');


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah Kelas",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataTahunAjaran' => $dataTahunAjaran,
                        'dataTingkatKelas' => $dataTingkatKelas,
                        'dataWaliKelas' => $dataWaliKelas,
                        'dataJurusan' => $dataJurusan
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {

                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Kelas",
                    'content' => '<span class="text-success">Create Kelas berhasil</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Tambah Kelas",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataTahunAjaran' => $dataTahunAjaran,
                        'dataTingkatKelas' => $dataTingkatKelas,
                        'dataWaliKelas' => $dataWaliKelas,
                        'dataJurusan' => $dataJurusan
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
                    'dataTahunAjaran' => $dataTahunAjaran,
                    'dataTingkatKelas' => $dataTingkatKelas,
                    'dataWaliKelas' => $dataWaliKelas,
                    'dataJurusan' => $dataJurusan
                ]);
            }
        }
    }
    public function actionTambahSiswa($id)
    {
        $request = Yii::$app->request;
        $modelKelas = $this->findModel($id);
        $model = Siswa::find()->where(['id_kelas' => null])->one();
        $dataSiswa = ArrayHelper::map(Siswa::find()->where(['id_kelas' => null])->all(), 'id', 'nama');


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah Siswa",
                    'content' => $this->renderAjax('_form_tambah_siswa', [
                        'model' => $model,
                        'dataSiswa' => $dataSiswa,

                    ]),
                    'footer' => ($dataSiswa) ? Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"]) : ''

                ];
            } else if ($model->load($request->post())) {

                // echo "<pre>";
                // print_r($model->id_kelas);
                // echo "</pre>";
                // exit();


                foreach ($model->id_kelas as $value) {

                    $findSiswa = Siswa::find()->where(['id' => $value])->one();
                    $findSiswa->id_kelas = $id;
                    $findSiswa->save();

                    $SiswaRwKelas = new SiswaRwKelas();
                    $SiswaRwKelas->id_siswa = $findSiswa->id;
                    $SiswaRwKelas->id_kelas = $id;
                    $SiswaRwKelas->id_tahun_ajaran = $modelKelas->id_tahun_ajaran;
                    $SiswaRwKelas->nama_kelas = $modelKelas->nama_kelas;
                    $SiswaRwKelas->id_tingkat = $modelKelas->id_tingkat;
                    $SiswaRwKelas->id_wali_kelas = $modelKelas->id_wali_kelas;
                    $SiswaRwKelas->save();
                }
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Siswa",
                    'content' => '<span class="text-success">Tambah Siswa berhasil</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['tambahSiswa'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Tambah Kelas",
                    'content' => $this->renderAjax('_form_tambah_siswa', [
                        'model' => $model,
                        'dataSiswa' => $dataSiswa,

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
                return $this->render('_form_tambah_siswa', [
                    'model' => $model,
                    'dataSiswa' => $dataSiswa,
                ]);
            }
        }
    }

    /**
     * Updates an existing Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataTahunAjaran =
            ArrayHelper::map(\common\models\RefTahunAjaran::find()->asArray()->all(), 'id', 'tahun_ajaran');
        $dataTingkatKelas =  ArrayHelper::map(\common\models\RefTingkatKelas::find()->asArray()->all(), 'id', 'tingkat_kelas');
        $dataWaliKelas =  ArrayHelper::map(\common\models\Guru::find()->asArray()->all(), 'id', 'nama_guru');
        $dataJurusan =  ArrayHelper::map(\common\models\RefJurusan::find()->asArray()->all(), 'id', 'jurusan');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah Kelas",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'dataTahunAjaran' => $dataTahunAjaran,
                        'dataTingkatKelas' => $dataTingkatKelas,
                        'dataWaliKelas' => $dataWaliKelas,
                        'dataJurusan' => $dataJurusan
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Kelas ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah Kelas ",
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
     * Delete an existing Kelas model.
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
     * Delete multiple existing Kelas model.
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
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    // protected function findModel2()
    // {

    //     if (($model = Siswa::findOne($)) !== null) {
    //         return $model;
    //     } else {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }
    // }
}
