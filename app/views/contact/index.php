<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;

$page = Page::get('page-contact');

$this->title = 'Contact us';
$this->params['breadcrumbs'][] = $page->model->title;
?>
<section class="job-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-7 co-xs-12 text-left">
                        <h3>Contact Us</h3>
                    </div>
                    <div class="col-md-6 col-sm-5 co-xs-12 text-right">
                        <div class="bread">
                            <ol class="breadcrumb">
                                <li><a href="#">Home</a> </li>
                                <li class="active">Contact Us 5</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact-us ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="Heading-title-left black small-heading">
                                    <h3>Get In Touch With us</h3>
                                </div>
                                
                               
                                <form class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Name <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Subject <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Message <span class="required">*</span></label>
                                            <textarea cols="6" rows="8" placeholder="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <a href="#" class="btn btn-default"> Send Message <i class="fa fa-angle-right"></i> </a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="Heading-title-left black small-heading">
                                    <h3>Contact Detail</h3>
                                </div>
                                <div class="contact_block-2">
                                    <div class="content-block-box">
                                        <div class="icon-box">
                                            <i class="icon-map-pin"></i>
                                        </div>
                                        <div class="detail-box">
                                            <p>102 PT Naino Street</p>
                                            <p>West smash road TW 456,</p>
                                            <p>London, UK</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="contact_block-2">
                                    <div class="content-block-box">
                                        <div class="icon-box">
                                            <i class=" icon-phone"></i>
                                        </div>
                                        <div class="detail-box">
                                            <p><b class="pull-left">Help Line</b><a href="tel:+99 333 1234567" class="pull-right">+99 333 1234567</a></p>
                                            <p><b class="pull-left">Enquires</b><a href="tel:+99 333 1234567" class="pull-right">+91 456 3692587</a></p>
                                            <p><b class="pull-left">Fax</b><a href="tel:+99 333 1234567" class="pull-right">+93 798 7412589</a></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="contact_block-2">
                                    <div class="content-block-box">
                                        <div class="icon-box">
                                            <i class="icon-document"></i>
                                        </div>
                                        <div class="detail-box">
                                            <p><a href="mailto:contact@scriptsbundle.com">contact@scriptsbundle.com</a></p>
                                            <p><a href="mailto:resume@user.com">admin@scriptsbundle.com</a></p>
                                            <p><a href="mailto:resume@user.com">info@scriptsbundle.com</a></p>
                                        </div>
                                    </div>

                                </div>
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


