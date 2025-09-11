<?php

if (!class_exists("WP_List_Table")) {
    include_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class ShoesListTable extends WP_List_Table
{

    public function prepare_items()
    {
        global $wpdb;

        $tablePrefix = $wpdb->prefix;
        $per_page = 5;

        // Order by
        $orderBy = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : "id";
        $order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : "ASC";

        // Search keyword
        $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : false;

        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

        $this->_column_headers = array($this->get_columns(), [], $this->get_sortable_columns());

        if ($search) {
            // Total number of shoes
            $totalShoes = $wpdb->get_results(
                "SELECT * FROM {$tablePrefix}shoes_system 
                 WHERE name LIKE '%{$search}%' OR author LIKE '%{$search}%'",
                ARRAY_A
            );

            // Shoes on limit
            $shoes = $wpdb->get_results(
                "SELECT * FROM {$tablePrefix}shoes_system 
                 WHERE name LIKE '%{$search}%' OR author LIKE '%{$search}%'
                 ORDER BY {$orderBy} {$order}
                 LIMIT {$offset}, {$per_page}",
                ARRAY_A
            );

            $totalShoeItems = count($totalShoes);
        } else {
            // Total number of shoes
            $totalShoes = $wpdb->get_results(
                "SELECT * FROM {$tablePrefix}shoes_system",
                ARRAY_A
            );

            // Shoes on limit
            $shoes = $wpdb->get_results(
                "SELECT * FROM {$tablePrefix}shoes_system 
                 ORDER BY {$orderBy} {$order}
                 LIMIT {$offset}, {$per_page}",
                ARRAY_A
            );

            $totalShoeItems = count($totalShoes);
        }

        $this->set_pagination_args(array(
            "total_items" => $totalShoeItems,
            "per_page" => $per_page,
            "total_pages" => ceil($totalShoeItems / $per_page)
        ));

        $this->items = $shoes;
    }

    // Return column name
    public function get_columns()
    {
        $columns = [
            "cb" => '<input type="checkbox" />',
            "id" => "ID",
            "name" => "Shoe Name",
            "author" => "Author Name",
            "profile_image" => "Shoe Cover",
            "shoe_price" => "Shoe Cost",
            "created_at" => "Created at"
        ];

        return $columns;
    }

    // No data found
    public function no_items()
    {
        echo "No Shoe(s) Found";
    }

    // To display data
    public function column_default($singleShoe, $col_name)
    {
        return isset($singleShoe[$col_name]) ? $singleShoe[$col_name] : "N/A";
    }

    // Add Sorting Icons
    public function get_sortable_columns()
    {
        $columns = array(
            "id" => array("id", true),   // default desc
            "name" => array("name", false) // default asc
        );

        return $columns;
    }

    // Add Checkbox to rows
    public function column_cb($shoe)
    {
        return '<input type="checkbox" name="shoe_id[]" value="' . esc_attr($shoe['id']) . '" />';
    }

    // Render Image in place of URL
    public function column_profile_image($shoe)
    {
        return '<img src="' . esc_url($shoe['profile_image']) . '" height="100" width="100" />';
    }
}
