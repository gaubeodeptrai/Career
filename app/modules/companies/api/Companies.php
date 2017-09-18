<?php
namespace app\modules\companies\api;

use Yii;
use yii\data\ActiveDataProvider;
use yii\easyii\models\Tag;
use yii\easyii\widgets\Fancybox;
use yii\widgets\LinkPager;

use app\modules\companies\models\Companies as CompaniesModel;

/**
 * Companies module API
 * @package app\modules\companies\api
 *
 * @method static CompaniesObject get(mixed $id_slug) Get companies object by id or slug
 * @method static array items(array $options = []) Get list of companies as CompaniesObject objects
 * @method static mixed last(int $limit = 1) Get last companies
 * @method static void plugin() Applies FancyBox widget on photos called by box() function
 * @method static string pages() returns pagination html generated by yii\widgets\LinkPager widget.
 * @method static \stdClass pagination() returns yii\data\Pagination object.
 */

class Companies extends \yii\easyii\components\API
{
    private $_adp;
    private $_last;
    private $_items;
    private $_item = [];

    public function api_items($options = [])
    {
        if(!$this->_items){
            $this->_items = [];

            //$with = ['seo'];
            $with = [];
             if(Yii::$app->getModule('admin')->activeModules['companies']->settings['enableTags']){
                //$with[] = 'tags';
            }
            $query = CompaniesModel::find()->with($with)->status(CompaniesModel::STATUS_ON);

            if(!empty($options['where'])){
                $query->andFilterWhere($options['where']);
            }
            if(!empty($options['tags'])){
                $query
                    ->innerJoinWith('tags', false)
                    ->andWhere([Tag::tableName() . '.name' => (new CompaniesModel)->filterTagValues($options['tags'])])
                    ->addGroupBy('companies_id');
            }
            if(!empty($options['orderBy'])){
                $query->orderBy($options['orderBy']);
            } else {
                $query->sortDate();
            }

            $this->_adp = new ActiveDataProvider([
                'query' => $query,
                'pagination' => !empty($options['pagination']) ? $options['pagination'] : []
            ]);

            foreach($this->_adp->models as $model){
                $this->_items[] = new CompaniesObject($model);
            }
        }
        return $this->_items;
    }

    public function api_get($id_slug)
    {
        if(!isset($this->_item[$id_slug])) {
            $this->_item[$id_slug] = $this->findCompanies($id_slug);
        }
        return $this->_item[$id_slug];
    }

    public function api_last($limit = 1)
    {
        if($limit === 1 && $this->_last){
            return $this->_last;
        }

        $with = ['seo'];
        if(Yii::$app->getModule('admin')->activeModules['companies']->settings['enableTags']){
            $with[] = 'tags';
        }

        $result = [];
        foreach(CompaniesModel::find()->with($with)->status(CompaniesModel::STATUS_ON)->sortDate()->limit($limit)->all() as $item){
            $result[] = new CompaniesObject($item);
        }

        if($limit > 1){
            return $result;
        } else {
            $this->_last = count($result) ? $result[0] : null;
            return $this->_last;
        }
    }

    public function api_plugin($options = [])
    {
        Fancybox::widget([
            'selector' => '.easyii-box',
            'options' => $options
        ]);
    }

    public function api_pagination()
    {
        return $this->_adp ? $this->_adp->pagination : null;
    }

    public function api_pages()
    {
        return $this->_adp ? LinkPager::widget(['pagination' => $this->_adp->pagination]) : '';
    }

    private function findCompanies($id_slug)
    {
        $companies = CompaniesModel::find()->where(['or', 'company_id=:id_slug', 'slug=:id_slug'], [':id_slug' => $id_slug])->status(CompaniesModel::STATUS_ON)->one();
        if($companies) {
            $companies->updateCounters(['views' => 1]);
            return new CompaniesObject($companies);
        } else {
            return null;
        }
    }
}