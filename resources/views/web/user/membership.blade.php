        @extends('web.template.master')
        <!-- Head & Header Section -->
        @section('content') 
        <!-- breadcrumbs-area-start -->
        <div class="breadcrumbs-area mb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumbs-menu">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#" class="active">Membership</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumbs-area-end -->
        <!-- entry-header-area-start -->
        <div class="entry-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-5 mb-30" style="text-align: center;">
                            <h2>Membership</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- entry-header-area-end -->
        <!-- checkout-area-start -->
        <div class="checkout-area membership user-detail pt-20 mb-70">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-3 card_main bronze">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Bronze</h3>
                            </div>
                            <div class="panel-body">
                                <div class="the-price">
                                    <h1>Rs 200<span class="subscript"></span></h1>
                                    <small>For 3 month</small>
                                </div>
                                <div class="facility">
                                    @if (isset($member_ship_plan) && $member_ship_plan == '3M')
                                        <p>Expire on - {{$expiry_date}}</p>
                                    @else
                                        <p>Veiw all megazine</p>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="panel-footer">
                                @if (isset($member_ship_plan) && $member_ship_plan == '3M')
                                    <a href="{{route('web.checkout.membership-checkout',['id'=>encrypt(1)])}}" class="btn btn-primary" role="button">Renew MemberShip</a> 
                                @else
                                    <a href="{{route('web.checkout.membership-checkout',['id'=>encrypt(1)])}}" class="btn btn-success" role="button">Proceed To Checkout</a>                                    
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 silver">
                        <div class="panel panel-success">
                            <div class="cnrflash">
                                <div class="cnrflash-inner">
                                    <span class="cnrflash-label">MOST<br>POPULAR</span>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <h3 class="panel-title">Silver</h3>
                            </div>
                            <div class="panel-body">
                                <div class="the-price">
                                    <h1>
                                        Rs 400<span class="subscript"></span></h1>
                                    <small>For 6 month</small>
                                </div>
                                <div class="facility">
                                    @if (isset($member_ship_plan) && $member_ship_plan == '6M')
                                        <p>Expire on - {{$expiry_date}}</p>
                                    @else
                                        <p>Veiw all megazine</p>
                                    @endif
                                </div>
                            </div>
                            <div class="panel-footer">
                                @if (isset($member_ship_plan) && $member_ship_plan == '6M')
                                    <a href="{{route('web.checkout.membership-checkout',['id'=>encrypt(2)])}}" class="btn btn-primary" role="button">Renew MemberShip</a>
                                @else
                                    <a href="{{route('web.checkout.membership-checkout',['id'=>encrypt(2)])}}" class="btn btn-success" role="button">Proceed To Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 gold">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Gold</h3>
                            </div>
                            <div class="panel-body">
                                <div class="the-price">
                                    <h1>Rs 800<span class="subscript"></span></h1>
                                    <small>For 1 year</small>
                                </div>
                                <div class="facility">
                                    @if (isset($member_ship_plan) && $member_ship_plan == '1Y')
                                        <p>Expire on - {{$expiry_date}}</p>
                                    @else
                                        <p>Veiw all megazine</p>
                                    @endif
                                </div>
                            </div>
                            <div class="panel-footer">
                                @if (isset($member_ship_plan) && $member_ship_plan == '1Y')
                                    <a href="{{route('web.checkout.membership-checkout',['id'=>encrypt(3)])}}" class="btn btn-primary" role="button">Renew MemberShip</a>
                                @else
                                    <a href="{{route('web.checkout.membership-checkout',['id'=>encrypt(3)])}}" class="btn btn-success" role="button">Proceed To Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area-end -->
        @endsection