<?php

namespace admin\controllers;

use Yii;
use common\models\SiswaRwKelas;
use admin\models\SiswaRwKelasSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * SiswaRwKelasController implements the CRUD actions for SiswaRwKelas model.
 */
class SiswaRwKelasController extends Controller
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
     * Lists all SiswaRwKelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiswaRwKelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //kode dibawa untuk ngecek sql si lefjoinnya jalan atau tidak
        // var_dump($dataProvider->query->createCommand()->getRawSql());
        // exit;
        //end code 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single SiswaRwKelas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "SiswaRwKelas ",
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
     * Creates a new SiswaRwKelas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new SiswaRwKelas();
        $dataSiswa =  ArrayHelper::map(\common\models\Siswa::find()->asArray()->all(), 'id', 'nama');
        $dataKelas =  ArrayHelper::map(\common\models\Kelas::find()->asArray()->all(), 'id', 'nama_kelas');
        $dataTahunAjaran =  ArrayHelper::map(\common\models\RefTahunAjaran::find()->asArray()->all(), 'id', 'tahun_ajaran');
        $dataTingkat =  ArrayHelper::map(\common\models\RefTingkatKelas::find()->asArray()->all(), 'id', 'tingkat_kelas');
        $dataGuru =  ArrayHelper::map(\common\models\Guru::find()->asArray()->all(), 'id', 'nama_guru');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah SiswaRwKelas",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataSiswa' => $dataSiswa,
                        'dataKelas' => $dataKelas,
                        'dataTahunAjaran' => $dataTahunAjaran,
                        'dataTingkat' => $dataTingkat,
                        'dataGuru' => $dataGuru,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah SiswaRwKelas",
                    'content' => '<span class="text-success">Create SiswaRwKelas berhasil</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Tambah SiswaRwKelas",
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
     * Updates an existing SiswaRwKelas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataSiswa =  ArrayHelper::map(\common\models\Siswa::find()->asArray()->all(), 'id', 'nama');
        $dataKelas =  ArrayHelper::map(\common\models\Kelas::find()->asArray()->all(), 'id', 'nama_kelas');
        $dataTahunAjaran =  ArrayHelper::map(\common\models\RefTahunAjaran::find()->asArray()->all(), 'id', 'tahun_ajaran');
        $dataTingkat =  ArrayHelper::map(\common\models\RefTingkatKelas::find()->asArray()->all(), 'id', 'tingkat_kelas');
        $dataGuru =  ArrayHelper::map(\common\models\Guru::find()->asArray()->all(), 'id', 'nama_guru');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah SiswaRwKelas",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'dataSiswa' => $dataSiswa,
                        'dataKelas' => $dataKelas,
                        'dataTahunAjaran' => $dataTahunAjaran,
                        'dataTingkat' => $dataTingkat,
                        'dataGuru' => $dataGuru,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "SiswaRwKelas ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah SiswaRwKelas ",
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
     * Delete an existing SiswaRwKelas model.
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
     * Delete multiple existing SiswaRwKelas model.
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
     * Finds the SiswaRwKelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SiswaRwKelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiswaRwKelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
