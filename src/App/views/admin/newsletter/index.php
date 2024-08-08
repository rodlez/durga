<?php include $this->resolve("partials/_header.php"); ?>

<!-- FLASH MESSAGE CRUD -->
<?php if (!empty($_SESSION['CRUDMessage'])) : ?>
    <div class="d-flex align-items-center text-white rounded p-1 my-2 <?php echo (substr($_SESSION['CRUDMessage'], 0, 5) === 'Error') ? "bg-danger" : "bg-success" ?>">
        <div class="p-2 flex-grow-1">
            <?php echo $_SESSION['CRUDMessage']; ?>
        </div>
        <div class="p-2">
            <a class="link-light link-opacity-100 link-opacity-50-hover text-decoration-none" href="/admin/newsletter">X</a>
        </div>
    </div>
    <?php unset($_SESSION['CRUDMessage']); ?>
<?php endif; ?>

<section id="newsletter-table" class="bg-info py-4">
    <div class="container bg-light">
        <div class="row">
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <!-- NEW Newsletter -->
                    <a class="link-primary" href="/admin/newsletter/create">New Email</a>
                </div>
            </div>
        </div>
        <hr class="hr-heading-page w-100 my-2">
        <div class="row">
            <!-- SEARCH RESULTS-->
            <div class="d-flex ">
                <div class="p-2 flex-grow-1 "><?php if ($searchTerm === null || trim($searchTerm) === '') : ?>
                        <?php echo "Found <b>(" . $totalResults . ")</b> emails in the Newsletter DB." ?>
                    <?php else : echo "Found <b>(" . $totalResults . ")</b> newsletter emails for the search term <b>[$searchTerm]</b> in the column <b>[$searchCol]</b>."; ?>
                        <a class="link-danger px-2" href="/admin/newsletter">New Search</a>
                    <?php endif; ?>

                </div>
                <div class="p-2 text-end text-primary fw-bold">Results per page</div>
            </div>
            <!-- RESULTS PER PAGE -->
            <div class="d-flex justify-content-end fw-bold">
                <div class="px-2 ">
                    <a href="/admin/newsletter/?s=<?php echo $searchTerm ?>&scol=<?php echo $searchCol ?>&n=10" class="<?php echo ($perPage === 10) ? "link-primary text-decoration-none" : "link-secondary text-decoration-none" ?>">
                        10
                    </a> |
                    <a href="/admin/newsletter/?s=<?php echo $searchTerm ?>&scol=<?php echo $searchCol ?>&n=25" class="<?php echo ($perPage === 25) ? "link-primary text-decoration-none" : "link-secondary text-decoration-none" ?>">
                        25
                    </a> |
                    <a href="/admin/newsletter/?s=<?php echo $searchTerm ?>&scol=<?php echo $searchCol ?>&n=50" class="<?php echo ($perPage === 50) ? "link-primary text-decoration-none" : "link-secondary text-decoration-none" ?>">
                        50
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <!-- SEARCH FORM -->
        <form method="GET">
            <input value="<?php echo $perPage ?>" name="n" type="hidden" />
            <div class="row">
                <!-- Search Form Columns -->
                <div class="d-flex align-items-center text-primary">
                    <div class="p-2 text-primary fw-bold">
                        Search by columns
                    </div>
                    <div class="p-2">
                        <label for="id"> Id </label>
                        <input type="radio" id="id" name="scol" value="id" <?php echo ($searchCol === 'id') ? 'checked' : '' ?>>
                    </div>
                    <div class="p-2">
                        <label for="email"> Email </label>
                        <input type="radio" id="email" name="scol" value="email" <?php echo ($searchCol === 'email') ? 'checked' : '' ?>>
                    </div>
                </div>
                <!-- Search Form Bar -->
                <div class="d-flex px-3 align-items-center">
                    <div class="flex-grow-1">
                        <input value="<?php echo (string) $searchTerm ?>" name="s" type="text" class="w-100 rounded p-2" placeholder="Enter search term" />

                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn btn-dark">
                            Search
                        </button>
                    </div>
                    <?php if ($searchTerm !== "") : ?>
                        <div class="">
                            <a class="btn btn-danger" href="/admin/newsletter" role="button">Reset</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
        <hr>
        <!-- NEWSLETTER TABLE -->
        <div class="table-responsive">
            <table class="table table-responsive table-striped">
                <!-- <a class="link-light link-opacity-100 link-opacity-50-hover text-decoration-none" href="/">X</a> -->
                <thead>
                    <tr>
                        <th class="<?php echo ($sort === 'id') ? "bg-dark" : "bg-primary" ?>">
                            <form method="GET">
                                <input value="id" name="sort" type="hidden" />
                                <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                                <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                                <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                                <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                                <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                                <button class="btn btn-link text-white text-decoration-none p-0">Id
                                    <?php if ($sort === 'id') :
                                        echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </th>
                        <th class="<?php echo ($sort === 'email') ? "bg-dark" : "bg-primary" ?>">
                            <form method="GET">
                                <input value="email" name="sort" type="hidden" />
                                <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                                <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                                <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                                <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                                <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                                <button class="btn btn-link text-white text-decoration-none p-0">Email
                                    <?php if ($sort === 'email') :
                                        echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </th>
                        <th class="<?php echo ($sort === 'created_at') ? "bg-dark" : "bg-primary" ?>">
                            <form method="GET">
                                <input value="created_at" name="sort" type="hidden" />
                                <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                                <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                                <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                                <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                                <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                                <button class="btn btn-link text-white text-decoration-none p-0">Created
                                    <?php if ($sort === 'created_at') :
                                        echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </th>
                        <th class="<?php echo ($sort === 'updated_at') ? "bg-dark" : "bg-primary" ?>">
                            <form method="GET">
                                <input value="updated_at" name="sort" type="hidden" />
                                <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                                <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                                <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                                <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                                <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                                <button class="btn btn-link text-white text-decoration-none p-0">Updated
                                    <?php if ($sort === 'updated_at') :
                                        echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <!-- Transaction Table Body -->
                <tbody>
                    <?php foreach ($newsletterList as $newsletter) : ?>
                        <tr>
                            <td class="p-2"><?php echo $newsletter->id ?></td>

                            <td class="p-2 align-items-center"><?php echo $newsletter->email ?></td>

                            <td class="p-2"><?php echo date("d/m/Y", strtotime($newsletter->created_at)); ?></td>

                            <td class="p-2"><?php echo date("d/m/Y", strtotime($newsletter->updated_at)); ?></td>

                            <!-- Actions -->
                            <td class="d-flex flex-row align-items-center justify-content-center p-2 gap-3">
                                <!-- Edit -->
                                <a href="/admin/newsletter/<?php echo $newsletter->id ?>" class="text-primary">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <!-- Delete -->
                                <form action="/admin/newsletter/<?php echo $newsletter->id ?>" method="POST">
                                    <input type="hidden" name="_METHOD" value="DELETE" />
                                    <?php include $this->resolve("partials/_csrf.php") ?>
                                    <button class="btn p-0" onclick="return confirm('Are you sure you want to delete this newsletter?');">
                                        <i class="fa-solid fa-trash text-primary"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <hr class="hr-heading-page w-100 my-2">
        <!-- Pagination -->
        <nav class="p-1 mt-1" aria-label="pagination mt-4">
            <ul class="pagination">
                <!-- First -->
                <?php if ($currentPage > 4) : ?>
                    <li class="page-item">
                        <a href="/admin/newsletter?<?php echo $pageLinks[0] ?>" class="page-link bg-dark text-light">
                            1
                        </a>
                    </li>
                <?php endif; ?>
                <!-- Previous -->
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a href="/admin/newsletter?<?php echo $previousPageQuery ?>" class="page-link">
                            < </a>
                    </li>
                <?php endif; ?>
                <!-- Page Links -->
                <?php for ($x = max(1, $currentPage - 3); $x <= min($currentPage + 3, count($pageLinks)); $x++) :

                    if ($x === $currentPage) : ?> <li class="page-item active" aria-current="page">
                        <?php else : ?>
                        <li class="page-item">
                        <?php endif; ?>
                        <a href="/admin/newsletter?<?php echo $pageLinks[$x - 1] ?>" class="page-link">
                            <?php echo $x; ?>
                        </a>
                        </li>
                    <?php endfor; ?>
                    <!-- Next -->
                    <?php if ($currentPage < $lastPage) : ?>
                        <li class="page-item">
                            <a href="/admin/newsletter?<?php echo $nextPageQuery ?>" class="page-link">
                                >
                            </a>
                        </li>
                    <?php endif; ?>
                    <!-- Last -->
                    <?php if ($currentPage < $lastPage - 3) : ?>
                        <li class="page-item">
                            <a href="/admin/newsletter?<?php echo $pageLinks[$lastPage - 1] ?>" class="page-link bg-dark text-light">
                                <?php echo $lastPage ?>
                            </a>
                        </li>
                    <?php endif; ?>
            </ul>
        </nav>


    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>