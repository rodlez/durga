<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $categories */
/**  @var object $tags */
//showNice($translation);
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
                <?php echo $translation->lang; ?>
            </div>
            <!-- TITLE -->
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Title
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $translation->title; ?>
            </div>
            <!-- SUBTITLE -->
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Subtitle
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $translation->subtitle; ?>
            </div>
            <!-- Category -->
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Category
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $category; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Tags
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php foreach ($tags as $tag) :
                    echo $tag . " | ";
                endforeach;
                ?>
            </div>
            <!-- CONTENT -->
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Content
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $translation->subtitle; ?>
            </div>
            <!-- Edit -->
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                <a href="/admin/blog/<?php echo $blog->id ?>/trans/<?php echo $translation->id ?>/edit" class="btn btn-dark w-100" role="button">Edit</a>
            </div>
            <!-- Back -->
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                <a href="/admin/blog/<?php echo $blog->id; ?>" class="btn btn-primary w-100" role="button">Back</a>
            </div>

        </div>


    </div>

    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>