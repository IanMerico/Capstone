            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
<?php
                        $year = date("Y");
?>
                        <span>Copyright &copy; Your Website <?= $year ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
  <!-- </main> -->


  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/perfect-scrollbar.min.js"></script>
  <script src="tinymce/tinymce.min.js"></script>

  <!-- Text Area -->
  <script src="assets/js/smooth-scrollbar.min.js"></script>
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="assets/js/custom.js"></script>
  <!-- Alertfy JavaScript -->
  <?php include('includes/script.php');?>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
<?php 
        if(isset($_SESSION['message'])) { 
?> 
        alertify.set('notifier','position', 'top-right');
        alertify.success('<?= $_SESSION['message']; ?>');

<?php   
        unset($_SESSION['message']);
        } 
?>




    </script>


   

</body>
</html>