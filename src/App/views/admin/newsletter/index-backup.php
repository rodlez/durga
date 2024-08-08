<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->
<section class="container mx-auto my-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <!-- FLASH MESSAGE CRUD -->
    <?php if (!empty($_SESSION['CRUDMessage'])) : ?>
        <div class="d-flex align-items-center text-white rounded p-1 my-2 <?php echo (substr($_SESSION['CRUDMessage'], 0, 5) === 'Error') ? "bg-danger" : "bg-success" ?>">
            <div class="p-2 flex-grow-1">
                <?php echo $_SESSION['CRUDMessage']; ?>
            </div>
            <div class="p-2">
                <a class="link-light link-opacity-100 link-opacity-50-hover text-decoration-none" href="/admin/newsletter/">X</a>
            </div>
        </div>
        <?php unset($_SESSION['CRUDMessage']); ?>
    <?php endif; ?>

    <!-- HEADER -->
    <div class="d-flex">
        <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
        <div class="p-2">
            <!-- NEW Newsletter -->
            <a class="btn btn-primary" href="/admin/newsletter/create" role="button">New Newsletter Email</a>
        </div>
    </div>
    <hr />
    <!-- SEARCH RESULTS-->
    <div class="d-flex ">
        <div class="p-2 flex-grow-1 "><?php if ($searchTerm === null || trim($searchTerm) === '') : ?>
                <?php echo "Found <b>(" . $totalResults . ")</b> emails in the Newsletter DB." ?>
            <?php else : echo "Found <b>(" . $totalResults . ")</b> newsletter emails for the search term <b>[$searchTerm]</b> in the column <b>[$searchCol]</b>."; ?>
            <?php endif; ?>
        </div>
        <div class="p-2 ">Results per page</div>
    </div>
    <?php if ($searchTerm !== "") : ?>
        <div class="p-2">
            <a class="btn btn-danger" href="/admin/newsletter" role="button">Clear Search</a>
        </div>
    <?php endif; ?>
    <!-- RESULTS PER PAGE -->
    <div class="d-flex justify-content-end">
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

    <!-- SEARCH FORM -->
    <form method="GET">
        <div class="d-flex align-items-center">
            <div class="p-2">
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
        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
        <div class="d-flex bg-black rounded mt-1 align-items-center">
            <div class="p-2 flex-grow-1">
                <input value="<?php echo (string) $searchTerm ?>" name="s" type="text" class="w-full rounded" placeholder="Enter search term" />
            </div>
            <div class="p-2">
                <button type="submit" class="btn btn-warning">
                    Search
                </button>
            </div>
        </div>
    </form>

    <!-- Categories List -->
    <table class="table-auto min-w-full divide-y divide-gray-300 mt-6">
        <thead class="bg-gray-50">
            <tr>
                <th class="<?php echo ($sort === 'id') ? "p-4 text-left text-sm font-semibold text-indigo-900" : "p-4 text-left text-sm font-semibold text-gray-900" ?>">
                    <form method="GET" class="mt-4 w-full">
                        <input value="id" name="sort" type="hidden" />
                        <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                        <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                        <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                        <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                        <button>Id
                            <?php if ($sort === 'id') :
                                echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                            <?php endif; ?>
                        </button>
                    </form>
                </th>
                <th class="<?php echo ($sort === 'email') ? "p-4 text-left text-sm font-semibold text-indigo-900" : "p-4 text-left text-sm font-semibold text-gray-900" ?>">
                    <form method="GET" class="mt-4 w-full">
                        <input value="email" name="sort" type="hidden" />
                        <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                        <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                        <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                        <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                        <button>Email
                            <?php if ($sort === 'email') :
                                echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                            <?php endif; ?>
                        </button>
                    </form>
                </th>
                <th class="<?php echo ($sort === 'created') ? "p-4 text-left text-sm font-semibold text-indigo-900" : "p-4 text-left text-sm font-semibold text-gray-900" ?>">
                    <form method="GET" class="mt-4 w-full">
                        <input value="created_at" name="sort" type="hidden" />
                        <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                        <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                        <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                        <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                        <button>Created
                            <?php if ($sort === 'created_at') :
                                echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                            <?php endif; ?>
                        </button>
                    </form>
                </th>
                <th class="<?php echo ($sort === 'updated') ? "p-4 text-left text-sm font-semibold text-indigo-900" : "p-4 text-left text-sm font-semibold text-gray-900" ?>">
                    <form method="GET" class="mt-4 w-full">
                        <input value="updated_at" name="sort" type="hidden" />
                        <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                        <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                        <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                        <input value="<?php echo $searchCol ?>" name="scol" type="hidden" />
                        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                        <button>Updated
                            <?php if ($sort === 'updated_at') :
                                echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                            <?php endif; ?>
                        </button>
                    </form>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- Transaction Table Body -->
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($newsletterList as $newsletter) : ?>
                <tr>
                    <td><?php echo $newsletter->id ?></td>

                    <td><?php echo $newsletter->email ?></td>

                    <td><?php echo date("d/m/Y", strtotime($newsletter->created_at)); ?></td>

                    <td><?php echo date("d/m/Y", strtotime($newsletter->updated_at)); ?></td>

                    <!-- Actions -->
                    <td class="p-4 text-sm text-gray-600 flex justify-center space-x-2">

                        <a href="/admin/newsletter/<?php echo $newsletter->id ?>" class="p-2 bg-emerald-50 text-xs text-emerald-900 hover:bg-emerald-500 hover:text-white transition rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <form action="/admin/newsletter/<?php echo $newsletter->id ?>" method="POST">
                            <input type="hidden" name="_METHOD" value="DELETE" />
                            <?php include $this->resolve("partials/_csrf.php") ?>
                            <button type="submit" class="p-2 bg-red-50 text-xs text-red-900 hover:bg-red-500 hover:text-white transition rounded" onclick="return confirm('Are you sure you want to delete this newsletter?');">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Pagination -->
    <nav aria-label="pagination mt-4">
        <ul class="pagination">
            <!-- First -->
            <?php if ($currentPage > 4) : ?>
                <li class="page-item">
                    <a href="/?<?php echo $pageLinks[0] ?>" class="page-link bg-dark text-light">
                        1
                    </a>
                </li>
            <?php endif; ?>
            <!-- Previous -->
            <?php if ($currentPage > 1) : ?>
                <li class="page-item">
                    <a href="/?<?php echo $previousPageQuery ?>" class="page-link">
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
</section>


<?php include $this->resolve("partials/_footer.php"); ?>