<?php 
    $titlePage = "Add User";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
        <div class="container overflow-scroll">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-1">
                            <h4 class="m-0 font-weight-bold text-dark">Edit New User
                                <a href="user.php" class="btn btn-sm btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body pt-1">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="user_id">
                                        <label class="control-label">First Name</label>
                                        <input type="text" class="form-control" name="fname" id="fname">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" class="form-control" name="lname" id="lname">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" value="" class="form-control" name="password" id="password" autocomplete="off">
                                            <div class="input-group-append">
                                                <button type="button" class="form-control" id="togglePassword">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="control-label" >Verified</label>
                                            <input type="checkbox" name="verifyStats"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Login Type</label>
                                        <select name="type" id="role_as" class="custom-select">
                                            <option value="">----</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">Staff</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Avatar</label>
                                        <div class="custom-file">
                                        <input type="file" name="avatar" class="form-control" id="avatarInput">

                                            <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                                        </div>
                                        <div class="form-group d-flex justify-content-left mt-2">
                                            <label>&nbsp;</label>
                                            <input type="hidden" name="avatar">
                                            <img src="" id="previewImage" class="business_logo_img img-fluid img-thumbnail">
                                        </div>                                                    
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="add_new_user_btn">Update</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include('includes/footer.php');?>
