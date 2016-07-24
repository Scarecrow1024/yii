<?PHP
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function actionIndex()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                //$model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);            
                $fileName='uploads/' . date("YmdHis") . '.' . $model->file->extension;
                $model->file->saveAs($fileName);
            }
            echo "<script src='js/upload.js'></script>;";
            echo "<script>";
            echo "var oneinput=parent.document.getElementById('product-picurl');";
            echo "parent.document.getElementById('product-picurl').value='".$fileName."';";
            echo "var oneupload = parent.document.getElementById('oneupload');";
            echo "var img = document.createElement('img');";
            echo "img.setAttribute('style', 'height:50px');";
            echo "img.src ='".$fileName."';";
            echo "insertAfter(img,oneinput);";
            echo "oneupload.parentNode.removeChild(oneupload)";
            echo "</script>";
        }

        return $this->render('upload', ['model' => $model]);
    }
}
?>