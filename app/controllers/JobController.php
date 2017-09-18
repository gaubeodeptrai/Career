<?php

namespace app\controllers;

use yii\easyii\modules\catalog\api\Catalog;
use yii\easyii\modules\catalog\models\Item as Jobs;
use yii\data\Pagination;

class JobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //$Jobs = Jobs::find()->where(['status'=>1])->all();
        $query = Jobs::find()->where(['status'=>1])->orderBy(['time'=>SORT_DESC]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>10]);
        $Jobs = $query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
        return $this->render('index',[
            'Jobs'=>$Jobs,
            'pagination'=>$pagination, 
            'total'=>$query->count() 
        ]);
    }

    public function actionCat($slug)
    {
        $cat = \yii\easyii\modules\catalog\models\Category::findOne(['slug'=>$slug]);
        $query = Jobs::find()->where(['status'=>1])->andWhere(['category_id'=>$cat->category_id])->orderBy(['time'=>SORT_DESC]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>10]);
        $Jobs = $query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
        return $this->render('index',[
            'cat'=>$cat,
            'Jobs'=>$Jobs,
            'pagination'=>$pagination, 
            'total'=>$query->count() 
        ]);
    }

    public function actionSearch($text,$cat=0,$worktime='')
    {
        $text = filter_var($text, FILTER_SANITIZE_STRING);
        $cat = filter_var($cat, FILTER_VALIDATE_INT);
        $worktime = filter_var($worktime, FILTER_SANITIZE_STRING);
       
       
        if ($text != ''){
           $where_clause_text = 'title like "%'.$text.'%" '
                   . ' OR description like "%'.$text.'%"'
                   . ' OR requirement like "%'.$text.'%"'
                   . ' OR experience like "%'.$text.'%"'    
         ; 
        }else{
            $where_clause_text = '';
        }
        if ($cat <> 0){
            $where_clause_cat = 'category_id = '.$cat.''; 
        }else{
            $where_clause_cat = '';
        }
        if ($worktime != ''){
            $where_clause_worktime = 'work_time = "'.$worktime.'"'; 
        }else{
            $where_clause_worktime = '';
        }
       
        $query = Jobs::find()->where('status = 1')
                ->andWhere($where_clause_worktime)
                ->andWhere($where_clause_cat)
                ->andWhere($where_clause_text);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>10]);
        $results =$query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
        return $this->render('search', [
            'text' => $text,
            'Jobs' => $results,
            'pagination' =>$pagination,
            'total' => $query->count(),
            ]);
    }

    public function actionView($slug)
    {
        $item = Catalog::get($slug);
        //echo $item->model->company_id;
        $company = \app\modules\companies\models\Companies::findOne(['company_id'=>$item->model->company_id]);
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

        return $this->render('view', [
            'item' => $item,
            'company' => $company
        ]);
    }
}
