<?php
session_start();
include '../db.config.php';
if (!isset($_SESSION['logedin'])) {
    header("location:".APP_URL."/login.php");
} else {
    //add new catagory 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $user = $_SESSION['username'];                     
    
                if($title != ''){
                    
                    mysqli_query($conn, "INSERT INTO blogs_table ( `blog_title`, `blog_description`, `created_by`) VALUES ('$title','$desc','$user')");
                    header("location:".APP_URL."/blogs/all_blogs.php");
                }
            }
            
            
        }
    



?>
    <!DOCTYPE html>
    <html>

    <head>
        
        <title>Add new blog </title>
        <!-- include Boostrap 5 -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <!-- include tinymce -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        
    </head>

    <body id="page-top">
    <?php include '../header.php'?>
  
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method='post' action=''>
                            <div class="mb-3">
                                <label><strong>Add your Blog Title :</strong></label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="mb-1">
                                <label><strong>Blog Description :</strong></label>
                                <textarea id="mytextarea" name='desc' class="form-control"></textarea><br>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script -->
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
                'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
                'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange styleselect | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>

               <?php include '../footer.php'?>
    </body>

    </html> 

<?php }
?>