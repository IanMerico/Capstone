    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    
    

      <!-- Alertfy JavaScript -->
    
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="assets/js/jquery.exzoom.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
         <!-- Replace "test" with your own sandbox Business account app client ID -->
         <script src="https://www.paypal.com/sdk/js?client-id=AZVVBSSlCFeDabXj8DqGAjR5JllR3K4k9OST6wIXRf1FdbNkzwWM9MS8UeWkMV2eWj0f5mLj7LcgqjrG&currency=PHP"></script>
    



    <script>
        $(document).ready(function () {
                $('#datatableid').DataTable();
        });
    </script>

    <script>
      alertify.set('notifier','position', 'top-center');
<?php 
        if(isset($_SESSION['message'])) { 
?> 
        
        alertify.success('<?= $_SESSION['message']; ?>');

<?php   
        unset($_SESSION['message']);
        } 
?>
    </script>
    <!-- <script defer src="assets/js/validation.js"></script> -->
        <script>
                function myFunction() {
                var x = document.getElementById("exampleInputPassword1");
                if (x.type === "password") {
                x.type = "text";
                } else {
                x.type = "password";
                }
                 }


        </script>
<script>
$(function(){

        $("#exzoom").exzoom({
                // options here
                // thumbnail nav options
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                // autoplay
                "autoPlay": false
        });

});
</script>
<script>
function fetchData() {
  var searchQuery = document.getElementById("searchInput").value;
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "functions/fetchData.php?search=" + searchQuery, true);
  xhr.onload = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("searchResults").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}
</script>



  </body>
</html>