<div class="pages">
            
        <?php
            if (isset($_GET['show_rows'])) {
                $per_page=$_GET['show_rows'];
            }
            $total_pages = ceil($total_rows/$per_page);
            if ($page > 1){
                echo '<a class="page-link" href="records.php?per_page=' . $per_page .'&page=1">&lt;&lt;</a>';
                echo '<a class="page-link" href="records.php?per_page=' . $per_page .'&page=' . ($page-1) . '">&lt;</a>';
            }
            else {
                echo '<span class="inactive">&lt;&lt;</span>';
                echo '<span class="inactive">&lt;</span>';
            }
        ?>
            <span>
                Page <?php echo $page; ?> of <?php echo $total_pages; ?>
            </span>
        <?php
            if ($page < $total_pages){
                echo '<a class="page-link" href="records.php?per_page=' . $per_page . '&page=' . ($page + 1) . '">&gt;</a>';
                echo '<a class="page-link" href="records.php?per_page=' . $per_page .'&page=' . $total_pages . '">&gt;&gt;</a>';
            }
            else{
                echo '<span class="inactive">&gt;</span>';
                echo '<span class="inactive">&gt;&gt;</span>';
            }

        ?>
        <form action="" method="GET" id="per-page">
                <select class="rows-per-page" name="per_page">
                    <option value="1"<?php if ($per_page == 1){echo "selected";} ?>>1</option>
                    <option value="10"<?php if ($per_page == 10){echo "selected";} ?>>10</option>
                    <option value="25"<?php if ($per_page == 25){echo "selected";} ?>>25</option>
                    <option value="50"<?php if ($per_page == 50){echo "selected";} ?>>50</option>
                    <option value="100"<?php if ($per_page == 100){echo "selected";} ?>>100</option>
                </select>
                <input type="submit" value="per page">
        </form>
</div>