@extends('layouts.app')

@section('content')
<style>
    .dashboard-main-card {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 10px;
    }
    @media screen and (max-width: 480px) {
  .dashboard-main-card {
    grid-template-columns: 1fr;
  }
}
    .widget-card {
        width: 100%;
        height: 120px;
        padding: 20px;
        border-radius: 5px;
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff; /* Text color for better contrast with gradients */
    }
    .widget-card h3 {
        font-size: 18px;
        font-weight: 500;
        margin: 0;
    }
    .widget-card p {
        font-size: 18px;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.9); /* Light gray text on gradients */
        margin: 5px 0 0;
    }
    .widget-content {
        display: flex;
        flex-direction: column;
    }
    .widget-icon {
        font-size: 40px;
        opacity: 0.9;
    }
    /* Gradient backgrounds for each widget */
    .widget-1 {
        background: linear-gradient(135deg, #4CAF50, #81C784); /* Green gradient */
    }
    .widget-2 {
        background: linear-gradient(135deg, #2196F3, #64B5F6); /* Blue gradient */
    }
    .widget-3 {
        background: linear-gradient(135deg, #FFC107, #FFD54F); /* Yellow gradient */
    }
    .widget-4 {
        background: linear-gradient(135deg, #F44336, #E57373); /* Red gradient */
    }
    .account-title h3{
        font-size:18px;
        border-bottom:1px solid #80808029;
        padding:5px;
        
    }
    th{
        font-size:13px;
    }
    td{
        font-size:13px;
    }
</style>

<div class="container-fluid">
    <div class="dashboard-main-card pt-3">
        <div class="widget-card widget-1">
            <div class="widget-content">
                <h3>Total Ads</h3>
                <p>Total: &nbsp;{{$countAds}}</p>
            </div>
            <i class="fas fa-envelope widget-icon"></i> <!-- Icon for Recent Enquiries -->
        </div>
        <div class="widget-card widget-2">
            <div class="widget-content">
                <h3>Pending Ads</h3>
                <p>Total: &nbsp;{{$countpendingAds}}</p>
            </div>
            <i class="fas fa-check-circle widget-icon"></i> <!-- Icon for Completed Tasks -->
        </div>
        <div class="widget-card widget-3">
            <div class="widget-content">
                <h3>Published Ads</h3>
                <p>Total: &nbsp;{{$countpublishedAds}}</p>
            </div>
            <i class="fas fa-clock widget-icon"></i> <!-- Icon for Pending Tasks -->
        </div>
        <div class="widget-card widget-4">
            <div class="widget-content">
                <h3>Total Users</h3>
                <p>Total: &nbsp;{{$countusers}}</p>
            </div>
            <i class="fas fa-exclamation-circle widget-icon"></i> <!-- Icon for Overdue Tasks -->
        </div>
    </div>
</div>
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                                                <div class="account-title">
                        <h3>Recent Enquiries</h3>
                    </div>
                    <div class="card">
                        
                        <div class="card-body">

                           <table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th scope="col">Date & Time</th>
      <th scope="col">Name/Mobile </th>
      <th scope="col">Email Id</th>
                  <th scope="col">City</th>
      
    </tr>
  </thead>
  <tbody>
     @if(isset($enquiries) && count($enquiries) >0)
      @foreach($enquiries as $enquiry)
        <tr>
      
            <td>{{date('d/m/Y H:i:s', strtotime($enquiry->created_at)) ?? ""}}</td>
            <td>{{$enquiry->name ?? "" }}<br/>{{$enquiry->mobile ?? "" }}</td>
            <td>{{$enquiry->email ?? "" }}</td>
            
            <td>{{$enquiry->city->name ?? "" }}</td>
        </tr>
    @endforeach
    @endif
    
  </tbody>
</table>
                        </div>
                    </div>
                </div>
                                <div class="col-lg-6">
                    <div class="account-title">
                        <h3>Recent Users</h3>
                    </div>
                    <div class="card">
                        
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th scope="col">Date & Time</th>
       <th scope="col">Publisher Name</th>
      <th scope="col">User Type  </th>
      
    </tr>
  </thead>
  <tbody>
   
    @if(isset($users) && count($users) >0)
      @foreach($users as $user)
        <tr>
      
            <td>{{date('d/m/Y g:i:A', strtotime($user->created_at)) ?? ""}}</td>
            <td>{{$user->full_name ?? "" }} <br/>{{$user->email ?? "" }}</td>
            <td>{{$user->user_type ?? "" }}</td>
        </tr>
    @endforeach
    @endif
  </tbody>
</table>
                        </div>
                    </div>
                </div>
               <div class="col-lg-6">
                   <div class="account-title">
                        <h3>Recent Ad Posting</h3>
                    </div>
                    <div class="card">
                        
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
  <thead>
     <tr>
      <th scope="col">Date & Time</th>
      <th scope="col">Ad Title </th>
      <th scope="col">Category </th>
      <th scope="col">Publisher Name/Email</th>
      <th scope="col">Status</th>
      
    </tr>
  </thead>
  <tbody>
   
   @if(isset($ads) && count($ads) >0)
      @foreach($ads as $ad)
        <tr>
      
            <td>{{date('d/m/Y g:i:A', strtotime($ad->created_at)) ?? ""}}</td>
            <td>{{$ad->title ?? "" }}</td>
             <td>{{$ad->category->name ?? "" }}</td>
            <td>{{$ad->author_name ?? "" }} <br/>{{$ad->author_email ?? "" }}</td>
            <td>{{$ad->status ?? "" }}</td>
        </tr>
    @endforeach
    @endif
  </tbody>
</table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-title">
                        <h3>Recent Membership</h3>
                    </div>
                    <div class="card">
                        
                        <div class="card-body">
 <table class="table table-bordered table-hover table-striped">
  <thead>
     <tr>
      <th scope="col">Date & Time</th>
       <th scope="col">Publisher Name</th>
      <th scope="col">Membership  </th>
      <th scope="col">Paid Amount </th>
     
      
      
    </tr>
  </thead>
  <tbody>
    
      @if(isset($history) && count($history) >0)
      @foreach($history as $hist)
        <tr>
      
            <td>{{date('d/m/Y g:i:A', strtotime($hist->created_at)) ?? ""}}</td>
            <td>{{$hist->customers->full_name ?? "" }} <br/>{{$hist->customers->email ?? "" }}</td>
            <td>{{$hist->subscriptions->name ?? "" }}</td>
             <td>₹ {{$hist->offered_price ?? 0 }}</td>
            
            
        </tr>
    @endforeach
    @endif
  </tbody>
</table>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </section>
@endsection