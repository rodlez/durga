<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $blog */
/**  @var object $user */
/**  @var object $categories */
/**  @var object $tags */
/**  @var object $selectedTags */
//showNice($tags, 'TAGS');
//showNice($selectedTags);
?>

<section id="blog-table" class="bg-info py-4">
    <div class="container bg-light">
        <div class="row">
            <!-- FLASH MESSAGE CRUD -->
            <?php if (!empty($_SESSION['CRUDMessage'])) : ?>
                <div class="d-flex align-items-center text-white rounded px-2 <?php echo (substr($_SESSION['CRUDMessage'], 0, 5) === 'Error') ? "bg-danger" : "bg-success" ?>">
                    <div class="p-2 flex-grow-1">
                        <?php echo $_SESSION['CRUDMessage']; ?>
                    </div>
                    <div class="p-2">
                        <a class="link-light text-decoration-none" href="/admin/blog">X</a>
                    </div>
                </div>
                <?php unset($_SESSION['CRUDMessage']); ?>
            <?php endif; ?>
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <!-- NEW blog -->
                    <a class="link-primary" href="/admin/blog/<?php echo $blog->id ?>">Back</a>
                </div>
            </div>
        </div>

        <hr class="hr-heading-page w-100 my-2">

        <div class="row text-center my-4">
            <h4 class="text-primary"><?php echo $header; ?></h4>
        </div>

        <hr>

        <!-- Form -->
        <form method="POST" class="contacto-form p-4">
            <!-- CSRF TOKEN  -->
            <?php include $this->resolve('partials/_csrf.php'); ?>

            <div class="row bg-light justify-content-center p-4 mb-5">
                <!-- ORIGINAL BLOG ENTRY -->
                <div class="col-lg-2 my-2 p-2 rounded">
                </div>
                <div class="col-lg-8 offset-lg-1 bg-dark text-white my-2 p-2 rounded">
                    Original Blog Entry
                </div>
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    User
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $user->email; ?>
                </div>
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Created
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo date("d/m/Y", strtotime($blog->created_at)); ?>
                </div>
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Updated
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo date("d/m/Y", strtotime($blog->updated_at)); ?>
                </div>
                <div class="col-lg-2 <?php echo ($blog->published === 0) ? 'bg-danger' : 'bg-success'; ?> text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Published
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo ($blog->published === 0) ? 'No' : 'Yes'; ?>
                </div>
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Author
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $blog->author; ?>
                </div>
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Title
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $blog->title; ?>
                </div>
                <!-- TRANSLATION BLOG ENTRY -->
                <div class="col-lg-2 my-2 p-2 rounded">
                </div>
                <div class="col-lg-8 offset-lg-1 bg-dark text-white my-2 p-2 rounded">
                    Translation Blog Entry
                </div>
                <!-- LANGUAGE -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Language (ISO Code)
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="lang" name="lang" value="<?php echo $translation->lang; ?>" maxlength="6">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('lang', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['lang'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- TITLE -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Title
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="title" name="title" value="<?php echo $translation->title; ?>" maxlength="250">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('title', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['title'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- SUBTITLE -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Subtitle
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="title" name="subtitle" value="<?php echo $translation->subtitle; ?>" maxlength="250">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('subtitle', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['subtitle'][0]); ?>
                    </div>
                <?php endif; ?>

                <!-- Category -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Category
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <select name="category" id="category" class="form-control">
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category->id === $translation->blog_category_id) : ?>
                                <option value="<?php echo $category->id; ?>" selected><?php echo $category->name . "(" . $category->lang . ")"; ?></option>
                            <?php else :  ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name . "(" . $category->lang . ")"; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Tag -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Tags
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <div class="row">
                        <?php foreach ($tags as $x => $tag) : ?>
                            <div class="col-lg-4 col-md-4 col-sm-6 px-3">
                                <input class="form-check-input" type="checkbox" id="<?php echo $tag->name; ?>" name="tag[]" value="<?php echo $tag->id; ?>" <?php
                                                                                                                                                            foreach ($selectedTags as $selectedTag) :
                                                                                                                                                                if ((int)$selectedTag->tag_id === (int)$tag->id) :
                                                                                                                                                                    echo "checked";
                                                                                                                                                                endif;
                                                                                                                                                            endforeach;
                                                                                                                                                            ?>>
                                <label class="form-check-label" for="<?php echo $tag->name; ?>"><?php echo $tag->name . "(" . $tag->lang . ")"; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('tag', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['tag'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- CONTENT -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Content
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <textarea name="content" id="trumbowyg-editor" rows="10" cols="50" class="w-100 rounded"><?php echo $translation->content; ?></textarea>
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('content', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['content'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- Send -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <button class="btn btn-secondary w-100" type="submit">Submit</button>
                </div>
                <!-- Back -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <a href="/admin/blog/<?php echo $blog->id; ?>" class="btn btn-primary w-100" role="button">Back</a>
                </div>

            </div>

        </form>

    </div>

    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>