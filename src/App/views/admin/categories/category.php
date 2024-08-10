<?php include $this->resolve("partials/_header.php"); ?>
<!-- Start Main Content Area -->
<?php /*var_dump($entries) ?>
<?php echo date('Y-m-d H:i:s');  */ ?>


<section class="container mx-auto my-12 p-4 bg-white shadow-md border border-gray-200 rounded">

    <!-- FLASH MESSAGE CRUD -->
    <?php if (!empty($_SESSION['CRUDMessage'])) { ?>
        <div class="row">
            <?php if (substr($_SESSION['CRUDMessage'], 0, 5) === 'Error') {
            ?><div class="col text-danger"><?php echo $_SESSION['CRUDMessage']; ?></div>
            <?php } else {
            ?>
                <div class="col text-success"><?php echo $_SESSION['CRUDMessage']; ?></div>
            <?php } ?>
        </div>

    <?php unset($_SESSION['CRUDMessage']);
    } ?>

    <a href="/admin" class="btn btn-primary" role="button">Back
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
        </svg>
    </a>


    <div class="flex items-center justify-between border-b border-gray-200 pb-4">

        <h5 class="font-medium">Categories List - Total Categories
            <?php if ($searchTerm === null || trim($searchTerm) === '') { ?>
            <?php echo $totalResults;
            } else {
                echo "for ($searchTerm) : $totalResults";
            } ?>
        </h5>
        <div class="flex space-x-4">Results per page (<?php echo $perPage ?>)
            <form method="GET" class="mt-4 w-full">
                <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                <select name="n" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="1" <?php echo ($perPage === 1) ? 'selected' : '' ?>>1</option>
                    <option value="2" <?php echo ($perPage === 2) ? 'selected' : '' ?>>2</option>
                    <option value="3" <?php echo ($perPage === 3) ? 'selected' : '' ?>>3</option>
                </select>
                <button>Select</button>
            </form>
        </div>

        <div class="flex space-x-4">
            <a href="/admin/category/create" class="flex items-center p-2 bg-sky-50 text-xs text-sky-900 hover:bg-sky-500 hover:text-white transition rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                New Category
            </a>
        </div>

    </div>
    <!-- Search Form -->
    <form method="GET" class="mt-4 w-full">
        <div class="flex">
            <input value="<?php echo (string) $searchTerm ?>" name="s" type="text" class="w-full rounded-l-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter search term" />
            <input value="<?php echo $perPage ?>" name="n" type="hidden" />
            <button type="submit" class="rounded-r-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Search
            </button>
        </div>
    </form>
    <!-- Transaction List -->
    <table class="table-auto min-w-full divide-y divide-gray-300 mt-6">
        <thead class="bg-gray-50">
            <tr>
                <th class="<?php echo ($sorting === 'name') ? "p-4 text-left text-sm font-semibold text-indigo-900" : "p-4 text-left text-sm font-semibold text-gray-900" ?>">
                    <form method="GET" class="mt-4 w-full">
                        <input value="name" name="sort" type="hidden" />
                        <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                        <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                        <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                        <button>Name
                            <?php if ($sorting === 'name') :
                                echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                            <?php endif; ?>
                        </button>
                    </form>
                </th>
                <th class="<?php echo ($sorting === 'created') ? "p-4 text-left text-sm font-semibold text-indigo-900" : "p-4 text-left text-sm font-semibold text-gray-900" ?>">
                    <form method="GET" class="mt-4 w-full">
                        <input value="created_at" name="sort" type="hidden" />
                        <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                        <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                        <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                        <button>Created
                            <?php if ($sorting === 'created_at') :
                                echo $direction === 'ASC' ? "&uarr;" : "&darr;" ?>
                            <?php endif; ?>
                        </button>
                    </form>
                </th>
                <th class="<?php echo ($sorting === 'updated') ? "p-4 text-left text-sm font-semibold text-indigo-900" : "p-4 text-left text-sm font-semibold text-gray-900" ?>">
                    <form method="GET" class="mt-4 w-full">
                        <input value="updated_at" name="sort" type="hidden" />
                        <input value="<?php echo $direction ?>" name="dir" type="hidden" />
                        <input value="<?php echo $currentPage ?>" name="p" type="hidden" />
                        <input value="<?php echo $searchTerm ?>" name="s" type="hidden" />
                        <input value="<?php echo $perPage ?>" name="n" type="hidden" />
                        <button>Updated
                            <?php if ($sorting === 'updated_at') :
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
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $category->name ?></td>

                    <td><?php echo date("d/m/Y", strtotime($category->created_at)); ?></td>

                    <td><?php echo date("d/m/Y", strtotime($category->updated_at)); ?></td>

                    <!-- Actions -->
                    <td class="p-4 text-sm text-gray-600 flex justify-center space-x-2">

                        <a href="/admin/category/<?php echo $category->id ?>" class="p-2 bg-emerald-50 text-xs text-emerald-900 hover:bg-emerald-500 hover:text-white transition rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <form action="/admin/category/<?php echo $category->id ?>" method="POST">
                            <input type="hidden" name="_METHOD" value="DELETE" />
                            <?php include $this->resolve("partials/_csrf.php") ?>
                            <button type="submit" class="p-2 bg-red-50 text-xs text-red-900 hover:bg-red-500 hover:text-white transition rounded" onclick="return confirm('Are you sure you want to delete this category?');">
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
    <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0 mt-6">
        <!-- Previous Page Link -->
        <div class="-mt-px flex w-0 flex-1">
            <?php if ($currentPage > 1) : ?>
                <a href="/admin/category?<?php echo $previousPageQuery ?>" class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                    <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd" />
                    </svg>
                    Previous
                </a>
            <?php endif; ?>
        </div>
        <!-- Pages Link -->
        <div class="hidden md:-mt-px md:flex">
            <?php // we grab ($pageNum => $query) (pageNum will have the value of the key of the pageLinks array, 0,1,2...)
            foreach ($pageLinks as $pageNum => $query) : ?>
                <a href="/admin/category?<?php echo $query ?>" class="<?php echo (($pageNum + 1) === $currentPage) ? "border-indigo-500 text-indigo-600" : "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" ?>inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium">
                    <?php echo $pageNum + 1; ?>
                </a>
            <?php endforeach; ?>
            <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
        </div>
        <!-- Next Page Link -->
        <div class="-mt-px flex w-0 flex-1 justify-end">
            <?php if ($currentPage < $lastPage) : ?>
                <a href="/admin/category?<?php echo $nextPageQuery ?>" class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                    Next
                    <svg class="ml-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </nav>
</section>
<!-- End Main Content Area -->

<?php include $this->resolve("partials/_footer.php"); ?>

</body>

</html>