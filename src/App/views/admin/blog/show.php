<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $blog */
/**  @var object $images */
/**  @var array $tags */
//showNice($tags);
?>

<section id="contact-table" class="bg-info py-4">
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
                    <a class="link-primary" href="/admin/blog">Back</a>
                </div>
            </div>
        </div>

        <hr class="hr-heading-page w-100 my-2">

        <div class="row text-center my-4">
            <h4 class="text-primary"><?php echo $header; ?></h4>
        </div>

        <hr>

        <div class="row bg-light justify-content-center p-4 mb-5">
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
                <?php echo ($blog->published === 0) ? 'No' : 'YES'; ?>
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
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Subtitle
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $blog->subtitle; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Category
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $blog->blog_category_id; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                User ID
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $blog->user_id; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Tags
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php foreach ($tags as $tag) :
                    echo "$tag | ";
                endforeach;
                ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Content
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $blog->content; ?>
            </div>

            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Images (<?php echo count($images) ?>)
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php if ($images) : ?>
                    <table class="table table-bordered table-light">
                        <tbody>
                            <?php foreach ($images as $image) : ?>
                                <tr>
                                    <td class="flex align-middle justify-content-center">
                                        <a href="/admin/users/<?php echo $blog->id ?>/transactions/<?php echo $blog->id ?>/image/<?php echo $image->id ?>">
                                            <?php if ($image->media_type !== 'app/pdf') : ?>
                                                <img src="<?php echo "/images/blog/" . $image->storage_filename; ?>" width="50" alt="image">
                                            <?php else : ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                                </svg>
                                            <?php endif; ?>
                                        </a>
                                    </td>
                                    <td class="align-bottom"><?php echo $image->original_filename ?></td>
                                    <td class="align-bottom"><?php echo ceil($image->size / 1024); ?>KB</td>
                                    <td class="align-bottom text-center">
                                        <form action="/admin/users/<?php echo $blog->id ?>/transactions/<?php echo $blog->id ?>/image/<?php echo $image->id ?>" method="POST">
                                            <?php include $this->resolve("partials/_csrf.php"); ?>
                                            <input type="hidden" name="_METHOD" value="DELETE" />
                                            <button type="submit" class="p-1 bg-red-50 text-xs text-red-900 hover:bg-red-500 hover:text-white transition rounded" onclick="return confirm('Are you sure you want to delete the image: <?php echo $image->original_filename ?> ?');">
                                                <i class="fa-solid fa-trash text-primary"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <a href="/admin/users/<?php echo $blog->id ?>/transactions/<?php echo $blog->id ?>/image" class="fw-bold text-decoration-none text-success">Upload a image</a>
            </div>

        </div>

        <hr class="hr-heading-page w-100 my-2">

        <div class="row bg-light justify-content-center align-items-center py-4">
            <!-- BUTTONS -->
            <div class="col-lg-4 my-2">
                <a href="/admin/blog/<?php echo $blog->id ?>/edit" class="btn btn-dark w-100" role="button">Edit</a>
            </div>
            <div class="col-lg-4 my-2">
                <a href="/admin/blog" class="btn btn-success w-100" role="button">Answer</a>
            </div>
            <div class="col-lg-4 my-2">
                <a href="/admin/blog" class="btn btn-warning w-100" role="button">Back</a>
            </div>
        </div>
    </div>



    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>