<?php
  use richardfan\widget\JSRegister;
  use yii\helpers\Url;
  $basePathToTemplate = Url::base(true).'/app/media/template/';
  $this->title = 'Carrer Builder'
?>
<section class="breadcrumb-search parallex" style="padding: 150px 0 200px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-md-offset-2 col-xs-12 nopadding">
                        <div class="search-form-contaner">
                            <h1 class="search-main-title" style="color: white"> Find Candidates </h1>
                               <?=$this->render('_search_form_company',[]);?>
                               
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

<section class="pricing-section-1 pricing-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="Heading-title black">
                                <h1>Resume Pricing</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Basic Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li class="cut"> Support </li>
                                            <li class="cut"> Access Resume </li>
                                            <li class="cut"> Contact Details </li>
                                            <li class="cut"> Interviews </li>
                                            <li class="cut"> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> Free<small>Always</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Premium Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li> Support </li>
                                            <li> Access Resume </li>
                                            <li class="cut"> Contact Details </li>
                                            <li class="cut"> Interviews </li>
                                            <li class="cut"> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> $29 <small>per month</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Standard Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li> Support </li>
                                            <li> Access Resume </li>
                                            <li> Contact Details </li>
                                            <li> Interviews </li>
                                            <li> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> $59 <small>per month</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 visible-sm">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Basic Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li class="cut"> Support </li>
                                            <li class="cut"> Access Resume </li>
                                            <li class="cut"> Contact Details </li>
                                            <li class="cut"> Interviews </li>
                                            <li class="cut"> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> Free<small>Always</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
 <?=$this->render('_blog',['basePathToTemplate'=>$basePathToTemplate])?>
    <?=$this->render('_client',['basePathToTemplate'=>$basePathToTemplate])?>
 