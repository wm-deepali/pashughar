<!-- Modal -->
<div class="modal fade" id="profile-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<div class="modal-body">
				<div class="logo modals"><a href="{{url('/')}}"><img src="{{asset('front/images/logo.png')}}" alt="" title="" style="width: 200px;"></a></div>
				<div class="get-start">
					Get started with AVH CLICKS!
				</div>
				<div class="continue-w">Add Mobile number and Password Details</div>
				<div class="form-login-reg comment-form modal-l">
					<div class="inner-frm contact-form">
						<div class="form-group" id="otpform">
							<input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Your Mobile Number*" >
                            <div class="text-danger" id="mobile_number-err"></div>
                            <div class="text-success" id="mobile_number-success"></div>
						</div>
                        <div class="form-group" id="otpform">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password*" >
                        </div>
						<div  id="hiddenInput" style="display: none;">
                            <h6 class=" my-3" style="color: #8B2025">OTP</h6>
                            <div class=" d-flex justify-content-between">
                                
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" autofocus >
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" >
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" >
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" >
                                
                            </div> 
                            <div class="text-danger" id="otp-err"></div>
                        </div>
					
                        <a href="#" class="osd-cus">
                            <div class="cus-btn-osd btn btn-primary" id="verify-btn">Continue</div>
                            <button type="button" class="btn btn-primary" style="display:none" id="validate-otp">Verify Now</button>
                        </a>
                    </div>
					
				</div>
			<div class="alredy-account"></div>
		</div>
	</div>
</div>