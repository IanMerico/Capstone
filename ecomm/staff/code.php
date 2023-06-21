<?php
    // session_start();
    include('../config/dbcon.php');
    include('../functions/myfunctions.php');

    if(isset($_POST['add_category_btn'])) {

        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keywords = $_POST['meta_keywords'];
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';

        $image = $_FILES['image']['name'];
        $path = "../uploads";

        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;

        $category_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image, created_at) VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename', NOW())";

        $category_query_run = mysqli_query($con,  $category_query);

        if($category_query_run) {

            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

            redirect("add_category.php", "Add new category successfully!");

        } else {

            redirect("add_category.php", "Something went wrong!");

        }   
    } 
    else if(isset($_POST['update_category_btn'])) {

        $path = "../uploads";
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keywords = $_POST['meta_keywords'];
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];

        if($new_image != "") {
            // $update_filename = $new_image;
            $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
            $update_filename = time().'.'.$image_ext;
        } else {
            $update_filename = $old_image;
        }

        $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status ='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";

        $update_query_run = mysqli_query($con, $update_query);

        if($update_query_run) {
            if($_FILES['image']['name'] != "") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
                if(file_exists("../uploads".$old_image)) {
                    unlink("../uploads".$old_image);
                }
            }
            redirect("edit_category.php?id=$category_id", "Category updated successfully");
        } else {
            redirect("edit_category.php?id=$category_id", "Something went wrong!");
        }

    } 
    else if(isset($_POST['delete_category_btn'])) {
        $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

        $category_query = "SELECT * FROM categories WHERE id='$category_id'";
        $category_query_run = mysqli_query($con, $category_query);
        $category_data = mysqli_fetch_array($category_query_run);
        $image = $category_data['image'];

        $delete_query = "DELETE FROM categories WHERE id='$category_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        if($delete_query_run) {

            if(file_exists("../uploads".$image)) {
                unlink("../uploads".$image);
            }
            // redirect("category.php", "Category deleted successfully");
            echo 200;

        }else {
            // redirect("category.php", "Something went wrong");
            echo 500;
        }
    }
    else if(isset($_POST['add_product_btn'])) {

        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $small_description = $_POST['small_description'];
        $description = $_POST['description'];
        $original_price = $_POST['original_price'];
        $selling_price = $_POST['selling_price'];
        $qty = $_POST['qty'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keywords = $_POST['meta_keywords'];
        $status = isset($_POST['status']) ? '1' : '0';
        $trending = isset($_POST['trending']) ? '1' : '0';
    
        $path = "../uploads";
        $data = '';
        foreach($_FILES['image']['name'] as $key => $val) {
            $image= $_FILES['image']['name'][$key];
            $file_temp = $_FILES['image']['tmp_name'][$key];
            move_uploaded_file($file_temp, $path.'/'.$image);
            $data .= $image." ";
        }
    
        $producy_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price, qty, meta_title, meta_description, meta_keywords, status, trending, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $producy_query);
    
        mysqli_stmt_bind_param($stmt, "issssdssssssss", $category_id, $name, $slug, $small_description, $description, $original_price, $selling_price, $qty, $meta_title, $meta_description, $meta_keywords, $status, $trending, $data);
    
        $producy_query_run = mysqli_stmt_execute($stmt);
    
        if($name != "" && $slug != "" && $description != "") {
            if($producy_query_run) {
                redirect("add_products.php", "Add new product successfully!");
            } else { 
                redirect("add_products.php", "Something went wrong!");
            }
        } else {
            redirect("add_products.php", "Some field cannot be empty!");
        }
    }
    else if(isset($_POST['update_product_btn'])) {

        $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    $image_names = [];
    if ($new_image != "") {
        foreach ($_FILES['image']['name'] as $key => $val) {
            $image = $_FILES['image']['name'][$key];
            $file_temp = $_FILES['image']['tmp_name'][$key];
            move_uploaded_file($file_temp, "../uploads/" . $image);
            $image_names[] = $image;
        }
    } else {
        $image_names[] = $old_image;
    }

    $update_query_products = "UPDATE products SET category_id=?, name=?, slug=?, small_description=?, description=?, original_price=?, selling_price=?, qty=?, meta_title=?, meta_description=?, status=?, trending=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($con, $update_query_products);

    $images = implode(" ", $image_names);
    mysqli_stmt_bind_param($stmt, 'issssssssssssi', $category_id, $name, $slug, $small_description, $description, $original_price, $selling_price, $qty, $meta_title, $meta_description, $status, $trending, $images, $product_id);

    $update_query_products_run = mysqli_stmt_execute($stmt);

    if ($update_query_products_run) {
        if ($_FILES['image']['name'] != "") {
            if (file_exists("../uploads" . $old_image)) {
                unlink("../uploads" . $old_image);
            }
        }
        redirect("edit_products.php?id=$product_id", "Product updated successfully");
    } else {
        redirect("edit_products.php?id=$product_id", "Something went wrong!");
    }

    } else if(isset($_POST['delete_product_btn'])) {

        $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

        $product_query = "SELECT * FROM products WHERE id='$product_id'";
        $product_query_run = mysqli_query($con, $product_query);
        $product_data = mysqli_fetch_array($product_query_run);
        $image = $product_data['image'];

        $delete_query = "DELETE FROM products WHERE id='$product_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        if($delete_query_run) {

            if(file_exists("../uploads".$image)) {
                unlink("../uploads".$image);
            }
            // redirect("products.php", "Product deleted successfully");
            echo 200;

        }else {
            // redirect("products.php", "Something went wrong");
            echo 500;
        }
        
    }
    else if(isset($_POST['update_Orders_btn'])) {
        $track_no = $_POST['tracking_no'];
        $order_status = $_POST['order_status'];
        $remark = $_POST['remark'];

        $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no'";
        $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

        $getOrderId_query = "SELECT id FROM orders WHERE tracking_no='$track_no'";
        $getOrderId_query_run = mysqli_query($con, $getOrderId_query);
        $order_id = mysqli_fetch_assoc($getOrderId_query_run)['id'];

        $insertRemark_query = "INSERT INTO order_remarks (order_id, remark) VALUES ('$order_id', '$remark')";
        $insertRemark_query_run = mysqli_query($con, $insertRemark_query);

        // Retrieve remarks from the database
        $getRemarks_query = "SELECT remark FROM order_remarks WHERE order_id='$order_id'";
        $getRemarks_query_run = mysqli_query($con, $getRemarks_query);

        // $updateRemarks_query = "UPDATE order_remarks SET remark='$remark' WHERE order_id='$order_id'";
        // $updateRemarks_query_run = mysqli_query($con, $updateRemarks_query);

    redirect("view_order.php?t=$track_no", "Order Status Updated Successfully");
    }
    else if (isset($_POST['system-frm'])) {

        $path = "../assets/images/";
        $paths = "../assets/images/";
        $systeminfo_id = $_POST['systeminfo_id'];
        $system_name = $_POST['system_name'];
        $seller_name = $_POST['seller_name'];
        $business_name = $_POST['business_name'];
        $seller_email = $_POST['seller_email'];
        $business_address = $_POST['business_address'];
    
        $new_image = $_FILES['business_logo']['name'];
        $old_image = $_POST['old_business_logo'];
    
        $old_covers = isset($_POST['old_cover']) ? $_POST['old_cover'] : [];
        $old_cover = implode(',', $old_covers);
    
        if ($new_image != "") {
            $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
            $update_filename = time() . '.' . $image_ext;
        } else {
            $update_filename = $old_image;
        }
    
        if (!empty($_FILES['cover']['name'])) {
            $update_cover_filenames = [];
            $cover_count = count($_FILES['cover']['name']);
            for ($i = 0; $i < $cover_count; $i++) {
                $cover_name = $_FILES['cover']['name'][$i];
                $cover_tmp_name = $_FILES['cover']['tmp_name'][$i];
                $cover_ext = pathinfo($cover_name, PATHINFO_EXTENSION);
                $update_cover_filename = time() . '_' . $i . '.' . $cover_ext;
                $update_cover_filenames[] = $update_cover_filename;
                move_uploaded_file($cover_tmp_name, $paths . '/' . $update_cover_filename);
            }
            $update_cover_filenames_str = implode(',', $update_cover_filenames);
        } else {
            $update_cover_filenames_str = $old_cover;
        }
    
        $update_query = "UPDATE system_info SET system_name='$system_name', seller_name='$seller_name', business_name='$business_name', seller_email='$seller_email', business_address='$business_address', business_logo='$update_filename', cover='$update_cover_filenames_str' WHERE id='$systeminfo_id'";
    
        $update_query_run = mysqli_query($con, $update_query);
    
        if ($update_query_run) {
            if ($_FILES['business_logo']['name'] != "") {
                move_uploaded_file($_FILES['business_logo']['tmp_name'], $path . '/' . $update_filename);
                if (file_exists("../uploads" . $old_image)) {
                    unlink("../uploads" . $old_image);
                }
            }
            redirect("system_info.php", "Account setting updated successfully");
        } else {
            redirect("system_info.php", "Something went wrong!");
        }
 
    } elseif(isset($_POST['add_new_user_btn'])) {

        $fname = $_POST['name'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role_as = isset($_POST['role_as']) ? '1' : '2';
        $verifyStats = isset($_POST['verifyStats']) ? '1' : '';

        $image = $_FILES['avatar']['name'];
        $path = "./img";

        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;

        $category_query = "INSERT INTO admin (name, lname, username, password, verifyStats, role_as, avatar, created_at) VALUES ('$fname', '$lname', '$username', '$password', '$verifyStats', '$role_as', '$filename', NOW())";

        $category_query_run = mysqli_query($con,  $category_query);

        if($category_query_run) {

            move_uploaded_file($_FILES['avatar']['tmp_name'], $path.'/'.$filename);

            redirect("user.php", "Added new user successfully!");

        } else {

            redirect("add_user.php", "Something went wrong!");

        }
    }
    else if(isset($_POST['update_user_btn'])) {

        $path = "./img";
        $user_id = $_POST['user_id'];
        $fname = $_POST['name'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $verifyStats = isset($_POST['verifyStats']) ? '1' : '';
        $role_as = isset($_POST['role_as']) ? $_POST['role_as'] : '2';

        $new_image = $_FILES['avatar']['name'];
        $old_image = $_POST['old_image'];

        if($new_image != "") {
            // $update_filename = $new_image;
            $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
            $update_filename = time().'.'.$image_ext;
        } else {
            $update_filename = $old_image;
        }

        $update_query = "UPDATE admin SET name='$fname', lname='$lname', username='$username', password='$password', verifyStats='$verifyStats', role_as='$role_as',  avatar='$update_filename' WHERE id='$user_id'";

        $update_query_run = mysqli_query($con, $update_query);

        if($update_query_run) {
            if($_FILES['avatar']['name'] != "") {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $path.'/'.$update_filename);
                if(file_exists("../uploads".$old_image)) {
                    unlink("../uploads".$old_image);
                }
            }
            redirect("profile.php?id=$user_id", "user updated successfully");
        } else {
            redirect("profile.php?id=$user_id", "Something went wrong!");
        }

    } 
    else if(isset($_POST['delete_user_btn'])) {
        $user_id = mysqli_real_escape_string($con, $_POST['id']);

        $user_query = "SELECT * FROM admin WHERE id='$user_id'";
        $user_query_run = mysqli_query($con, $user_query);
        $user_data = mysqli_fetch_array($user_query_run);
        $image = $user_data['avatar'];

        $delete_query = "DELETE FROM admin WHERE id='$user_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        if($delete_query_run) {

            if(file_exists("img/".$image)) {
                unlink("img/".$image);
            }
            // redirect("user.php", "Category deleted successfully");
            echo 200;

        }else {
            // redirect("category.php", "Something went wrong");
            echo 500;
        }
    }
    else {
        header('Location: http://localhost/capstone/ecomm/admin/');
    }  
?>