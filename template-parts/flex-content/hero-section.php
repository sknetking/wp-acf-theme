<?php // Hero Section
$hero_title = get_field('hero_title');
$hero_description = get_field('hero_description');
?>
<div class="solutions-hero no-border">
    <div class="container">
        <div class="hero-content d-flex align-items-center">
            <div class="left-col">
                <div class="solutions-content-block">
                    <?php if ($hero_title) : ?>
                        <div class="page-title">
                            <h1><?php echo ($hero_title); ?></h1>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($hero_description) : ?>
                        <div class="short-description">
                            <p><?php echo ($hero_description); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
