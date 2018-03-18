<footer class="sticky-footer">
  <div class="container">
    <div class="text-center">
      <div class="powered">
            <span>Powered By: </span>
            <img src="{{asset('images/Smart-Soft-Inc-logo.png')}}">
        </div>
    </div>
  </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fa fa-angle-up"></i>
</a>
     <input type="hidden" value="{{URL::to('')}}" id="rootUrl">
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('public/dashboard/ui/jquery-ui.js')}}"></script>
    <script src="{{asset('public/dashboard/vendor/popper/popper.min.js')}}"></script>
    <script src="{{asset('public/dashboard/vendor/bootstrap/js/bootstrap2.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <!-- <script src="{{asset('public/dashboard/vendor/chart.js/Chart.min.js')}}"></script> -->
    <script src="{{asset('public/dashboard/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/dashboard/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/dashboard/js/sb-admin.min.js')}}"></script>
    @if(Request::path()=='dashboard')
    <script src="{{asset('public/dashboard/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('public/dashboard/js/sb-admin-charts.min.js')}}"></script>
    @endif
    <!-- Custom scripts for this page-->
    <script src="{{asset('public/dashboard/js/sb-admin-datatables.min.js')}}"></script>
    <script src="{{asset('public/plugins/parsley/dist/parsley.js')}}"></script>
    <script src="{{ asset('public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('public/js/chosen.jquery.js') }}" type="text/javascript"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js" type="text/javascript"></script> 
    
    <!-- tinymce editor -->
    <script src="{{asset('public/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('public/dashboard/js/custom.js')}}"></script>
    <script type="text/javascript">
        tinymce.init({
        selector: '.tinymce',
        menubar: false,
        height: 400,
        theme: 'modern',
        plugins: 'image code link lists textcolor imagetools colorpicker ',
      browser_spellcheck: true,
        toolbar1: 'formatselect | bold italic strikethrough | link image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        // enable title field in the Image dialog
        image_title: true, 
        // enable automatic uploads of images represented by blob or data URIs
        automatic_uploads: true,
        // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
        // images_upload_url: 'postAcceptor.php',
        // here we add custom filepicker only to Image dialog
        file_picker_types: 'image', 
        // and here's our custom image picker
        file_picker_callback: function(cb, value, meta) {
          var input = document.createElement('input');
          input.setAttribute('type', 'file');
          input.setAttribute('accept', 'image/*');
          
          // Note: In modern browsers input[type="file"] is functional without 
          // even adding it to the DOM, but that might not be the case in some older
          // or quirky browsers like IE, so you might want to add it to the DOM
          // just in case, and visually hide it. And do not forget do remove it
          // once you do not need it anymore.

          input.onchange = function() {
            var file = this.files[0];
            
            var reader = new FileReader();
            reader.onload = function () {
              // Note: Now we need to register the blob in TinyMCEs image blob
              // registry. In the next release this part hopefully won't be
              // necessary, as we are looking to handle it internally.
              var id = 'blobid' + (new Date()).getTime();
              var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
              var base64 = reader.result.split(',')[1];
              var blobInfo = blobCache.create(id, file, base64);
              blobCache.add(blobInfo);

              // call the callback and populate the Title field with the file name
              cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
          };
          
          input.click();
        }
      });
    </script>
    <script type="text/javascript">
        $('.select').chosen("liszt:updated");
        
        function confirmDelete(){
            return confirm("Do You Sure Want To Delete This Data ?");
        }
        $('form').on('focus', 'input[type=number]', function (e) {
          $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault()
          })
        })
        $('form').on('blur', 'input[type=number]', function (e) {
          $(this).off('mousewheel.disableScroll')
        })
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $(document).ready(function(){
            $('a').attr('tabindex','-1');
        });
    </script>
    <!-- <script src="{{asset('public/dashboard/js/sb-admin-charts.min.js')}}"></script> -->


@if(Session::has('success'))
    <script type="text/javascript">
        swal({
          type: 'success',
          title: '{{Session::get("success")}}',
          showConfirmButton: false,
          timer: 1500
        })
    </script>
    @endif
    @if(Session::has('error'))
    <script type="text/javascript">
        swal({
          type: 'error',
          title: '{{Session::get("error")}}',
          showConfirmButton: true
        })
    </script>
    @endif
    <script type="text/javascript">
        function deleteConfirm(id){
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $("#"+id).submit();
              }
            })
        }
    </script>