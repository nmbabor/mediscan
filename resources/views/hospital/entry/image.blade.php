
	@extends('layout.app')
        @section('head')
            {!! Html::style('public/plugins/dropzone/dropzone.min.css') !!}
            {!! Html::style('public/plugins/dropzone/basic.min.css') !!}
        @stop

		@section('content')
		<!-- begin #content -->
		<div id="content" class="content">
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            	<a class="btn btn-info btn-xs" href="{{URL::to('/hospital-entry')}}">View All</a>
                                
                            </div>
                            <h4 class="panel-title">Upload Entry</h4>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('url' =>"upload-images/$id",'class'=>'form-horizontal dropzone','id'=>'my-dropzone','method'=>'POST','files'=>'true', 'role'=>'form','data-parsley-validate novalidate')) !!}
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                  </div>
                            {!! Form::close(); !!}
                            <br>
                            @if(count($photos)>0)
                            <div class="col-md-12 no-padding">
                                <p>Uploaded Images</p>
                                @foreach($photos as $key => $photo)
                                    <div class="col-md-1 min-padding text-center image-load-entry" id="image-{{$key}}">
                                        <img src="{{asset($photo)}}" class="img-responsive" alt="Hospital Report">
                                        <button class="btn btn-danger btn-xs delete-image" id="{{$key}}">Remove</button>
                                        
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
		
   
    @endsection
@section('script')
    {!! Html::script('public/plugins/dropzone/dropzone.min.js') !!}
    {!! Html::script('public/js/dropzone-config.js') !!}
<script type="text/javascript">
    var i=0;
    var fileList = new Array;
    Dropzone.options.myDropzone = {
            maxFilesize  : 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            dictRemoveFile: 'Remove',
            init: function () {
            
            this.on("success", function (file, rep) {

                    fileList[i] = {"id" : rep, "fileName" : file.name,"fileId" : i };
                        //console.log(fileList);
                        i++;
                    
                });
            this.on("removedfile", function(file) {
                        var rmvFile = "";
                        for(f=0;f<fileList.length;f++){

                            if(fileList[f].fileName == file.name)
                            {
                                rmvFile = fileList[f].id;

                            }

                        }

                        if (rmvFile){
                            $.ajax({
                                url: "{{URL::to('delete-photo')}}/"+rmvFile,
                                success: function(result){
                                    console.log(result);
                                }
                            },
                            );
                        }
                    });
        },

        };
    $(document).on('click','.delete-image',function(){
        var id = $(this).attr('id');
         $.ajax({
                url: "{{URL::to('delete-photo')}}/"+id,
                success: function(result){
                    $('#image-'+id).html('<b class="text-danger">Deleted</b>');
                }
            });
    })
</script>
@endsection

