<?php 
    $titlePage = "Verified Customer";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container overflow-scroll sticky">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header  pb-1 py-3">
                    <h4 class="m-0 font-weight-bold text-dark">
                        List of verified customer
                    </h4>
                    <!-- Search Bar -->
                    <div class="mt-3">
                    <form id="searchForm" class="form-inline justify-content-end">
                        <div class="form-group">
                            <!-- <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search by name"> -->
                            <!-- <button type="submit" class="btn btn-primary ml-2">Search</button> -->
                        </div>
                    </form>
                </div>

                </div>
                <div class="card-body pt-2" id="category_table">
                    <div class="table-responsive">
                        <table class="table table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Verified Account</th>
                                    <th>Date Created</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $admin = getAllCustomers("users");

                                // Check if a search query is provided
                                if (isset($_GET['search'])) {
                                    $search = $_GET['search'];
                                    $admin = searchCustomersByName("users", $search);
                                } else {
                                    $admin = getAllCustomers("users");
                                }
                                    if(mysqli_num_rows($admin) > 0) {
                                        // Pagination configuration
                                        $resultsPerPage = 10;
                                        $totalResults = mysqli_num_rows($admin);
                                        $totalPages = ceil($totalResults / $resultsPerPage);

                                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                            $currentPage = $_GET['page'];
                                        } else {
                                            $currentPage = 1;
                                        }

                                        $startIndex = ($currentPage - 1) * $resultsPerPage;
                                        $admin = getCustomersWithLimit("users", $startIndex, $resultsPerPage);

                                        foreach($admin as $item) {
?>
                                <tr class="#">
                                    <td><?= $item['user_id']?></td>
                                    <td><?= $item['name']?>&nbsp;<?= $item['lname']?></td>
                                    <td><?= $item['email']?></td>
                                    <td>
<?php 
                                            if ($item['verifyStatus'] == '1') { 
?>
                                            <span class="active">Verified</span>
<?php 
                                            } else { 
?>
                                            <span class="inactive">Not Verified</span>
<?php 
                                            } 
?>
                                    </td>
                                    <td><?= date("F d Y: h:i A",strtotime($item['created_at'])); ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCustomer"  data-userid="<?= $item['user_id']?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
<?php
                                    }
                                } else { 
                                    echo "No records founds";
                                }
?>                                                 
                            </tbody>
                        </table>
                    </div>
<div class="text-center">
<?php 
        if ($totalPages > 1) { 
?>
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center">
<?php 
                    if ($currentPage > 1) { 
?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $currentPage - 1 ?>" tabindex="-1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
<?php 
                    } 
?>             
<?php 
                    for ($i = 1; $i <= $totalPages; $i++) { 
?>
                    <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
<?php 
                    } 
?>
                
<?php 
                    if ($currentPage < $totalPages) { 
?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
<?php 
                    } 
?>
            </ul>
        </nav>
<?php 
        } 
?>
</div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Customer Informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to fetch and display the customer data based on the search query
        function searchCustomers(query) {
            $.ajax({
                url: 'search_data.php',
                method: 'POST',
                data: { search: query },
                success: function(response) {
                    $('#category_table tbody').html(response);
                },
                error: function() {
                    alert('Error occurred. Please try again later.');
                }
            });
        }

        // Event handler for input change
        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().trim();
            searchCustomers(searchQuery);
        });

        $('button.btn-primary').click(function() {
            var userId = $(this).data('userid');

            $.ajax({
                url: 'fetch_data.php',
                method: 'POST',
                data: { userId: userId },
                success: function(response) {
                    $('.modal-body').html(response);
                },
                error: function() {
                    alert('Error occurred. Please try again later.');
                }
            });
        });

        $('#exampleModalCustomer').on('hidden.bs.modal', function() {
            $('button.btn-primary').blur();
            $('.modal-body').html('');
        });
    });
</script>


