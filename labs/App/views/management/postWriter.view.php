<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Post Writing Page</title>
  <script src="/library/tinymce/js/tinymce/tinymce.min.js"></script>
  <script>
    const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open('POST', 'library/uploadimage.php');

      xhr.upload.onprogress = (e) => {
        progress(e.loaded / e.total * 100);
      };

      xhr.onload = () => {
        if (xhr.status === 403) {
          reject({
            message: 'HTTP Error: ' + xhr.status,
            remove: true
          });
          return;
        }

        if (xhr.status < 200 || xhr.status >= 300) {
          reject('HTTP Error: ' + xhr.status);
          return;
        }

        const json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
          reject('Invalid JSON: ' + xhr.responseText);
          return;
        }

        resolve(json.location);
      };

      xhr.onerror = () => {
        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
      };

      const formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());

      xhr.send(formData);
    });
  </script>
  <script>
    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    tinymce.init({
      selector: 'textarea#post-content',
      mobile: {
        menubar: true
      },
      plugins: 'preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
      images_upload_handler: image_upload_handler_callback,
      automatic_uploads: true,
      images_reuse_filename: false,
      menubar: 'file edit view insert format tools table help',
      toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save | insertfile image media template link anchor codesample | ltr rtl',
      toolbar_sticky: true,
      autosave_ask_before_unload: true,
      autosave_interval: '30s',
      autosave_prefix: '{path}{query}-{id}-',
      autosave_restore_when_empty: false,
      autosave_retention: '2m',
      image_advtab: true,
      importcss_append: true,
      templates: [
        {
          title: 'ארכיון כתבות',
          description: 'הוסף כפתור ארכיון כתבות',
          content: '<button class="button is-warning is-light"><a href="../archive">ארכיון כתבות</a></button>'
        }
      ],
      template_cdate_format: '[Date Created (CDATE): %d/%m/%Y : %H:%M:%S]',
      template_mdate_format: '[Date Modified (MDATE): %d/%m/%Y : %H:%M:%S]',
      height: 600,
      image_caption: true,
      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
      noneditable_noneditable_class: 'mceNonEditable',
      toolbar_mode: 'sliding',
      contextmenu: 'link image imagetools table',
      skin: useDarkMode ? 'oxide-dark' : 'oxide',
      content_css: useDarkMode ? 'dark' : 'default',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
  </script>
  <link rel="stylesheet" href="/css/bulma-rtl.min.css">
</head>

<body>
  <section class="section">
    <div class="container">
      <h1 class="title"><?php echo isset($post->postName) ? 'Edit' : 'Write a New'; ?> Post</h1>
      <?php 
        //show error message, foreach errors
        if (isset($errors)) {
          foreach ($errors as $error) {
            echo '<p class="has-text-danger">' . $error . '</p>';
          }
        }
      ?>
      <form method="POST">
        <div class="field">
          <label class="label">Post Title</label>
          <div class="control">
            <input class="input" type="text" placeholder="Enter post title" name="title"
              value="<?php echo $post->title ?? ''; ?>" required>
          </div>
        </div>

        <div class="field">
          <label class="label">Post url</label>
          <div class="control">
            <input class="input" type="text" placeholder="Enter post url" name="postName"
              value="<?php if(isset($post->postName)) echo htmlspecialchars_decode($post->postName); else ''; ?>" <?php if (isset($postId)) echo 'readonly'; ?>
              required>
          </div>
        </div>
        <div class="field">
          <label class="label">Description</label>
          <div class="control">
            <textarea class="textarea" placeholder="Enter post description" name="description"
              required><?php if(isset($post->description)) echo htmlspecialchars_decode($post->description); else ''; ?></textarea>
          </div>
        </div>

        <div class="field">
          <label class="label">SEO Keywords</label>
          <div class="control">
            <input class="input" type="text" placeholder="Enter SEO keywords" name="SEOkeywords"
              value="<?php if(isset($post->SEOkeywords)) echo htmlspecialchars_decode($post->SEOkeywords); else ''; ?>" required>
          </div>
        </div>
        <div class="field">
          <label class="label">DescriptionSEO</label>
          <div class="control">
            <textarea class="textarea" placeholder="Enter post description" name="SEOdescription"
              required><?php if(isset($post->SEOdescription)) echo htmlspecialchars_decode($post->SEOdescription); else ''; ?></textarea>
          </div>
        </div>

        <div class="field">
          <label class="label">SEO Image URL</label>
          <div class="control">
            <input class="input" type="text" placeholder="Enter SEO image URL" name="SEOimage"
              value="<?php if(isset($post->SEOimage)) echo htmlspecialchars_decode($post->SEOimage); else ''; ?>">
          </div>
        </div>

        <div class="field">
          <label class="label">Post Content</label>
          <div class="control">
            <textarea id="post-content" name="content"><?php if(isset($post->content))echo htmlspecialchars_decode($post->content); else '';; ?></textarea>
          </div>
        </div>
        <div class="field">
          <label class="label">Written By</label>
          <div class="control">
            <input class="input" type="text" placeholder="Enter author name" name="authorDisplay" value="<?php echo $post->authorDisplayName ?? Framework\Session::get('user')['displayName']; ?>" readonly>
            <input type="hidden" name="author" value="<?php echo $post->author ?? Framework\Session::get('user')['id']; ?>">
          </div>
        </div>

        <div class="field">
          <label class="label">Indexing Preferences</label>
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" name="indexing" <?php if (isset($post->indexing) && $post->indexing == 1) echo 'checked'; ?>>
              Allow Search Engines to Index this Post
            </label>
          </div>
        </div>

        <div class="field">
          <label class="label">Categories</label>
          <div class="control">
            <select class="input" name="category">
              <option value="תוכנה" <?php if (isset($post->category) && $post->category === 'תוכנה'); echo 'selected'; ?>>תוכנה</option>
              <option value="חומרה" <?php if (isset($post->category) && $post->category === 'חומרה'); echo 'selected'; ?>>חומרה</option>
              <option value="רשתות" <?php if (isset($post->category) && $post->category === 'רשתות'); echo 'selected'; ?>>רשתות</option>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="label">Tag</label>
          <div class="control">
            <input class="input" type="text" name="tag" id="tagtxt" value="<?php echo $post->tag ?? ''; ?>">
          </div>
        </div>
        <!-- Visual color selection -->
        <div class="field" id="tagColorField" <?php if (!empty($post->tag)) echo 'style="display: block"'; else echo 'style="display: none"'; ?>>
          <label class="label">Tag Color</label>
          <div class="control">
            <div class="tags">
              <label class="tag tag-preview has-background-danger-dark">
                <input type="radio" name="tagColor" value="has-background-danger-dark"
                  <?php if (isset($post->tagColor) && $post->tagColor === 'has-background-danger-dark') echo 'checked'; ?>>
              </label>
              <label class="tag tag-preview is-primary">
                <input type="radio" name="tagColor" value="is-primary"
                  <?php if (isset($post->tagColor) && $post->tagColor === 'is-primary') echo 'checked'; ?>>
              </label>
              <label class="tag tag-preview is-primary has-background-link">
                <input type="radio" name="tagColor" value="is-primary has-background-link"
                  <?php if (isset($post->tagColor) && $post->tagColor === 'is-primary has-background-link') echo 'checked'; ?>>
              </label>
            </div>
          </div>
        </div>

          <div class="field">
            <label class="label">Publish/Draft</label>
            <div class="control">
              <label class="checkbox">
                <input type="checkbox" name="publish" <?php if (isset($post->publish) && $post->publish == 1) echo 'checked'; ?>>
                Publish
              </label>
            </div>
          </div>

          <div class="field">
            <label class="label">Stick post</label>
            <div class="control">
              <label class="checkbox">
                <input type="checkbox" name="sticky" <?php if (isset($post->sticky) && $post->sticky == 1) echo 'checked'; ?>>
                Stick
              </label>
            </div>
          </div>

          <div class="field is-grouped is-grouped-centered">
            <div class="control">
              <?php if (isset($postId)): ?>
                <input type="hidden" name="_method" value="PUT">
              <?php endif; ?>
              <input class="sumbit button is-success is-rounded" type="submit" value="<?php if(isset($postId)) echo 'Update'; else echo 'Post'; ?>">
            </div>
            <div class="buttons">
              <a class="button is-rounded is-danger" href="/management">
                <strong>Cancel</strong>
              </a>
            </div>
          </div>
      </form>
      </br>
      <?php if (isset($post->postName)): ?>
      <div class="field is-grouped is-grouped-centered">
        <div class="control">
          <form action="/postWriter/<?php echo $post->postName; ?>" method="POST">
          <input type="hidden" name="_method" value="DELETE">
            <button class="button is-danger is-rounded" type="submit" name="purgePost"
              onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
              Purge Post
            </button>
          </form>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </section>
  <!-- Leave page warning -->
  <script>
    "use strict";
    (() => {
      const modified_inputs = new Set;
      const defaultValue = "defaultValue";
      // store default values
      addEventListener("beforeinput", (evt) => {
        const target = evt.target;
        if (!(defaultValue in target || defaultValue in target.dataset)) {
          target.dataset[defaultValue] = ("" + (target.value || target.textContent)).trim();
        }
      });
      // detect input modifications
      addEventListener("input", (evt) => {
        const target = evt.target;
        let original;
        if (defaultValue in target) {
          original = target[defaultValue];
        } else {
          original = target.dataset[defaultValue];
        }
        if (original !== ("" + (target.value || target.textContent)).trim()) {
          if (!modified_inputs.has(target)) {
            modified_inputs.add(target);
          }
        } else if (modified_inputs.has(target)) {
          modified_inputs.delete(target);
        }
      });
      // clear modified inputs upon form submission
      addEventListener("submit", (evt) => {
        modified_inputs.clear();
        // to prevent the warning from happening, it is advisable
        // that you clear your form controls back to their default
        // state with evt.target.reset() or form.reset() after submission
      });
      // warn before closing if any inputs are modified
      addEventListener("beforeunload", (evt) => {
        if (modified_inputs.size) {
          const unsaved_changes_warning = "Changes you made may not be saved.";
          evt.returnValue = unsaved_changes_warning;
          return unsaved_changes_warning;
        }
      });
    })();
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const tagInput = document.getElementById('tagtxt');
      const tagColorField = document.getElementById('tagColorField');

      tagInput.addEventListener('input', () => {
        if (tagInput.value.trim() !== '') {
          tagColorField.style.display = 'block';
        } else {
          tagColorField.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>