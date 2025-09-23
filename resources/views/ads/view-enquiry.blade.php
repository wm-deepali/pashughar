<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ad Enquiry</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
       <div class="form-group row">
           <div class="col-sm-4">
               <label class="con-label">Title</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;">{{ $enquiry->ad->title ?? ''}}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Category</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;">{{ $enquiry->ad->category->name ?? '' }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Sub Category</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:5px 10px;border-radius:3px;line-height:20px;border: none;">{{ $enquiry->ad->subcategory->name ?? 'NA' }}</h3>
           </div>
       </div>
       <div class="form-group row">
           
           <div class="col-sm-4">
               <label class="con-label">Price</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;">{{ $enquiry->ad->price ?? ''}}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Price Type</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;">{{ $enquiry->ad->price_type ?? ''}}</h3>
           </div>
       </div>
       
       <div class="form-group row">
           <div class="col-sm-12">
               <label class="con-label">Description</label>
               <br/>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;">
               {{ $enquiry->ad->description ?? ''}}
               </h3>
           </div>
       </div>
       

       <div class="form-group row">
          
           <div class="col-sm-4">
               <label class="con-label">Status</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;">{{ $enquiry->ad->status ?? ''}}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Expire At</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->ad->expire_at ?? 'NA' }}</h3>
           </div>
       </div>
       
       
        <div class="form-group row">
            <div class="col-sm-12">
                <h3>Author Details</h3>
            </div>
        </div>
       <div class="form-group row">
        
           <div class="col-sm-6">
               <label class="con-label">Author Name</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->ad->author_name ?? 'NA' }}</h3>
           </div>
           <div class="col-sm-6">
               <label class="con-label">Author Email</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->ad->author_email ?? 'NA' }}</h3>
           </div>
           
       </div>
       <div class="form-group row">
        
           <div class="col-sm-6">
               <label class="con-label">Author Mobile</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->ad->author_mobile ?? 'NA' }}</h3>
           </div>
           <div class="col-sm-6">
               <label class="con-label">Author Address</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->ad->author_address ?? 'NA' }}</h3>
           </div>
       </div>
       <div class="form-group row">
        
           <div class="col-sm-6">
               <label class="con-label">Posted On</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->ad->created_at ?? 'NA' }}</h3>
           </div>
           <div class="col-sm-6">
               <label class="con-label">Published On</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->ad->published_date ?? 'NA' }}</h3>
           </div>
       </div>
       
       
       
       
      <div class="form-group row">
            <div class="col-sm-12">
                <h3>Enquiry Deatils</h3>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
               <label class="con-label">Requested By</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->name ?? '' }}<br>{{ $enquiry->email ?? '' }}<br>{{ $enquiry->mobile ?? '' }}</h3>
           </div>
           <div class="col-sm-6">
               <label class="con-label">Message</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->detail ?? '' }}</h3>
           </div>
       </div>
       <div class="form-group row">
            <div class="col-sm-6">
               <label class="con-label">State</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{$enquiry->statename->name ?? '' }}</h3>
           </div>
           <div class="col-sm-6">
               <label class="con-label">City</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px;border: none;;border: none;">{{ $enquiry->cityname->name ?? '' }}</h3>
           </div>
       </div>
       
        
        
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
 