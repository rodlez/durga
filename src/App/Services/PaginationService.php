<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use App\Services\TransactionService;

// Service for performing queries to the DataBase related to TRANSACTIONS, the TransactionController will use this service to CRUD operations related with transactions

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class

// Inject the Database class to operate with the DB

class PaginationService
{
    public function __construct(
        private Database $db
    ) {
    }

    /**
     * Generate the necessary pagination values to use in the GET method for paginate, sorting or searching terms
     * @param array $params Variables received via $_GET
     * @param string $sortDefault which column order by default
     * @param string $searchDefault which column will be search by default
     * @return array Variables to perform pagination (page, perPage, offset, searchTerm, searchCol, sort, direction, directionPrev)
     */

    public function generatePagination(array $params, string $sortDefault, string $searchDefault): array
    {
        // page and offset
        $page = $params['p'] ?? 1;
        $page = (int) $page;
        $perPage = $params['n'] ?? 25;
        $perPage = (int) $perPage;
        $offset = ($page - 1) * $perPage;
        // search
        $searchTerm = $params['s'] ?? null;
        $searchTerm = addcslashes($searchTerm ?? '', '%_');
        $searchCol = $params['scol'] ?? $searchDefault;
        // sort and direction
        $sort = $params['sort'] ?? $sortDefault;
        $direction =  $params['dir'] ?? 'ASC';
        // to NOT change the direction if we change the page using links or prev next 
        $directionPrev = $direction;
        // CHANGE sort DIRECTION for the next click
        $direction === 'ASC' ?  $direction = 'DESC' : $direction = 'ASC';

        return [
            'page' => $page,
            'perPage' => $perPage,
            'offset' => $offset,
            'searchTerm' => $searchTerm,
            'searchCol' => $searchCol,
            'sort' => $sort,
            'direction' => $direction,
            'directionPrev' => $directionPrev
        ];
    }

    /**
     * Generate the necessary pagination links, previous, next and calculates the number of pages.
     * 
     * @param int $total Total results received by the DB query that obtains the data, necessary to calculate the number of pages
     * @param array $pagination Variables returned from the generatePagination() method
     * @param array $search Optional parameter, if we have some search patterns in the DB query
     * @return mixed 3 arrays (pageLinks, previousPageQuery, nextPageQuery) and lastPage with the number of pages
     */

    public function generatePaginationLinks(int $total, array $pagination, array $search = [])
    {
        $lastPage = ceil($total / $pagination['perPage']);

        // Since will have multiple links, we need multiple query parameters for each page.
        // range will generate an array with the minimum and maximum values of the pagenumbers from 1 to lastpage pages = [1, ..., lastPage]
        $pages = $lastPage ? range(1, $lastPage) : [];

        if (!empty($search)) {

            $pageLinks = array_map(
                fn ($pageNum) => http_build_query([
                    'p' => $pageNum,
                    's' => $pagination['searchTerm'],
                    'scol' => $pagination['searchCol'],
                    'n' => $pagination['perPage'],
                    'sort' => $pagination['sort'],
                    'dir' => $pagination['directionPrev'],
                    // Search Parameters first as POST then as params to sort
                    'entry' => $search['entry'],
                    'category' => $search['category'],
                    'period' => $search['period'],
                    'tags' => json_encode($search['tags']),
                    //'amount' => $search['amount'],
                    'startAmount' => $search['startAmount'],
                    'endAmount' => $search['endAmount'],
                    'timeInterval' => $search['timeInterval'],
                    'startDate' => $search['startDate'],
                    'endDate' => $search['endDate']
                ]),
                $pages
            );

            $previousPageQuery = [
                http_build_query([
                    'p' => $pagination['page'] - 1,
                    's' => $pagination['searchTerm'],
                    'scol' => $pagination['searchCol'],
                    'n' => $pagination['perPage'],
                    'sort' => $pagination['sort'],
                    'dir' => $pagination['directionPrev'],
                    // Search Parameters first as POST then as params to sort
                    'entry' => $search['entry'],
                    'category' => $search['category'],
                    'period' => $search['period'],
                    'tags' => json_encode($search['tags']),
                    //'amount' => $search['amount'],
                    'startAmount' => $search['startAmount'],
                    'endAmount' => $search['endAmount'],
                    'timeInterval' => $search['timeInterval'],
                    'startDate' => $search['startDate'],
                    'endDate' => $search['endDate']
                ])
            ];

            $nextPageQuery = [
                http_build_query([
                    'p' => $pagination['page'] + 1,
                    's' => $pagination['searchTerm'],
                    'scol' => $pagination['searchCol'],
                    'n' => $pagination['perPage'],
                    'sort' => $pagination['sort'],
                    'dir' => $pagination['directionPrev'],
                    // Search Parameters first as POST then as params to sort
                    'entry' => $search['entry'],
                    'category' => $search['category'],
                    'period' => $search['period'],
                    'tags' => json_encode($search['tags']),
                    //'amount' => $search['amount'],
                    'startAmount' => $search['startAmount'],
                    'endAmount' => $search['endAmount'],
                    'timeInterval' => $search['timeInterval'],
                    'startDate' => $search['startDate'],
                    'endDate' => $search['endDate']
                ])
            ];
        } else {
            $pageLinks = array_map(
                fn ($pageNum) => http_build_query([
                    'p' => $pageNum,
                    's' => $pagination['searchTerm'],
                    'scol' => $pagination['searchCol'],
                    'n' => $pagination['perPage'],
                    'sort' => $pagination['sort'],
                    'dir' => $pagination['directionPrev']
                ]),
                $pages
            );

            $previousPageQuery = [
                http_build_query([
                    'p' => $pagination['page'] - 1,
                    's' => $pagination['searchTerm'],
                    'scol' => $pagination['searchCol'],
                    'n' => $pagination['perPage'],
                    'sort' => $pagination['sort'],
                    'dir' => $pagination['directionPrev']
                ])
            ];

            $nextPageQuery = [
                http_build_query([
                    'p' => $pagination['page'] + 1,
                    's' => $pagination['searchTerm'],
                    'scol' => $pagination['searchCol'],
                    'n' => $pagination['perPage'],
                    'sort' => $pagination['sort'],
                    'dir' => $pagination['directionPrev']
                ])
            ];
        }

        return [$pageLinks, $previousPageQuery, $nextPageQuery, $lastPage];
    }
}
