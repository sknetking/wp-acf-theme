<?php 
$title = get_sub_field('title');
$text_content = get_sub_field('text_content');

?>
<section class="simple-text">
    <div class="container">
        <?php if(!empty($title)){ echo '<h1>'.$title.'</h1>'; } ?>
        <?php if(!empty($text_content)){ echo $text_content; } ?>
    </div>
</section>