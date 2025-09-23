<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ad Preview</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group row">
           <div class="col-sm-4">
               <label class="con-label">Image</label><br>
               @if(isset($ad->adImage) && count($ad->adImage)>0)
                @foreach($ad->adImage as $image)
                <img class="mt-2 img-fluid" src="{{ asset('storage').'/'.$image->image}}" alt="Current Image" style="height:70px;border-radius:3px;">
                @endforeach
                @endif
              
           </div>
       </div>        
       <div class="form-group row">
           <div class="col-sm-4">
               <label class="con-label">Title</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->title }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Category</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->category->name }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Sub Category</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:5px 10px;border-radius:3px;">{{ $ad->subcategory->name ?? 'NA' }}</h3>
           </div>
       </div>
       <div class="form-group row">
           
           <div class="col-sm-4">
               <label class="con-label">Price</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->price }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Price Type</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->price_type }}</h3>
           </div>
       </div>
       
       <div class="form-group row">
           <div class="col-sm-12">
               <label class="con-label">Description</label>
               <br/>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">
               {{ $ad->description }}
               </h3>
           </div>
       </div>
       <div class="form-group row">
           <div class="col-sm-12">
               <label class="con-label">Location</label>
               <br/>
               <h3 class="text-conlabel" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">
               {{ $ad->location }}
               </h3>
           </div>
       </div>

       <div class="form-group row">
          
           <div class="col-sm-4">
               <label class="con-label">Status</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->status }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Expire At</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->expire_at ?? 'NA' }}</h3>
           </div>
       </div>
       <div class="form-group row">
            <div class="col-sm-12">
                <h3>SEO Details</h3>
            </div>
        </div>
       <div class="form-group row">
        
           <div class="col-sm-4">
               <label class="con-label">Meta Title</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->meta_title ?? 'NA' }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Meta Keywords</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->meta_keyword ?? 'NA' }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Meta Description</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->meta_description ?? 'NA' }}</h3>
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
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->author_name ?? 'NA' }}</h3>
           </div>
           <div class="col-sm-6">
               <label class="con-label">Author Email</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->author_email ?? 'NA' }}</h3>
           </div>
           
       </div>
       <div class="form-group row">
        
           <div class="col-sm-6">
               <label class="con-label">Author Mobile</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->author_mobile ?? 'NA' }}</h3>
           </div>
           <div class="col-sm-6">
               <label class="con-label">Author Address</label>
               <h3 class="text-con-label" style="width:100%;border:1px solid gray;padding:10px 10px;border-radius:3px;font-size:16px;font-weight:400;line-height:20px">{{ $ad->author_address ?? 'NA' }}</h3>
           </div>
       </div>
       
        <div class="form-group row"> 
         <div class="col-sm-12">
            <form action="{{route('manage-ads-status-update', $ad->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                <label for="status">Status</label>
                @php
                $statusArr = array('Pending','Published','Rejected','Expired');
                @endphp
                <select name="status" class="form-control" id="status">
                    @foreach($statusArr as $status)
                    <option value="{{$status}}" {{$ad->status == $status ? 'selected' : ''}}>{{$status}}</option>
                    @endforeach
                </select>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    
                </div>
            </form>
        </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <h3>Specifications</h3>
            </div>
        </div>
        <div class="form-group row">
            @if(isset($ad->adSpecification) && count($ad->adSpecification) >0)
            @foreach($ad->adSpecification as $speci)
            <div class="col-sm-3">
               <label class="con-label" >{{$speci->specification}}</label>
               
           </div><br>
           @endforeach
           @endif
       </div>
       <div class="form-group row">
            <div class="col-sm-12">
                <h3>Features</h3>
            </div>
        </div>
        <div class="form-group row">
            @if(isset($ad->adFeature) && count($ad->adFeature) >0)
            @foreach($ad->adFeature as $feature)
            <div class="col-sm-3 {{$feature->features_name}}">
               <label class="con-label">{{ucwords(str_replace('_', ' ', $feature->features_name	))}}</label>
               <h3 class="text-con-label" >{{ $feature->features ?? 'NA' }}</h3>
           </div><br>
           @endforeach
           @endif
       </div>
       
       
       
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <script>
    
    var yearInput = document.getElementsByClassName("age_in_year");
    var monthInput = document.getElementsByClassName("age_in_months");
    var approxInput = document.getElementsByClassName("age_approx");
    
    var avgwtInput = document.getElementsByClassName("average_weight");
    var avgwtInInput = document.getElementsByClassName("average_weight_in");
    
    var wtInput = document.getElementsByClassName("weight");
    var wtInInput = document.getElementsByClassName("weight_in");
     
    if(typeof(yearInput) != 'undefined' && yearInput != null)
    {
        
        $(monthInput).insertAfter($(yearInput));
    }
    if(typeof(approxInput) != 'undefined' && approxInput != null)
    {
        $(approxInput).insertAfter($(monthInput));
    }
    
    if(typeof(avgwtInput) != 'undefined' && avgwtInput != null)
    {
        $(avgwtInInput).insertAfter($(avgwtInput));
    }
    
    if(typeof(wtInput) != 'undefined' && wtInput != null)
    {
        $(wtInInput).insertAfter($(wtInput));
    }
</script>