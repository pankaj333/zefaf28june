<?php
$table = 'wed_store_category';
 
$fields = array (
    array (
        'name' => 'id'
        , 'type' => 'key'
        , 'title' => 'ID'
    )
    /*, array (
        'name' => 'i_parent_id'
        , 'type' => 'input'
        , 'title' => 'Parent Catgory'
		, 'value' => '0'
    )*/
    , array (
        'name' => 's_category_name'
        , 'type' => 'input'
        , 'title' => 'Category Name'
        , 'is_link' => 1
        
    )
    , array (
        'name' => 'css_class'
        , 'type' => 'input'
        , 'title' => 'Category Class'
        , 'is_link' => 1
        
    )
    
    , array (
        'name' => 'i_displayorder'
        , 'type' => 'input'
        , 'title' => 'Order Number'
        , 'is_link' => 1
         
    )
    
 
    , array (
        'name' => 'i_is_active'
        , 'type' => 'check'
        , 'title' => 'Is active'
    )
    , array (
        'name' => 'managing'
        , 'type' => 'managing'
        , 'title' => 'Actions'
        , 'delete_link' => '/category/delete/*'
        , 'edit_link' => '/category/edit/*'
        , 'non_db' => 1
        , 'single_mode' => 0
    )
);