<!-- Page Sidebar -->
<div class="page-sidebar">

    <!-- Site header  -->
    <header class="site-header">
        <div class="site-logo">
            <a href="/<?php echo e(explode('/',request()->route()->uri())[0]); ?>">
                <img src="<?php echo e(asset('assets/images/logo.png')); ?>" width="320">
            </a>
        </div>
        <?php if(isset($single)): ?>
        <div class="site-logo">
            <div>
                <img src="<?php echo e($single->photo); ?>" width="320">
            </div>
        </div>
        <?php endif; ?>

        <?php if(auth('marketing')->check() and request()->product): ?>
            <div class="site-logo">
                <div>
                    <img src="<?php echo e(request()->product->photo); ?>" width="320">
                </div>
            </div>
        <?php endif; ?>

        <?php if(auth('callcenter')->check() ): ?>
            <div class="site-logo">
                <div>
                    <img src="<?php echo e(auth('callcenter')->user()->product->photo); ?>" width="320">
                </div>
            </div>
        <?php endif; ?>

        <?php if(auth('marketing')->check() and auth('marketing')->user()->type == 2): ?>
            <div class="site-logo">
                <div>
                    <img src="<?php echo e(auth('marketing')->user()->product->photo); ?>" width="320">
                </div>
            </div>
        <?php endif; ?>
    </header>
    <!-- /site header -->

    <!-- Main navigation -->
    

        
            
                
            
        
        
            
            
                
                

                    
                
            
            
                
                
                    
                    
                
            
            
                
                
                    
                    
                
            
            
                
                
                    
                    
                
            
            
                
                    
                
            
            
                
                    
                        
                    
                
            
                
                    
                        
                    
                
                
                    
                        
                    
                
            
        
        
            
                
                
                    
                    
                
            
            
                
                
                    
                    
                
            
            
            
                
                
                    
                    
                
            
            
            
            
                
                
                    
                    
                
            
            
            
            
                
                
                    
                    
                
            
            
            
            
                
                
                    
                    
                
            
            
            
                
                
                    
                    
                
            
        

        

            
            
                
                
                    
                    
                    
                
            
            
            
                
                    
                    
                        
                    
                
            
            
                
                    
                    
                        
                    
                
            
            
                
                    
                    
                        
                    
                
            
            
                
                    
                    
                        
                    
                
            

        

        
        
            
        
            
        
            
        
        
    
    <!-- /main navigation -->
</div>
<!-- /page sidebar -->
<?php /**PATH /Users/ahmed_adel/Downloads/psp.cat-sw.com/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>