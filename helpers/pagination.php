<div class="pages">
        <?php
            if ($page > 1){
                echo '<a class="page-link" href="records.php?page=1">first</a>';
                echo '<a class="page-link" href="records.php?page=' . ($page-1) . '">prev</a>';
            }
        ?>
            <span>
                Page <?php echo $page; ?> of <?php echo ($total_rows/$per_page); ?>
            </span>
        <?php
            if (!isset($_GET['page'])){
                echo '<a class="page-link" href="records.php?page=' . ($page + 1) . '">next</a>';
                echo '<a class="page-link" href="records.php?page=' . ($total_rows/$per_page) . '">last</a>';
            }
            else {
                if ($_GET['page'] < ($total_rows/$per_page)){
                    echo '<a class="page-link" href="records.php?page=' . ($page + 1) . '">next</a>';
                    echo '<a class="page-link" href="records.php?page=' . ($total_rows/$per_page) . '">last</a>';
                }
            }
        ?>
</div>