<div class="pages">
            
        <?php
            if (isset($_GET['search']) AND isset($_GET['search_col'])){
                $search = $_GET['search'];
                $search_col = $_GET['search_col'];
                $query = "SELECT COUNT(id) FROM recording_log WHERE ". $search_col . " LIKE '%". $search. "%'";
                $new_total = mysqli_query($conn, $query);
                $total_rows = mysqli_fetch_array($new_total)[0];
                if (isset($_GET['per_page'])) {
                    $per_page=$_GET['per_page'];
                }
                $total_pages = ceil($total_rows/$per_page);
                if ($page > 1){
                    echo '<a class="page-link" href="/?search='.$search.'&search_col='.$search_col.'&per_page=' . $per_page .'&page=1"><img src="static/img/first_page.png"/></a>';
                    echo '<a class="page-link" href="/?search='.$search.'&search_col='.$search_col.'&per_page=' . $per_page .'&page=' . ($page-1) . '"><img src="static/img/previous_page.png" /></a>';
                }
                else {
                    echo '<span class="inactive"><img src="static/img/first_page.png"/></span>';
                    echo '<span class="inactive"><img src="static/img/previous_page.png" /></span>';
                }
            ?>
                <span>
                    Page <?php echo $page; ?> of <?php echo $total_pages; ?>
                </span>
            <?php
                if ($page < $total_pages){
                    echo '<a class="page-link" href="/?search='.$search.'&search_col='.$search_col.'&per_page=' . $per_page . '&page=' . ($page + 1) . '"><img src="static/img/next_page.png" /></a>';
                    echo '<a class="page-link" href="/?search='.$search.'&search_col='.$search_col.'&per_page=' . $per_page .'&page=' . $total_pages . '"><img src="static/img/last_page.png" /></a>';
                }
                else{
                    echo '<span class="inactive"><img src="static/img/next_page.png" /></span>';
                    echo '<span class="inactive"><img src="static/img/last_page.png" /></span>';
                }
            }
            else {
                if (isset($_GET['per_page'])) {
                    $per_page=$_GET['per_page'];
                }
                $total_pages = ceil($total_rows/$per_page);
                if ($page > 1){
                    echo '<a class="page-link" href="/?per_page=' . $per_page .'&page=1"><img src="static/img/first_page.png"/></a>';
                    echo '<a class="page-link" href="/?per_page=' . $per_page .'&page=' . ($page-1) . '"><img src="static/img/previous_page.png" /></a>';
                }
                else {
                    echo '<span class="inactive"><img src="static/img/first_page.png"/></span>';
                    echo '<span class="inactive"><img src="static/img/previous_page.png" /></span>';
                    }
                ?>
                <span>
                    Page <?php echo $page; ?> of <?php echo $total_pages; ?>
                </span>
                <?php
                if ($page < $total_pages){
                    echo '<a class="page-link" href="/?per_page=' . $per_page . '&page=' . ($page + 1) . '"><img src="static/img/next_page.png" /></a>';
                    echo '<a class="page-link" href="/?per_page=' . $per_page .'&page=' . $total_pages . '"><img src="static/img/last_page.png" /></a>';
                }
                else{
                    echo '<span class="inactive"><img src="static/img/next_page.png" /></span>';
                    echo '<span class="inactive"><img src="static/img/last_page.png" /></span>';
                }
            }
                ?>
            
</div>