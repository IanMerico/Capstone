<?php 
$titlePage = "Account Settings";
include('../middleware/adminMidleware.php');
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="container overflow-scroll">
    <div class="row">
        <div class="col-md-12">

        <?php
            $systemInfo = systeminfo();

            if(mysqli_num_rows($systemInfo) > 0) {

                $data = mysqli_fetch_array($systemInfo);

        ?>

            <div class="card">
                <div class="card-header pb-1">
                    <h4 class="m-0 font-weight-bold text-dark">Update System Info
                        <!-- <a href="category.php" class="btn btn-sm btn-primary float-end">Back</a> -->
                    </h4>
                </div>
                <div class="card-body pt-1">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="systeminfo_id" value="<?= $data['id'] ?>">
                                    <label for="system_name" class="control-label">System Name</label>
                                    <input type="text" value="<?= $data['system_name'];?>" class="form-control" name="system_name" id="system_name">
                                </div>
                                <div class="form-group">
                                    <label for="seller_name" class="control-label">System Short Name</label>
                                    <input type="text" value="<?= $data['seller_name'];?>" class="form-control" name="seller_name" id="seller_name">
                                </div>
                                <div class="form-group">
                                    <label for="business_name" class="control-label">Company Name</label>
                                    <input type="text" value="<?= $data['business_name'];?>" class="form-control" name="business_name" id="business_name">
                                </div>
                                <div class="form-group">
                                    <label for="seller_email" class="control-label">Company Email</label>
                                    <input type="text" value="<?= $data['seller_email'];?>" class="form-control" name="seller_email" id="seller_email">
                                </div>
                                <div class="form-group">
                                    <label for="business_address" class="control-label">Company Address</label>
                                    <textarea rows="3" value="<?= $data['business_address'];?>" class="form-control" name="business_address" id="business_address"><?= $data['business_address'];?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">System Logo</label>
                                    <div class="custom-file">
                                        <input type="file" name="business_logo" class="form-control"  >
                                        <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                                    </div>
                                    <div class="form-group d-flex justify-content-left mt-2">
                                        <label for="">Current System Logo &nbsp; </label>
                                        <input type="hidden" name="old_business_logo" value="<?= $data['business_logo'] ?>">
                                        <img src="../assets/images/<?= $data['business_logo'] ?>" alt="<?= $data['business_logo'] ?>" id="cimg" class="business_logo_img img-fluid img-thumbnail">
                                    </div>                                                    
                                </div>
                                <div class="form-group">
                                <label for="">Cover</label>
                                <div class="custom-file">
                                    <input type="file" name="cover[]" class="form-control" multiple>
                                </div>
                                <div class="form-group d-flex justify-content-left mt-2">
                                    <th><label for="">Cover Page &nbsp;</label></th>
                                    <ul class="cover-list">
                                        <?php
                                        // Assuming $data['cover'] contains a comma-separated string of cover filenames
                                        if (!empty($data['cover'])) {
                                            $cover_filenames = explode(',', $data['cover']);
                                            foreach ($cover_filenames as $cover) {
                                                echo '<input type="hidden" name="old_cover[]" value="' . $cover . '">';
                                                echo '<li><img src="../assets/images/' . $cover . '" alt="' . $cover . '" class="cover_logo_img"></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                                <!-- <div class="form-group">
                                    <label for="" class="control-label">Cover</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="cover" name="cover">
                                        <label class="custom-file-label" for="customFile2">Choose file</label>
                                    </div>
                                    <img src="" alt="" id="cover" class="img-fluid img-thumbnail d-none">
                                </div> -->
                            </div>
                        </div>  
                <?php
                              }
                ?>               
                        <div class="card-footer">
                            <div class="col-md-12 text-center">
                                <!-- <div class="row"> -->
                                    <button type="submit" class="btn btn-sm btn-primary" name="system-frm" >Update</button>
                                <!-- </div> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div

<?php include('includes/footer.php');?>