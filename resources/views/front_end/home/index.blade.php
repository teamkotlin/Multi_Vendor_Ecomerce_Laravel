@extends('front_end.home.dashboard')
@section('user')
    @include('front_end.home.home_slider')
    <!--End hero slider-->
    @include('front_end.home.home_featured_categories')
    <!--End category slider-->
    @include('front_end.home.home_banner')
    <!--End banners-->
    @include('front_end.home.home_new_products')
    <!--Products Tabs-->
    @include('front_end.home.home_featured_products')
    <!--End Best Sales-->

    <!-- TV Category -->
    @include('front_end.home.home_tv_category')

    <!--End TV Category -->

    <!-- Tshirt Category -->
    @include('front_end.home.home_tshirt_category')
    <!--End Tshirt Category -->
    <!-- Computer Category -->
    @include('front_end.home.home_computer_category')
    <!--End Computer Category -->


    <!--End 4 columns-->
    @include('front_end.home.home_deals')
    <!--Vendor List -->
    @include('front_end.home.home_vendors')
    <!--End Vendor List -->
@endsection
