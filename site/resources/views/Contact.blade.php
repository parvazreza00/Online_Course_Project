@extends('Layout.app')
@section('title','Contact')

@section('content')

<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <h1 class="page-top-title mt-3">-আমাদের সাথে যোগাযোগ করুন-</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14598.568629937306!2d90.41764856929612!3d23.83132060279045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c6422bc83d21%3A0x3a1bc96ce9f8ad8b!2sKhilkhet%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1638325906709!5m2!1sen!2sbd" width="550" height="430" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 contact-form">
                <h3 class="service-card-title">ঠিকানা</h3>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> কুড়িল-খিলখেত, ঢাকা <i class="fas fa-phone ml-2"></i> ০১৩৮৯২০২৭৭ <i class="fas fa-envelope ml-2"></i> parvazreza00@gmail.com</p>

                <!-- <p class="footer-text"><i class="fas fa-phone"></i> ০১৩৮৯২০২৭৭ </p>
                <p class="footer-text"><i class="fas fa-envelope"></i> parvazreza00@gmail.com</p> -->

                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnId" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>
        </div>
    </div>
</div>


@endsection
