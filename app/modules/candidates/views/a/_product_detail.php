<?php
    use yii\helpers\Html;
    $homePath = \yii\helpers\Url::base(true);
?>
<div id='product_detail'>
    <h3>
        <?php if($quantity_of_inventory == 0):?>
            <?php echo $model->title. ' - <span style="color: red">Hết hàng</span>'?>
        <?php else :?>
            <?php echo $model->title. ' - <span style="color: red">Còn trong kho : '.$quantity_of_inventory.' sản phẩm</span>'?>
        <?php endif; ?>
    </h3>


    <div class="row">
        <div class='col-sm-3'>
            <div id='product_img_thumbnail'>
                <img src='<?= $homePath . $model->image ?>' style='padding: 2px; width: 100%'/>
                <div>Published : <?= date('d-m-Y', $model->time) ?></div>
            </div>
        </div>
        
        <div class="col-sm-6  col-sm-offset-1">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="danger">
                        <td colspan="2" class="text-center text-danger">
                            Sell Amount
                        </td>
                    </tr>
                    
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left text-bold" >Quantity of sale</th>
                        <td class="text-right"><?= $model->quantity_of_sale.' Sản phẩm'?></td>
                        
                    </tr>
                    <tr>
                        <td class="text-left text-bold">Price</th>
                        <td class="text-right"><?= $model->price.' VNĐ'?></td>
                    </tr>
                    
                    <tr>
                        <td class="text-left text-bold">Total</th>
                        <td class="text-right"><?= $model->price*$model->quantity_of_sale.' VNĐ'?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-sm-1">
            <div class="kv-button-stack">
                <?= 
                    Html::a('<span class="glyphicon glyphicon-shopping-cart"></i>',
                            ['#'],
                            [
                                'class' => 'btn btn-default btn-lg',
                                'style' => 'border-radius: 6px !important; margin-top: 10px',
                                'title' => Yii::t('kvgrid', 'Add Book'),
                            ])
                ?>
                
                <?= 
                    Html::a('<span class="glyphicon glyphicon-earphone"></i>',
                            ['#'],
                            [
                                'class' => 'btn btn-default btn-lg',
                                'style' => 'border-radius: 6px !important',
                                'title' => Yii::t('kvgrid', 'Call for detail'),
                            ])
                ?>
                
                <?= 
                    Html::a('<span class="glyphicon glyphicon-envelope"></i>',
                            ['#'],
                            [
                                'class' => 'btn btn-default btn-lg',
                                'style' => 'border-radius: 6px !important',
                                'title' => Yii::t('kvgrid', 'Email for detail'),
                            ])
                ?>
            </div>
        </div>
    </div>
</div>