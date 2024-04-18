<!-- The content of the post -->

<div class="content-wrapper">
<div class="title-wrapper">
    <div class='title-container'>
        <?php
        the_title('<h1 class="title">', '</h1>');
        ?>
    </div>
</div>

<div class="content-container">
    <?php
    $content = get_the_content();
    echo "<div class='content'>".$content."</div>";
    ?>
</div>
</div>