@extends('user.dashboard_layout')

@section('content')


<section id="blog">
    <div class="blog container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-item">
                    <a href="javascript:void(0)">
                    	<img class="img-responsive img-blog" src="{{ asset('/theme/images/blog1.png') }}" width="100%" alt="" />
                    </a>
                    <div class="blog-content">
                        <a href="javascript:void(0)" class="blog_cat">UI/UX DESIGN</a>
                        <h2><a href="javascript:void(0)">Consequat bibendum quam liquam viverra</a></h2>
                        <h3>Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.</h3>
                        <a class="readmore" href="javascript:void(0)">Read More <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <!--/.blog-item-->

                <div class="blog-item">
                    <a href="javascript:void(0)"><img class="img-responsive img-blog" src="images/blog2.png" width="100%" alt="" /></a>
                    <div class="blog-content">
                        <a href="javascript:void(0)" class="blog_cat">UI/UX DESIGN</a>
                        <h2><a href="javascript:void(0)">Consequat bibendum quam liquam viverra</a></h2>
                        <h3>Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.</h3>
                        <a class="readmore" href="javascript:void(0)">Read More <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <!--/.blog-item-->

                <div class="blog-item">
                    <a href="javascript:void(0)">
                    	<img class="img-responsive img-blog" src="images/blog3.png" width="100%" alt="" />
                    </a>
                    <div class="blog-content">
                        <a href="javascript:void(0)" class="blog_cat">UI/UX DESIGN</a>
                        <h2><a href="javascript:void(0)">Consequat bibendum quam liquam viverra</a></h2>
                        <h3>Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.</h3>
                        <a class="readmore" href="javascript:void(0)">Read More <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <!--/.blog-item-->
                
            </div>
            <!--/.col-md-8-->
            <div class="col-md-4">
                <a href="{{ route('user.membership.pricing') }}" class="btn btn-primary col-sm-12">
                    <i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Join as Artist
                </a>
            </div>

            <aside class="col-md-4">
                <div class="widget search">
                    <form role="form">
                        <input type="text" class="form-control search_box" autocomplete="off" placeholder="Search Here">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!--/.search-->
                <div class="widget archieve">
                    <h3>Categories</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="blog_archieve">
                                <li><a href="javascript:void(0)">December 2013 <span class="pull-right">(97)</span></a></li>
                                <li><a href="javascript:void(0)">November 2013 <span class="pull-right">(32)</span></a></li>
                                <li><a href="javascript:void(0)">October 2013 <span class="pull-right">(19)</span></a></li>
                                <li><a href="javascript:void(0)">September 2013 <span class="pull-right">(08)</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/.archieve-->

                <div class="widget popular_post">
                    <h3>Popular Post</h3>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="{{ asset('/theme/images/post1.png') }}" alt="">
                                <p>Can you get free games for you</p>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="{{ asset('/theme/images/post2.png') }}" alt="">
                                <p>Can you get free games for you</p>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="{{ asset('/theme/images/post3.png') }}" alt="">
                                <p>Can you get free games for you</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--/.archieve-->
                

                <div class="widget blog_gallery">
                    <h3>Our Gallery</h3>
                    <ul class="sidebar-gallery clearfix">
                        <li>
                            <a href="javascript:void(0)">
                            	<img src="{{ asset('/theme/images/sidebar-g-1.png') }}" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            	<img src="{{ asset('/theme/images/sidebar-g-2.png') }}" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            	<img src="{{ asset('/theme/images/sidebar-g-3.png') }}" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            	<img src="{{ asset('/theme/images/sidebar-g-4.png') }}" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            	<img src="{{ asset('/theme/images/sidebar-g-5.png') }}" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            	<img src="{{ asset('/theme/images/sidebar-g-6.png') }}" alt="" />
                            </a>
                        </li>
                    </ul>
                </div>
                <!--/.blog_gallery-->
                
                <div class="widget social_icon">
                    <a href="javascript:void(0)" class="fa fa-facebook"></a>
                    <a href="javascript:void(0)" class="fa fa-twitter"></a>
                    <a href="javascript:void(0)" class="fa fa-linkedin"></a>
                    <a href="javascript:void(0)" class="fa fa-pinterest"></a>
                    <a href="javascript:void(0)" class="fa fa-github"></a>
                </div>
            </aside>
        </div>
        <!--/.row-->
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="pagination pagination-lg">
                    <li><a href="javascript:void(0)"><i class="fa fa-long-arrow-left"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">1</a></li>
                    <li><a href="javascript:void(0)">2</a></li>
                    <li><a href="javascript:void(0)">3</a></li>
                    <li><a href="javascript:void(0)">4</a></li>
                    <li><a href="javascript:void(0)">5</a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-long-arrow-right"></i></a></li>
                </ul>
                <!--/.pagination-->
            </div>
        </div>
    </div>
</section>


@endsection