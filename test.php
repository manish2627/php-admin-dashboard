<form method="" action="">
    <input name="search" type="search" >
    <button type="submit" name="search_btn" >search</button>
</form>
<?php 
if(isset($_GET['search_btn'])){
include 'db.config.php';
$search = $_GET['search'];
$search_result = mysqli_query($conn, " SELECT * FROM `category_table` WHERE category_name like '%".$search."%' OR category_slug LIKE '%".$search."%'"
);
$search_data = [];
    while ($data =  mysqli_fetch_assoc($search_result)) {
        $search_data[] = $data;
    }

}
echo "<pre>";
print_r($search_data);

?>