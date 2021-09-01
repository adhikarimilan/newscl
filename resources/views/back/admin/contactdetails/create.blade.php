@extends('back.admin.layout.index')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
     
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Contact Details</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                      class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @include('msg.msg')
              
                <form method="post" action="{{route('admin.updatecontact')}}">
                    @csrf
                    <div class="form-group">
                        <label for="headertext">Header Text</label>	              
                        <textarea id="headertext" class="form-control" name="headertext" rows="5" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="siteTitle">Site Title</label>	              
                        <input type="text" id="siteTitle" class="form-control" name="siteTitle"  >
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email Address</label>	        	    
                        <input type="email" id="inputEmail" class="form-control" name="email"   >
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Address</label>	        	    
                        <input type="text" id="inputEmail" class="form-control" name="address" value=""  > 
                    </div>
                    <div class="form-group">
                        <label for="contactNumber">Contact Number</label>
                         <input type="text" id="contactNumber" class="form-control" name="contactNumber"   value="">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                         <input type="text" id="mobile" class="form-control" name="mobile"   value="">
                    </div>
                    
                    <div class="form-group">
                        <label for="position_np">Fax</label>	        	    
                        <input type="text" id="position_np" class="form-control" name="fax"   value="">
                    </div>
                    <div class="form-group">
                        <label for="position_np">Facebook Url</label>	        	    
                        <input type="text" id="facebookUrl" class="form-control" name="facebookUrl"   value=""  >
                    </div>
                    <div class="form-group">
                        <label for="position">Twitter Url</label>	        	    
                        <input type="text" id="twitterUrl" class="form-control" name="twitterUrl"   value=""  >
                    </div>
                    <div class="form-group">
                        <label for="position">Instagram Url</label>	        	    
                        <input type="text" id="instagramUrl" class="form-control" name="instagramUrl"   value=""  >
                    </div>
                    <div class="form-group">
                        <label for="position">Google Url</label>	        	    
                        <input type="text" id="googleUrl" class="form-control" name="googleUrl"   value=""  >
                    </div>
                    <div class="form-group">
                        <label for="footertext">Footer Text</label>	              
                        <input type="text" id="footertext" class="form-control" name="footertext" value=""  >
                    </div>
                    <div class="form-group">
                        <label for="footertext_en">Footer Text Description</label>	              
                        <input type="text" id="footertextdesc" class="form-control" name="footertextdesc" value=""  >
                    </div>
                    <div class="form-group">
                        <label for="footerside">Footer Side Link Title</label>	  <input type="text" id="footerside" class="form-control" name="footersidelinktitle" value=""  >
                    </div>
                    
                    <button type="submit" class="btn btn-info">Save Details</button>
                    </form>	
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
@section('extra-js')
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript">
 	 CKEDITOR.replace( 'headertext' ); 	
</script>
@endsection