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
                                <div class="col-md-12 mb-2">
                                    <label for="">Meta Title <small><i>(HTML element that specifies the title of a web page)</i></small></label>
                                    <input type="text" name="meta_title" value="<?= $data['meta_title'];?>" placeholder="Enter meta title" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="">Meta Description <small><i>(HTML element that provides a brief summary of the content of a web page.)</i> </small></label>
                                    <textarea rows="3" name="meta_description"  class="form-control"><?= $data['meta_description'];?></textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="">Meta Keywords <small><i>(Meta keywords are an HTML element that provides a list of relevant keywords or phrases that describe the content of a web page. )</i> </small></label>
                                    <textarea rows="3" name="meta_keywords"  placeholder="Enter meta keywords" class="form-control"><?= $data['meta_keywords'];?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">System Logo</label>
                                        <div class="custom-file">
                                            <input type="file" name="business_logo" class="form-control" id="business_logo" onchange="previewLogo(event)">
                                        </div>
                                        <div class="form-group d-flex justify-content-left mt-2">
                                            <label for="">Current System Logo &nbsp; </label>
                                            <input type="hidden" name="old_business_logo" value="<?= $data['business_logo'] ?>">
                                            <img src="../assets/images/<?= $data['business_logo'] ?>" alt="<?= $data['business_logo'] ?>" id="preview_logo" class="business_logo_img img-fluid img-thumbnail">
                                        </div>                                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="">Cover</label>
                                        <div class="custom-file">
                                            <input type="file" name="cover[]" class="form-control" multiple id="cover" onchange="previewCover(event)">
                                        </div>
                                        <div class="form-group d-flex justify-content-left mt-2">
                                            <label for="">Cover Page &nbsp;</label>
                                            <ul class="cover-list" id="preview_cover_list">
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
                                </div>
                            </div>  
<?php
                                }
?>               
                            <div class="card-footer">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="system-frm">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function previewLogo(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("preview_logo").src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function previewCover(event) {
        var input = event.target;
        if (input.files && input.files.length > 0) {
            var previewCoverList = document.getElementById("preview_cover_list");
            previewCoverList.innerHTML = "";
            
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var coverImg = document.createElement("img");
                    coverImg.src = e.target.result;
                    coverImg.alt = input.files[i].name;
                    coverImg.classList.add("cover_logo_img");
                    
                    var li = document.createElement("li");
                    li.appendChild(coverImg);
                    
                    previewCoverList.appendChild(li);
                };
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
</script>

<?php include('includes/footer.php');?>
