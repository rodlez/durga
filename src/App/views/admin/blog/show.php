<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $blog */
/**  @var object $blogTranslations */
/**  @var object $user */
/**  @var object $images */
/**  @var array $tags */
// showNice($blogTranslations);
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
                        <a class="link-light text-decoration-none" href="/admin/blog/<?php echo $blog->id ?>">X</a>
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
            <!-- IMAGES -->
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Images (<?php echo count($images) ?>)
            </div>
            <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded border bg-info border-primary">
                <?php if ($images) : ?>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-light text-primary text-center align-items-center">
                            <tbody>
                                <?php foreach ($images as $image) : ?>
                                    <tr>
                                        <td class="flex align-middle justify-content-center">

                                            <?php if ($image->media_type !== 'application/pdf') : ?>
                                                <img src="<?php echo "/images/blog/" . $image->storage_filename; ?>" width="150" alt="image">
                                            <?php else : ?>
                                                <i class="fa-solid fa-file-pdf"></i>
                                            <?php endif; ?>

                                        </td>
                                        <td class="align-middle"><?php echo $image->original_filename ?></td>
                                        <td class="align-middle"><?php echo ceil($image->size / 1024); ?>KB</td>
                                        <td class="align-middle text-center">
                                            <form action="/admin/blog/<?php echo $blog->id ?>/image/<?php echo $image->id ?>" method="POST">
                                                <?php include $this->resolve("partials/_csrf.php"); ?>
                                                <input type="hidden" name="_METHOD" value="DELETE" />
                                                <button type="submit" class="p-0 m-0 border-0" onclick="return confirm('Are you sure you want to delete the image: <?php echo $image->original_filename ?> ?');">
                                                    <i class="fa-solid fa-trash text-primary"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <a href="/admin/blog/<?php echo $blog->id ?>/image" class="fw-bold text-decoration-none text-primary">Upload a image</a>
            </div>
            <!-- TRANSLATIONS -->
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Translations (<?php echo count($blogTranslations) ?>)
            </div>
            <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded border bg-info border-primary">
                <?php if ($blogTranslations) : ?>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-light">
                            <thead>
                                <tr>
                                    <th class="bg-secondary text-white text-center">Lang</th>
                                    <th class="bg-secondary text-white text-center">View</th>
                                    <th class="bg-secondary text-white text-center">Edit</th>
                                    <th class="bg-secondary text-white text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($blogTranslations as $translation) : ?>
                                    <tr>
                                        <td class="align-bottom text-center"><?php echo $translation->lang ?></td>
                                        <!-- SHOW -->
                                        <td class="align-bottom text-center">
                                            <a href="/admin/blog/<?php echo $blog->id ?>/trans/<?php echo $translation->id ?>" class="text-primary">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                        <!-- EDIT -->
                                        <td class="align-bottom text-center">
                                            <a href="/admin/blog/<?php echo $blog->id ?>/trans/<?php echo $translation->id ?>/edit" class="text-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                        <!-- DELETE -->
                                        <td class="align-bottom text-center">
                                            <form action="/admin/blog/<?php echo $blog->id ?>/trans/<?php echo $translation->id ?>" method="POST">
                                                <?php include $this->resolve("partials/_csrf.php"); ?>
                                                <input type="hidden" name="_METHOD" value="DELETE" />
                                                <button type="submit" class="p-0 m-0 border-0" onclick="return confirm('Are you sure you want to delete the translation: <?php echo $translation->lang ?> ?');">
                                                    <i class="fa-solid fa-trash text-primary"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <a href="/admin/blog/<?php echo $blog->id ?>/trans" class="fw-bold text-decoration-none text-primary">New Translation</a>
            </div>

        </div>

        <hr class="hr-heading-page w-100 my-2">

        <div class="row bg-light justify-content-center align-items-center py-4">
            <!-- BUTTONS -->
            <!-- EDIT -->
            <div class="col-lg-3 my-2">
                <a href="/admin/blog/<?php echo $blog->id ?>/edit" class="btn btn-dark w-100" role="button">Edit</a>
            </div>
            <!-- PUBLISH / UNPUBLISH -->
            <?php if ($blog->published === 0) : ?>
                <div class="col-lg-3 my-2">
                    <a href="/admin/blog/<?php echo $blog->id; ?>/published/1" class="btn btn-success w-100" role="button">Publish</a>
                </div>
            <?php else : ?>
                <div class="col-lg-3 my-2">
                    <a href="/admin/blog/<?php echo $blog->id; ?>/published/0" class="btn btn-danger w-100" role="button">UnPublish</a>
                </div>
            <?php endif; ?>
            <!-- BACK -->
            <div class="col-lg-3 my-2">
                <a href="/admin/blog" class="btn btn-warning w-100" role="button">Back</a>
            </div>
        </div>
    </div>



    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>