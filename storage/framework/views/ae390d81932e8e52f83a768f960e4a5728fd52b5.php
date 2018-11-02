<?php $__env->startSection('content'); ?>    

    <div id="contentarea" class="is-container container">
        <div class="ui-draggable"><div class="row clearfix">
        <div class="column full" contenteditable="true">
            <div class="center">
                <i class="icon ion-leaf size-48"></i>
                <h1 style="font-size: 1.3em">BEAUTIFUL CONTENT</h1>
                <div class="display">
                    <h1>LOREM IPSUM IS SIMPLY DUMMY TEXT</h1>
                </div>
            </div>
        </div>
    </div><div class="row-tool" style="display: none;"><div class="row-handle ui-sortable-handle"><i class="cb-icon-move"></i></div><div class="row-html"><i class="cb-icon-code"></i></div><div class="row-copy"><i class="cb-icon-plus"></i></div><div class="row-remove"><i class="cb-icon-cancel"></i></div></div></div>

    <!-- This is just a sample existing content (content can be loaded from a database) -->
        <div class="row clearfix">
            <div class="column full">
                <div class="center">
                    <i class="icon ion-leaf size-48"></i>
                    <h1 style="font-size: 1.3em">BEAUTIFUL CONTENT</h1>
                    <div class="display">
                        <h1>LOREM IPSUM IS SIMPLY DUMMY TEXT</h1>
                    </div>
                 </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="column full">
                <hr>
            </div>
        </div>
        <div class="row clearfix">
            <div class="column half">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus leo ante, consectetur sit amet vulputate vel, dapibus sit amet lectus.</p>
            </div>
            <div class="column half">
                <img src="editor/assets/minimalist-basic/e09-1.jpg" alt="">
            </div>
        </div>

    </div>
      
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>