  <?php
  usort($posts, function ($a, $b) {
      return strtotime($b->publish_date) - strtotime($a->publish_date);
  });

  // Separate pinned and other posts
  $pinnedPosts = array_filter($posts, function ($post) {
      return $post->sticky;
  });

  $otherPosts = array_filter($posts, function ($post) {
      return !$post->sticky;
  });
  // Limit the number of displayed posts
  $maxPosts = 10; // Max posts per page
  $totalPosts = count($pinnedPosts) + count($otherPosts);
  $totalPages = ceil($totalPosts / $maxPosts);
  $currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1;
  $start = ($currentPage - 1) * $maxPosts;
  $end = $start + $maxPosts;
  $displayPosts = array_merge($pinnedPosts, $otherPosts);
  $displayPosts = array_slice($displayPosts, $start, $maxPosts);
?>
<!-- 
  Noam Sapir© 2023
-->

<!DOCTYPE html>
<html lang="he" dir="rtl">


<?php loadPartial('head') ?>

<head>

    <title>Noam'sLab - מעבדת מחשבים ורשתות</title>

    <!-- SEO -->
    <meta name="title" content="Noam'sLab - מעבדת מחשבים ורשתות בהרצליה">
    <meta name="description"
        content="המעבדה של נועם - מעבדת מחשבים מקצועית בהרצליה. עם התמחות בתיקוני חומרה ותוכנה, ייעוץ לפני רכישה ויועץ רשתות תקשורת מהרצליה, תיקון כל סוגי המחשבים. מנוהלת על ידי נועם ספיר">
    <meta name="keywords"
        content="טכנאי מחשבים בהרצליה, טכנאי מחשבים בשרון, טכנאי מחשבים עד הבית, טכנאי מחשבים מהרצליה, תיקון לפטופ, המחשב לא עובד, אין אינטרנט, אין וויפי, טכנאי רשתות, הקמת שרת משחק, הקמת שרת ביתי, הקמת שרת מדיה, תיקון מחשב גיימינג, מחשב גיימינג מתחמם, החלפת לוח אם למחשב, קורוזיה בלפטופ, בניית עמדת גיימינג, מומחה מחשבים, החלפת ראם, החלפת כרטיס מסך, הוספת כרטיס מסך, החלפת מעבד, ניקוי אבק בלפטופ, החלפת כונן ללפטופ, ניקוי וירוס במחשב, ניקוי וירוסים ללפטופ, וירוס בלפטופ, פרמוט מחשב נייד, פרמוט מחשב, החלפת סוללה למחשב, החלפת מסך שבור ללפטופ. תיקון מחשב נייד, תיקון מחשב לנובו, תיקון מחשב רייזר, תיקון מחשב נייד, מעבדת מחשבים הרצליה, מעבדת מחשבים ורשתות הרצליה, מעבדת מחשבים, טכנאי מחשבים, ייעוץ למחשב, פרמוט מחשב, תיקון מחשב, תיקון מחשב נייד, תיקון לפטופ, תיקון קונסולה, פריסת רשת אינטרנט, תכנון רשת אינטרנט, המעבדה של נועם dell, תיקון מחשב נייד hp, תיקון מחשב נייד asus, תיקון מחשב איטי, תיקון מחשב תוכנה, תיקון מחשב בשליטה מרחוק, נשפך מים על המחשב, החלפת כונן קשיח למחשב נייד ssd, החלפת כונן ssd, תיקון סוני 4, תיקון סוני 5, תיקון פלייסטיישן, שלט של פלייסטיישן לא עובד, תיקון שלט סוני 5, תיקון שלט סוני 4, תיקון שלט xbox, תיקון שלט נינטנדו סוויץ, תיקון שלט לאקס בוקס, תיקון נינטנדו סוויץ, תיקון אקסבוקס, החלפת מעבד למחשב נייח, תיקון מקלדת מכנית, תיקון מקלדת גיימינג, תיקון מקלדת מכנית, תיקון מחשבים ניידים, טכנאי מחשבים עד הבית, טכנאי מחשבים מרחוק">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Hebrew">
    <!--Social-->
    <meta property="og:title" content="Noam'sLab - מעבדת מחשבים" />
    <meta property="og:image" content="https://noamslab.co.il/img/iconWhite.webp" />
    <meta property="og:description"
        content="המעבדה של נועם - מעבדת מחשבים בהרצליה. מתמחה בתיקוני חומרה ותוכנה, ייעוץ לפני רכישה ויועץ רשתות תקשורת מהרצליה." />
    <meta property="og:url" content="https://noamslab.co.il/" />
    <meta property="og:type" content='website' />
    <meta property="og:image" content="httpsimg/logoWhite.webp">
    <meta property="twitter:image" content="https://noamslab.co.il/img/logoWhite.webp">

</head>

<body style="background-color: rgb(24, 24, 24);">


<section id="" class="hero is-success is-fullheight has-text-centered" style="background: linear-gradient(rgba(255, 255, 255, 0.2), hsla(0, 0%, 96%, 0.2)), url('/img/mobobg.avif'); background-size:cover; background-position:center;">

    <br>
  <div class="hero-body">
  <div class="box container" style="background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(245, 245, 245, 0.95));">

    <!-- Search function, inactive for now -->
    <div class="field has-addons">
      <form style="display: none;" action="/archive" method="get">
        <div class="control">
          <input class="input" type="text" id="searchInput" placeholder="חיפוש...">
        </div>
        <div class="control">
          <button type="submit" class="button is-info" id="submit">חפש</button>
        </div>
      </form>
    </div>
    <!-- -->

    <h1 class="title has-text-centered has-text-black">ארכיון כתבות</h1>
    <h2 class="subtitle has-text-centered has-text-black">כאן ניתן למצוא כתבות ישנות לפי תאריך פרסום</h2>
    
    <div class="columns is-multiline is-mobile is-centered is-rtl">
        <?php foreach ($displayPosts as $post): ?>
        <div class="column is-6-mobile is-3-desktop">
          <a href="<?php echo "/post/" . $post->postName; ?>" class="post-link">
            <div class="card">
            <div class="card-image">
              <?php
                if (!empty($post->SEOimage) && @getimagesize($post->SEOimage) == true) : ?>
                <figure class="image is-square">
                    <img loading="lazy" src="<?php echo $post->SEOimage; ?>" alt="Post Image">
                </figure>
              <?php else: ?>
              <figure class="image is-square image-placeholder">
                <img loading="lazy" src="/img/posts/noimg.jpg">
              </figure>
              <?php endif; ?>
            </div>
              <p class="title mb-3 is-4 is-5-mobile has-text-black-bis"><?php echo $post->title; ?></p>
              <div>
                <?php if (!empty($post->tag)): ?>
                  <span class="tag mb-2 is-small <?php echo $post->tagColor; ?> has-text-white">
                    <?php echo $post->tag; ?>
                  </span>
                <?php endif; ?>
              </div>
                <div class="content has-fixed-height">
                  <?php echo $post->description; ?>
                </div>
                <br>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="container">
        <nav class="pagination is-centered" role="navigation" aria-label="pagination">
          <ul class="pagination-list">
            <?php
          // Show previous page link
          if ($currentPage > 1) {
            echo '<li><a class="pagination-previous" href="?page=' . ($currentPage - 1) . '">הקודם</a></li>';
          }
          
          // Show page links
          for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li><a class="pagination-link' . ($i == $currentPage ? ' is-current' : '') . '" href="?page=' . $i . '">' . $i . '</a></li>';
          }
    
          // Show next page link
          if ($currentPage < $totalPages) {
            echo '<li><a class="pagination-next' . ($currentPage === $totalPages - 1 ? ' is-current' : '') . '" href="?page=' . ($currentPage + 1) . '">הבא</a></li>';
          }
          ?>
        </ul>
      </nav>
    </div>
    </div>
  </div>

  
  <br>
</section>

<script>
  // Find all the description elements
  var descriptionElements = document.querySelectorAll('.description');
  // If mobile, hide the description
  if (window.innerWidth < 490) {
    for (var i = 0; i < descriptionElements.length; i++) {
      descriptionElements[i].style.display = 'none';
    }
  }
  </script>

<?php loadPartial('navbar', ['database' => $database]); ?>
<?php loadPartial('footer') ?>


</body>
</html>