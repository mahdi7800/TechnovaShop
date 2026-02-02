
<div class="page-header text-center" style="background-image: url('<?php echo TNM_URL . '/assets/images/page-header-bg.jpg' ; ?>)">
                <div class="container">
                    <h1 class="page-title"><?php echo get_the_title(); ?></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                    <?php echo Breadcrumb::tns_get_breadcrumb(); ?>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->