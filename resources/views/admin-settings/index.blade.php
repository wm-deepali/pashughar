@extends('layouts.app')
@section('content')
<div class="container-fluid mb-5">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div>
        </div>
    </section>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h5>{{ Session::get('success') }}</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php Session::forget('success'); ?>
    </div>
    @endif
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs" id="settingsTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i> Profile Setting</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false"><i class="fas fa-user-shield"></i> Security</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false"><i class="fas fa-file-invoice"></i> Invoice & Tax Setting</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false"><i class="fas fa-rupee-sign"></i> Other Setting</a>
                      </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="settingsTabContent">
                      <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                          <!-- Profile Setting content goes here -->
                          <h3>Profile Setting</h3>
                          <form method="POST" action="{{ route('profile.settings.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row ">
                                <div class="col-md-6 form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $profile_setting->company_name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="owner_name">Owner Name</label>
                                    <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ $profile_setting->owner_name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $profile_setting->email ?? '' }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ $profile_setting->mobile_number ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="whatsapp_number">WhatsApp Number</label>
                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ $profile_setting->whatsapp_number ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="header_logo">Header Logo</label>
                                    <input type="file" name="header_logo" id="header_logo">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" id="logo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <img id="headerImgView" style="max-height: 160px; max-width:340px;" src="{{isset($profile_setting->header_logo) ? url('/').'/storage/app/'.$profile_setting->header_logo:'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg'}}" alt="Header Logo">
                                </div>
                                <div class="col-md-6">
                                    <img id="logoImgView" style="max-height: 160px; max-width:340px;" src="{{isset($profile_setting->logo) ? url('/').'/storage/app/'.$profile_setting->logo:'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg'}}" alt="Logo">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                          </form>
                      </div>
                      <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                          <!-- Security content goes here -->
                            <h3 class="mb-2">Security</h3>
                            <form action="{{ route('password.settings.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="new_password_confirmation">Confirm New Password</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-md-right"> <!-- Aligns content to the right in medium devices and above -->
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </div>
                                
                            </form>
                          <hr>
                          <h4 class="mb-2">User Security</h4>
                        <form method="POST" action="{{ route('security.settings.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="max_failed_login_user">Max Failed Login Attempts (User)</label>
                                    <input type="text" class="form-control" id="max_failed_login_user" name="max_failed_login_user" value="{{ $security_setting->max_failed_login_user ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="max_failed_login_admin">Max Failed Login Attempts (Admin)</label>
                                    <input type="text" class="form-control" id="max_failed_login_admin" name="max_failed_login_admin" value="{{ $security_setting->max_failed_login_admin ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label id="changePasswordLabel" for="is_change_password_required">
                                        @if(isset($security_setting->is_change_password_required) && $security_setting->is_change_password_required == 1)
                                            Admin Will Unlock the User
                                        @else
                                            Change Password is Required
                                        @endif
                                    </label><br>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_change_password_required" name="is_change_password_required" {{ isset($security_setting->is_change_password_required) && $security_setting->is_change_password_required == 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_change_password_required"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-right"> <!-- Aligns content to the right in medium devices and above -->
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <h4>Last Login</h4>
                        <div class="row mt-4">
                            @foreach($userActivities as $activity)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text"><i class="fas fa-server"></i> IP Address: {{ $activity->ip_address }}</p>
                                            <p class="card-text"><i class='fas fa-calendar-alt'></i> Date & Time: {{ $activity->created_at }}</p>
                                            <p class="card-text text-muted"><i class="fas fa-clock"></i> {{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                      </div>
                      <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                          <!-- Invoice & Tax Setting content goes here -->
                          <h3>Invoice & Tax Setting</h3>
                        <form method="POST" action="{{ route('invoice.settings.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $invoice_tax->company_name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="registration_number">Registration Number</label>
                                    <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ $invoice_tax->registration_number ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="gst_number">GST Number</label>
                                    <input type="text" class="form-control" id="gst_number" name="gst_number" value="{{ $invoice_tax->gst_number ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="pan_number">PAN Number</label>
                                    <input type="text" class="form-control" id="pan_number" name="pan_number" value="{{ $invoice_tax->pan_number ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="registered_address">Registered Address</label>
                                    <input type="text" class="form-control" id="registered_address" name="registered_address" value="{{ $invoice_tax->registered_address ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" value="{{ $invoice_tax->country ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{ $invoice_tax->state ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $invoice_tax->city ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $invoice_tax->zip_code ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="invoice_number">Invoice Number</label>
                                    <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $invoice_tax->invoice_number ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="sgst">SGST</label>
                                    <input type="text" class="form-control" id="sgst" name="sgst" value="{{ $invoice_tax->sgst ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="cgst">CGST</label>
                                    <input type="text" class="form-control" id="cgst" name="cgst" value="{{ $invoice_tax->cgst ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="igst">IGST</label>
                                    <input type="text" class="form-control" id="igst" name="igst" value="{{ $invoice_tax->igst ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="invoice_prefix">Invoice Prefix</label>
                                    <input type="text" class="form-control" id="invoice_prefix" name="invoice_prefix" value="{{ $invoice_tax->invoice_prefix ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="term_and_condition">Term and Condition</label>
                                    <textarea class="form-control" id="term_and_condition" name="term_and_condition" rows="3">{!! $invoice_tax->term_and_condition ?? '' !!}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                          <!-- Other Setting content goes here -->
                          <h3>Other Setting</h3>
                          <form method="POST" action="{{ route('other.settings.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="tds">TDS (%)</label>
                                    <input type="text" class="form-control" id="tds" name="tds" value="{{ $other_setting->tds ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="admin_charges">Admin Charges (%)</label>
                                    <input type="text" class="form-control" id="admin_charges" name="admin_charges" value="{{ $other_setting->admin_charges ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="other_charges">Other Charges (%)</label>
                                    <input type="text" class="form-control" id="other_charges" name="other_charges" value="{{ $other_setting->other_charges ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="user_expiry">User Expiry (in Days)</label>
                                    <input type="text" class="form-control" id="user_expiry" name="user_expiry" value="{{ $other_setting->user_expiry ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="point_value">Points Value(n points = 1rs)</label>
                                    <input type="number" class="form-control" id="point_value" name="point_value" value="{{ $other_setting->point_value ?? 0 }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="referral_points">Referral Points</label>
                                    <input type="text" class="form-control" id="referral_points" name="referral_points" value="{{ $other_setting->referral_points ?? 0 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="welcome_bonus">Welcome Bonus Points</label>
                                    <input type="number" class="form-control" id="welcome_bonus" name="welcome_bonus" value="{{ $other_setting->welcome_bonus ?? 0 }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="wallet_limit">Wallet Limit (%)</label>
                                    <input type="number" class="form-control" id="wallet_limit" name="wallet_limit" value="{{ $other_setting->wallet_limit ?? 0 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Is Referral Enable</label><br>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_referral_enable" name="is_referral_enable" {{ isset($other_setting->is_referral_enable) && $other_setting->is_referral_enable == 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_referral_enable"></label>
                                    </div>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
         CKEDITOR.replace('term_and_condition');
    });
    setInterval(function() {
        $(document).find(".cke_notification_warning").remove();
    }, 100);
</script>
<script>
    document.getElementById('header_logo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('headerImgView').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    document.getElementById('logo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoImgView').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('is_change_password_required');
        const label = document.getElementById('changePasswordLabel');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                label.textContent = 'Admin Will Unlock the User';
            } else {
                label.textContent = 'Change Password is Required';
            }
        });
    });
</script>
@endsection
