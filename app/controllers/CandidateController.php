<?php

namespace app\controllers;


use app\modules\candidates\models\Candidates;
use yii\easyii\modules\catalog\models\Category;
use yii\data\Pagination;
use yii\easyii\models\Tag;
use yii\easyii\models\TagAssign;
use dektrium\user\models\User;
Use app\modules\nationals\models\Nationals;
use app\models\Resume;


class CandidateController extends \yii\web\Controller
{
    public function actionIndex($skill = null)
    {
        $cat_jobs = Category::findAll(['status'=>1]);  
        $where_clause = '';
        if ($skill):
            $skill = filter_var($skill, FILTER_SANITIZE_STRING);
            $skill_id = Tag::find()->where(['like', 'name', $skill])->one()['tag_id'];
            $users = TagAssign::find()->where(['tag_id'=>$skill_id])->all();
            $count = 0;
            foreach ($users as $item):
               $count++;
                if ($count == 1):
                  $where_clause .= ' AND user_id = '.$item->item_id;
                 else:
                  $where_clause .= ' OR user_id = '.$item->item_id;   
                 endif;
            endforeach;
        endif;
        $query = Candidates::find()->where('status = 1 and category_id > 0'.$where_clause)->orderBy(['time'=>SORT_DESC]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>10]);
        $candidates = $query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
        return $this->render('index',[
            'candidates'=>$candidates,
            'pagination'=>$pagination, 
            'total'=>$query->count(),
            'cat_jobs' => $cat_jobs
        ]);
        
      
    }

    public function actionCat($slug)
    {
        $cat = Category::findOne(['slug'=>$slug]);
        $query = Candidates::find()->where('status = 1 and category_id ='.$cat->category_id)->orderBy(['time'=>SORT_DESC]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>10]);
        $candidates = $query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
        return $this->render('index',[
            'cat'=>$cat,
            'candidates'=>$candidates,
            'pagination'=>$pagination, 
            'total'=>$query->count(),
            'cat_jobs' => Category::findAll(['status'=>1])
        ]);
    }

    public function actionSearch($text,$cat=0,$worktime='')
    {
        
        $text = filter_var($text, FILTER_SANITIZE_STRING);
        $cat = filter_var($cat, FILTER_VALIDATE_INT);
        $worktime = filter_var($worktime, FILTER_SANITIZE_STRING);
       
        
         if ($cat){
            $where_clause_cat = 'category_id = '.$cat.''; 
        }else{
            $where_clause_cat = '';
        }
        
       
        if ($text != ''){
           $where_clause ='name like "%'.$text.'%"' 
                   . ' OR fullname like "%'.$text.'%" '
                   . ' OR sex like "%'.$text.'%"'
                   . ' OR visa_status like "%'.$text.'%"'
                   . ' OR place_of_residence like "%'.$text.'%"'
                   . ' OR about like "%'.$text.'%"'        
         ; 
        }else{
            $where_clause = '';
        }
  
        $query = Candidates::find()
                ->leftJoin('resume', 'resume.user_id = candidates.user_id')
                ->leftJoin('easyii_tags_assign', 'easyii_tags_assign.item_id = candidates.user_id')
                ->leftJoin('easyii_tags', 'easyii_tags.tag_id = easyii_tags_assign.tag_id')
                ->where('status = 1')->andWhere($where_clause)->andWhere($where_clause_cat)->distinct();
        
        $pagination = new Pagination(['totalCount' => count($query), 'pageSize'=>10]);
        $results =$query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
        return $this->render('search', [
            'text' => $text,
            'candidates' => $results,
            'pagination' =>$pagination,
            'total' => $query->count(),
            'cat_jobs' => Category::findAll(['status'=>1])
            ]);
    }

    public function actionView($slug)
    {
        $item = Candidates::findOne(['slug'=>$slug]);
        $category_job = Category::findOne(['category_id'=>$item->category]);
        $user = User::findIdentity($item->user_id);
        $national = Nationals::findOne(['national_id'=>$item->nationality_id]);
        $resume = Resume::findOne(['user_id'=>$item->user_id]);
        //echo $item->model->company_id;
       // $company = \app\modules\companies\models\Companies::findOne(['company_id'=>$item->model->company_id]);
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

        return $this->render('view', [
            'item' => $item,
            'category_job' => $category_job,
            'user' => $user,
            'national' =>$national,
            'resume'=>$resume
        ]);
    }
}
