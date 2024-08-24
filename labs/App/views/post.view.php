<!-- 
  Noam Sapir© 2023
-->
<!DOCTYPE html>
<html lang="he" dir="rtl">

<?php loadPartial('head') ?>
<head>
    <title>Noam'sLab - <?php echo htmlspecialchars_decode($post->title) ?></title>
    <!-- SEO TAGS -->
    <meta name="title" content="<?php echo htmlspecialchars_decode($post->title) ?> | Noam'sLab">
    <meta name="description" content="<?php echo htmlspecialchars_decode($post->SEOdescription) ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars_decode($post->SEOkeywords) ?>">
    <meta name="language" content="Heberw">
    <meta name="author" content="<?php echo htmlspecialchars_decode($post->author) ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars_decode($post->SEOimage) ?>">
    <meta property="twitter:image" content="<?php echo htmlspecialchars_decode($post->SEOimage) ?>">

    <!-- SEO -->
    <?php 
        if($post->indexing)
            echo '<meta name="robots" content="index, follow">';
        else if(!$post->indexing)
            echo '<meta name="robots" content="noindex, nofollow">';
    ?>
</head>

<body style="background-color: rgb(24, 24, 24);">

    <section dir="rtl" id="" class="hero is-success pt-6 is-fullheight"
        style="background: linear-gradient(rgba(255, 255, 255, 0.2), hsla(0, 0%, 96%, 0.2)), url(''); background-size:cover; background-position:center;">
        <div class="hero-body">
            <div class="container is-max-desktop px-2 pt-5 pb-4"
            style="background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(245, 245, 245, 0.95)); border-radius: 7px; box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.2), 0 20px 10px 0 rgba(0, 0, 0, 0.19);">
                <?php if((new Framework\middleware\Authorize)->isAuthenticated()): ?>
                <a href="/postWriter/<?php echo $post->postName; ?>">
                <button class="button is-success is-rounded" type="submit">ערוך פוסט</button>
                </a>
                <?php endif; ?>
                <h1 class="title is-bold is-1 has-text-black-bis has-text-centered">
                    <?php echo htmlspecialchars_decode($post->title); ?></h1>
                <h1 class="subtitle mx-1 is-bold is-5 has-text-grey-dark has-text-centered">
                    <?php echo htmlspecialchars_decode($post->description); ?></h1>
                <div class="container is-2 px-2 has-text-grey-dark">
                    <?php echo htmlspecialchars_decode($post->content); ?>
                </div>


                <div dir="rtl" class="has-text-grey-dark mr-3">
                    <p class="">פורסם על ידי:</p>
                    <div class="media is-flex is-align-items-center">
                        <figure class="image is-48x48">
                            <a <?php if(isset($post->authorfavLink)) echo "href=\"$post->authorfavLink"; ?>">
                                <img class="is-rounded" src="<?php echo htmlspecialchars_decode($post->authorImage ) ?>">
                        </figure>
                        <p class="pr-2"><?php echo htmlspecialchars_decode($post->authorDisplayName) ?></p>
                        </a>
                    </div>
                    <p title="DD/MM/YYYY">בתאריך: <?php
                  $dateParts = explode(' ', $post->publish_date);
                  $date = str_replace('/', '-', $dateParts[0]);
                  $formattedDate = date('d/m/Y', strtotime("$date"));
                  echo $formattedDate;
                  ?></p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <?php loadPartial('navbar', ['database' => $database]); ?>
    <?php loadPartial('footer') ?>
</body>

</html>