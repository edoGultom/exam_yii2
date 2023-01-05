<?php

namespace frontend\controllers;

use common\models\Barang;
use common\models\Pembayaran;
use common\models\Pembeli;
use Yii;
use common\models\Transaksi;
use frontend\models\PembelianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * PembelianController implements the CRUD actions for Transaksi model.
 */
class PembelianController extends Controller
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
     * Lists all Transaksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Transaksi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Transaksi ",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Ubah', ['update', $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Transaksi model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Transaksi();
        $refBarang =  ArrayHelper::map(Barang::find()->all(), 'id', function ($model) {
            return '[' . $model->kode_barang . ']' . ' - ' . $model->deskripsi;
        });
        $refPembeli = ArrayHelper::map(Pembeli::find()->all(), 'id', 'nama_pembeli');

        if ($request->isAjax) {
            /*
* Process for ajax request
*/
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah Transaksi",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'refBarang' => $refBarang,
                        'refPembeli' => $refPembeli,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->validate()) {
                $barang = Barang::findOne(['id' => $model->id_barang]);
                if ($barang) {
                    $model->total_bayar  = ($model->qty * ((100 - $barang->diskon) * $barang->harga) / 100);
                }
                $model->save();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Transaksi",
                    'content' => '<span class="text-success">Create Transaksi berhasil</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Tambah Transaksi",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'refBarang' => $refBarang,
                        'refPembeli' => $refPembeli,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
* Process for non-ajax request
*/
            if ($model->load($request->post()) && $model->save() && $model->validate()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'refBarang' => $refBarang,
                    'refPembeli' => $refPembeli,
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Transaksi model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBayar($id_transaksi)
    {
        $request = Yii::$app->request;
        $model = new Pembayaran();
        $transaksi = Transaksi::findOne(['id' => $id_transaksi]);
        $model->tgl_bayar = date('Y-m-d');
        $model->total_bayar = $transaksi->total_bayar;
        $model->id_transaksi = $id_transaksi;
        $model->save();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "Informasi",
                'content' => '<span class="text-success">Berhasil Bayar</span>',
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])

            ];
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $refBarang =  ArrayHelper::map(Barang::find()->all(), 'id', function ($model) {
            return '[' . $model->kode_barang . ']' . ' - ' . $model->deskripsi;
        });
        $refPembeli = ArrayHelper::map(Pembeli::find()->all(), 'id', 'nama_pembeli');

        if ($request->isAjax) {
            /*
* Process for ajax request
*/
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ubah Transaksi",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'refBarang' => $refBarang,
                        'refPembeli' => $refPembeli
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->validate() && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Transaksi ",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'refBarang' => $refBarang,
                        'refPembeli' => $refPembeli
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah Transaksi ",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'refBarang' => $refBarang,
                        'refPembeli' => $refPembeli
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
* Process for non-ajax request
*/
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'refBarang' => $refBarang,
                    'refPembeli' => $refPembeli
                ]);
            }
        }
    }

    /**
     * Delete an existing Transaksi model.
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
* Process for ajax request
*/
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
* Process for non-ajax request
*/
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Transaksi model.
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
* Process for ajax request
*/
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
* Process for non-ajax request
*/
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Transaksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}