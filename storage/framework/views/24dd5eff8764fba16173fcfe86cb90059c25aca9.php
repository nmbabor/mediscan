<?php $__env->startSection('head'); ?>
<?php echo Html::style('public/dashboard/cornerstone/cornerstone.min.css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
        .magnifyTool{
            border: 4px white solid;
            box-shadow: 2px 2px 10px #1e1e1e;
            border-radius: 50%;
            display: none;
            cursor: none;
        }
        /* prevents selection when left click dragging */
        .disable-selection {
            -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;
        }
        /* prevents cursor from changing to the i bar on the overlays*/
        .noIbar {
            cursor:default;
        }
        .tool-icon{width: 100%;border-left: 1px solid #ddd;overflow: hidden;padding: 5px;display: block;margin-bottom: 1px;border-radius: 0;}
        .tool-icon .list-group-item{padding: 3px;margin: 0 5px;border-radius: 5px;}
        .tool-icon li {list-style: none;float: left;display: inline-block;max-width: 125px;cursor: pointer;text-align: center;margin: 0 5px;}
        .tool-icon li a{text-decoration:none; }
        .tool-icon li a i{font-size: 20px;}
		.panel-info>.panel-heading{overflow: hidden;background: #fff;padding: 0 5px;}
		.study-list-img{width: 100px;height: 100px;float: left;margin: 5px;cursor: pointer;}
        .study-list-img.active{border: 3px solid  #008dd2;}
		.study_images{height: 520px;overflow-y:scroll;}
</style>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">
    	<div class="col-md-3">
    		<h4>List</h4>
    	</div>
    	<div class="col-md-9">
    		
            <ul class="list-group tool-icon list-group">
                <li><a id="enableWindowLevelTool" class="list-group-item others"><i class="fa fa-adjust"></i></a><small> WW/WC </small></li>
                <li><a id="pan" class="list-group-item others"><i class="fa fa-hand-paper-o"></i> </a><small> Pan</small></li>
                <li><a id="zoom" class="list-group-item others"><i class="fa fa-plus-circle"></i></a> <small> Zoom</small></li>
                <li><a id="enableLength" class="list-group-item others"><i class="fa fa-arrows-h"></i></a> <small> Length</small></li>
                <li><a id="probe" class="list-group-item others"><i class="fa fa-dot-circle-o"></i></a> <small> Probe</small></li>
                <li><a id="circleroi" class="list-group-item others"><i class="fa fa-circle-thin"></i></a> <small> Elliptical ROI</small></li>
                <li><a id="rectangleroi" class="list-group-item others"><i class="fa fa-square-o"></i></a> <small> Rectangle ROI</small></li>
                <li><a id="angle" class="list-group-item others"><i class="fa fa-angle-up"></i></a> <small> Angle</small></li>
                <li><a id="highlight" class="list-group-item others"><i class="fa fa-crop"></i></a> <small> Highlight</small></li>
                <li><a id="freehand" class="list-group-item others"><i class="fa fa-square-o"></i></a> <small> Freeform ROI</small></li>
                <li><a id="magnify" class="list-group-item"><i class="fa fa-search-plus"></i></a> <small> Magnify</small></li>
            </ul>
        
    	</div>
    </h3>
  </div>
  <div class="panel-body">
  		 <!-- WRAPPER -->
  		 
  		 
        <div class="col-md-3 no-padding">
        	<div class="study_images">
        	<?php $__currentLoopData = $data->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	        	<img class="study-list-img" id="<?php echo e($key); ?>" src='<?php echo e(asset($photo->photo)); ?>' class="img-responsive">
	        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	</div>
        </div>
		<div class="col-xs-9">
	        <div style="width:100%;height:512px;position:relative;display:inline-block;color:white;"
	             oncontextmenu="return false"
	             class='cornerstone-enabled-image'
	             unselectable='on'
	             onselectstart='return false;'
	             onmousedown='return false;'>
	            <div id="dicomImage"
	                 style="width:100%;height:512px;top:0px;left:0px; position:absolute;">
	            </div>
	            <div id="mrtopleft" style="position: absolute;top:3px; left:3px">
	                <?php echo e($data->patient_name); ?>

	            </div>
	            <div id="mrtopright" style="position: absolute;top:3px; right:3px">
	                <?php echo e($data->hospital->user->name); ?>

	            </div>
	            <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px">
	                Zoom:
	            </div>
	            <div id="mrbottomleft" style="position: absolute;bottom:3px; left:3px">
	                WW/WC:
	            </div>
	        </div>
	        <div class="col-md-12">
	        	<div class="checkbox pull-right">
		              <label><input type="checkbox" id="chkshadow">Apply shadow</label>
		            </div>
	        </div>
	        <div class="col-md-12 no-padding" id="magnify-Tools" style="display: none;">
	        	<div class="col-md-4">
			         <label for="magLevelRange">Magnification Level</label>
		            <input id="magLevelRange" type="range" min="1" value="2" max="10" />
	        	</div>
	        	<div class="col-md-4">
		            <label for="magSizeRange">Magnifying glass size</label>
		            <input id="magSizeRange" type="range" min="100" value="225" max="300" step="25"/>
			            		
	        	</div>
	        	
	        </div>
	    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo Html::script('public/dashboard/cornerstone/hammer.js'); ?>

<?php echo Html::script('public/dashboard/cornerstone/cornerstone.min.js'); ?>

<?php echo Html::script('public/dashboard/cornerstone/cornerstoneMath.min.js'); ?>

<?php echo Html::script('public/dashboard/cornerstone/cornerstoneWebImageLoader.min.js'); ?>

<?php echo Html::script('public/dashboard/cornerstone/cornerstoneTools.min.js'); ?>

<script>
  // TODO: This should happen automatically.
  cornerstoneWebImageLoader.external.cornerstone = cornerstone
</script>
<script>
    var url = '<?php echo e(Request::path()); ?>';
    var url2 = '<?php echo e(Request::fullUrl()); ?>';
    var imageNum = url2.split('?image=')[1];
    if(!imageNum || imageNum==0){
        imageNum = 0;
    }else{
        imageNum-=1;
    }
    
    var allImage = new Array();
    $('.study-list-img').each(function(){
        if((imageNum)==$(this).attr('id')){
            $(this).addClass('active');
        }
        allImage.push($(this).attr('src'));
    });

     $(document).on('click','.study-list-img',function(){
        var Id = $(this).attr('id');
        changeImage(Id);
        var number = parseInt(Id)+1;
        window.history.pushState('','','<?php echo e(URL::to('')); ?>/'+url+'?image='+number);
        $('.study-list-img').removeClass('active');
        $(this).addClass('active');
    })

    var element = document.getElementById('dicomImage');

    // image enable the dicomImage element
    cornerstone.enable(element);
    function changeImage(imageIndex){
        var imageId = allImage[imageIndex];
        cornerstone.loadImage(imageId).then(function(image) {
        cornerstone.displayImage(element, image);
        cornerstoneTools.mouseInput.enable(element);
        cornerstoneTools.mouseWheelInput.enable(element);
        // Enable all tools we want to use with this element
        cornerstoneTools.wwwc.activate(element, 1); // ww/wc is the default tool for left mouse button
        cornerstoneTools.pan.activate(element, 2); // pan is the default tool for middle mouse button
        cornerstoneTools.zoom.activate(element, 4); // zoom is the default tool for right mouse button
        cornerstoneTools.zoomWheel.activate(element); // zoom is the default tool for middle mouse wheel
        cornerstoneTools.probe.enable(element);
        cornerstoneTools.length.enable(element);
        cornerstoneTools.ellipticalRoi.enable(element);
        cornerstoneTools.rectangleRoi.enable(element);
        cornerstoneTools.angle.enable(element);
        cornerstoneTools.highlight.enable(element);
        cornerstoneTools.magnify.enable(element);
    });
    }

    activate("enableWindowLevelTool");
    changeImage(imageNum);


     // Listen for changes to the viewport so we can update the text overlays in the corner
    function onImageRendered(e) {
        var viewport = cornerstone.getViewport(e.target);
        document.getElementById('mrbottomleft').textContent = "WW/WC: " + Math.round(viewport.voi.windowWidth) + "/" + Math.round(viewport.voi.windowCenter);
        document.getElementById('mrbottomright').textContent = "Zoom: " + viewport.scale.toFixed(2);
    };

    element.addEventListener('cornerstoneimagerendered', onImageRendered);

    

    var config = {
        // invert: true,
        minScale: 0.25,
        maxScale: 20.0,
        preventZoomOutsideImage: true
    };

    cornerstoneTools.zoom.setConfiguration(config);

    document.getElementById('chkshadow').addEventListener('change', function(){
      cornerstoneTools.length.setConfiguration({shadow: this.checked});
      cornerstoneTools.angle.setConfiguration({shadow: this.checked});
      cornerstone.updateImage(element);
    });

        function activate(id) {
            document.querySelectorAll('a').forEach(function(elem) {
                elem.classList.remove('active');
            });

            document.getElementById(id).classList.add('active');
        }

        // helper function used by the tool button handlers to disable the active tool
        // before making a new tool active
        function disableAllTools()
        {
            cornerstoneTools.wwwc.disable(element);
            cornerstoneTools.pan.activate(element, 2); // 2 is middle mouse button
            cornerstoneTools.zoom.activate(element, 4); // 4 is right mouse button
            cornerstoneTools.probe.deactivate(element, 1);
            cornerstoneTools.length.deactivate(element, 1);
            cornerstoneTools.ellipticalRoi.deactivate(element, 1);
            cornerstoneTools.rectangleRoi.deactivate(element, 1);
            cornerstoneTools.angle.deactivate(element, 1);
            cornerstoneTools.highlight.deactivate(element, 1);
            cornerstoneTools.freehand.deactivate(element, 1);
            cornerstoneTools.magnify.deactivate(element,1);

        }

        // Tool button event handlers that set the new active tool
        document.getElementById('enableWindowLevelTool').addEventListener('click', function() {
            activate('enableWindowLevelTool')
            disableAllTools();
            cornerstoneTools.wwwc.activate(element, 1);
        });
        document.getElementById('pan').addEventListener('click', function() {
            activate('pan')
            disableAllTools();
            cornerstoneTools.pan.activate(element, 3); // 3 means left mouse button and middle mouse button
        });
        document.getElementById('zoom').addEventListener('click', function() {
            activate('zoom')
            disableAllTools();
            cornerstoneTools.zoom.activate(element, 5); // 5 means left mouse button and right mouse button
        });
        document.getElementById('enableLength').addEventListener('click', function() {
            activate('enableLength')
            disableAllTools();
            cornerstoneTools.length.activate(element, 1);
        });
        document.getElementById('probe').addEventListener('click', function() {
            activate('probe')
            disableAllTools();
            cornerstoneTools.probe.activate(element, 1);
        });
        document.getElementById('circleroi').addEventListener('click', function() {
            activate('circleroi')
            disableAllTools();
            cornerstoneTools.ellipticalRoi.activate(element, 1);
        });
        document.getElementById('rectangleroi').addEventListener('click', function() {
            activate('rectangleroi')
            disableAllTools();
            cornerstoneTools.rectangleRoi.activate(element, 1);
        });
        document.getElementById('angle').addEventListener('click', function () {
            activate('angle')
            disableAllTools();
            cornerstoneTools.angle.activate(element, 1);
        });
        document.getElementById('highlight').addEventListener('click', function() {
            activate('highlight')
            disableAllTools();
            cornerstoneTools.highlight.activate(element, 1);
        });

        document.getElementById('freehand').addEventListener('click', function() {
            activate('freehand')
            disableAllTools();
            cornerstoneTools.freehand.activate(element, 1);
        });
         document.getElementById('magnify').addEventListener('click', function() {
            activate('magnify')
            disableAllTools();
            cornerstoneTools.magnify.activate(element, 1);
        });
         magnify.width=20;
	/*-----*/
    var magLevelRange = document.getElementById("magLevelRange");
    magLevelRange.addEventListener("change", function() {
        var config = cornerstoneTools.magnify.getConfiguration();
        config.magnificationLevel = parseInt(magLevelRange.value, 10);
    });

    var magSizeRange = document.getElementById("magSizeRange");
    magSizeRange.addEventListener("change", function() {
        var config = cornerstoneTools.magnify.getConfiguration();
        config.magnifySize = parseInt(magSizeRange.value, 10);
        var magnify = document.querySelector('.magnifyTool');
        magnify.width = config.magnifySize;
        magnify.height = config.magnifySize;
    });

    var config = {
        magnifySize: parseInt(magSizeRange.value, 10),
        magnificationLevel: parseInt(magLevelRange.value, 10)
    };

    cornerstoneTools.magnify.setConfiguration(config);
/*----*/
	$(document).on('click','#magnify',function(){
		$('#magnify-Tools').fadeIn();
	})
	$(document).on('click','.list-group-item.others',function(){
		$('#magnify-Tools').fadeOut();
	})

</script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>