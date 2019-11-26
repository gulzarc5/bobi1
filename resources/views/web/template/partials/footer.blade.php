        <!-- footer-area-start -->
        <footer>
            <!-- footer-top-start -->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-top-menu bb-2">
                                <nav>
                                    <ul>
                                        <li><a href="{{route('web.index')}}">home</a></li>
                                        <li><a href="{{route('web.thankyou.contact')}}">contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-top-start -->
            <!-- footer-mid-start -->
            <div class="footer-mid ptb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="single-footer br-2 xs-mb">
                                        <div class="footer-title mb-20">
                                            <h3>Products</h3>
                                        </div>
                                        <div class="footer-mid-menu" style="display: flex;">
                                            <ul style="margin-right: 134px;">
                                                <li><a href="{{route('web.new_book_list')}}">Books</a></li>
                                                <li><a href="{{route('web.old_book_list')}}">Old Books</a></li>
                                                <li><a href="{{route('web.project_list')}}">Projects </a></li>
                                            </ul>
                                            <ul>    
                                                <li><a href="{{route('web.megazine_list')}}">Magazines</a></li>
                                                <li><a href="{{route('web.quiz_list')}}">Quiz</a></li>
                                                <li><a href="{{route('web.thankyou.tips')}}">Tips & Tricks</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                    <div class="single-footer br-2 xs-mb">
                                        <div class="footer-title mb-20">
                                            <h3>Our company</h3>
                                        </div>
                                        <div class="footer-mid-menu">
                                            <ul>
                                                <li><a href="{{route('web.thankyou.t&c')}}">Return policy</a></li>
                                                <li><a href="{{route('web.thankyou.t&c')}}">Terms and Conditions</a></li>
                                                <li><a href="{{route('web.thankyou.t&c')}}">Disclamer </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                    <div class="single-footer br-2 xs-mb">
                                        <div class="footer-title mb-20">
                                            <h3>Your account</h3>
                                        </div>
                                        <div class="footer-mid-menu">
                                            <ul>
                                                <li><a href="{{route('web.user.membership')}}">Membership </a></li>
                                                <li><a href="{{route('web.user_login')}}">Sign in </a></li>
                                                <li><a href="{{route('web.signup')}}">Sign up</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="single-footer mrg-sm">
                                <div class="footer-title mb-20">
                                    <h3> INFORMATION</h3>
                                </div>
                                <div class="footer-contact">
                                    <p class="adress">
                                        <span>Edujiyaan : Guwahati, Assam</span>                                       
                                    </p>
                                    <p><span>Call us now :</span> +91-9706665232 </p>
                                    <p><span>Email :</span> info@edujiyaan.com </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-mid-end -->
            <!-- footer-bottom-start -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row bt-2">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="copy-right-area">
                                <p>Copyright © <a>edujiyaan.com</a>. All Right Reserved  ||  Developed By <a href="https://www.webinfotech.net.in">Webinfotech</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="payment-img text-right">
								<a><img src="{{asset('web/img/1.png')}}" alt="payment" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer-bottom-end -->
		</footer>
        <!-- all js here -->
        <!-- jquery latest version -->
        <script src="{{asset('web/js/vendor/jquery-1.12.0.min.js')}}"></script>
        <!-- bootstrap js -->
        <script src="{{asset('web/js/bootstrap.min.js')}}"></script>
        <!-- owl.carousel js -->
        <script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
        <!-- meanmenu js -->
        <script src="{{asset('web/js/jquery.meanmenu.js')}}"></script>
        <!-- wow js -->
        <script src="{{asset('web/js/wow.min.js')}}"></script>
        <!-- jquery.parallax-1.1.3.js -->
        <script src="{{asset('web/js/jquery.parallax-1.1.3.js')}}"></script>
        <!-- jquery.countdown.min.js -->
        <script src="{{asset('web/js/jquery.countdown.min.js')}}"></script>
        <!-- jquery.flexslider.js -->
        <script src="{{asset('web/js/jquery.flexslider.js')}}"></script>
        <!-- chosen.jquery.min.js -->
        <script src="{{asset('web/js/chosen.jquery.min.js')}}"></script>
        <!-- jquery.counterup.min.js -->
        <script src="{{asset('web/js/jquery.counterup.min.js')}}"></script>
        <!-- waypoints.min.js -->
        <script src="{{asset('web/js/waypoints.min.js')}}"></script>
        <!-- plugins js -->
        <script src="{{asset('web/js/plugins.js')}}"></script>
        <!-- main js -->
        <script src="{{asset('web/js/main.js')}}"></script>
    </body>

</html>