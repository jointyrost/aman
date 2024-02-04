<?php include $this->resolve('partials/_header.php'); ?>

<!-- Start Main Content Area -->
<section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
        <h4 class="font-medium">Employe List</h4>
    </div>
    <!-- Search Form -->
    <form method="GET" class="mt-4 w-full">
        <div class="flex">
            <input value="<?php e($searchTerm); ?>" name="s" type="text" class="w-full rounded-l-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter Name" />
            <button type="submit" class="rounded-r-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Search
            </button>
        </div>
    </form>
    <!-- Transaction List -->
    <table class="table-auto min-w-full divide-y divide-gray-300 mt-6">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 text-left text-sm font-semibold text-gray-900">
                    Name
                </th>
                <th class="p-4 text-left text-sm font-semibold text-gray-900">
                    Email
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- Transaction Table Body -->
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($employes as $employe) : ?>
                <tr>
                    <!-- Description -->
                    <td class="p-4 text-sm text-gray-600">
                        <?php echo e($employe['name']); ?>
                    </td>
                    <!-- email -->
                    <td class="p-4 text-sm text-gray-600">
                        <?php echo e($employe['email']); ?>
                    </td>
                    <!-- Actions -->
                    <td class="p-4 text-sm text-gray-600 flex justify-center space-x-2">
                        <a href="/edit/<?php echo e($employe['id']); ?>" class="p-2 bg-emerald-50 text-xs text-emerald-900 hover:bg-emerald-500 hover:text-white transition rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <form action="/edit/<?php echo e($employe['id']); ?>" method="POST">
                            <input name="_METHOD" value="DELETE" type="hidden" />
                            <?php include $this->resolve("partials/_csrf.php"); ?>
                            <button type="submit" class="p-2 bg-red-50 text-xs text-red-900 hover:bg-red-500 hover:text-white transition rounded">
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
                <a href="/?<?php echo e($previousPageQuery); ?>" class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                    <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd" />
                    </svg>
                    Previous
                </a>
            <?php endif; ?>
        </div>
        <!-- Pages Link -->
        <div class="hidden md:-mt-px md:flex">
            <?php foreach ($pageLinks as $pageNum => $query) : ?>
                <a href="/?<?php echo e($query); ?>" class="<?php echo $currentPage === $pageNum + 1 ? "border-indigo-500 text-indigo-600" : "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"; ?>inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium">
                    <?php echo $pageNum + 1; ?>
                </a>
            <?php endforeach; ?>
            <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
        </div>
        <!-- Next Page Link -->
        <div class="-mt-px flex w-0 flex-1 justify-end">
            <?php if ($currentPage < $lastPage) : ?>
                <a href="/?<?php echo e($nextPageQuery); ?>" class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
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

<?php include $this->resolve('partials/_footer.php'); ?>