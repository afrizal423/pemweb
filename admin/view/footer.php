 <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START FOOTER -->
    <footer class="page-footer gradient-45deg-light-blue-cyan">
        <div class="footer-copyright">
          <div class="container">
            <span>Copyright ©
              <script type="text/javascript">
                document.write(new Date().getFullYear());
              </script> <a class="grey-text text-lighten-2" href="http://github.com/afrizal423" target="_blank">Kelompok PemWeb</a></span>
            <span class="right hide-on-small-only">  Special Thanks to <a class="grey-text text-lighten-2" href="https://pixinvent.com/" target="_blank">PIXINVENT</a></span>
          </div>
        </div>
    </footer>
    <!-- END FOOTER -->
    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="../assets/vendors/jquery-3.2.1.min.js"></script>
    <script>
    // //$(document).ready(function(){
    // var keyword = document.getElementById('cari');
    // keyword.addEventListener('keyup', function() {
    //         // $.ajax({
    //         //     url:"cari-live.php",
    //         //     method:"post",
    //         //     data:{ search:$(this).val() },
    //         //     //dataType:"text",
    //         //     cache: false,
    //         //     success:function(data)
    //         //     {
    //         //         $('#result').html(data);
    //         //     }
    //         // });
    //         alert('ok');
       
    // });
//});
$(document).ready(function(){
    $('#cari').keyup(function(){
        var txt = $(this).val();
        var id = "<?php echo $data3->id_detail; ?>";
        if (txt != '') {
            $('#result').html('');
            $.ajax({
                url:"cari-live.php",
                method:"post",
                data:{ search:txt, iddetail:id },
                dataType:"text",
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        } else {
          $('#result').html('');
          //  $('#result').html('');
          //   $.ajax({
          //       url:"cari-live.php",
          //       method:"post",
          //       data:{ search:txt },
          //       dataType:"text",
          //       success:function(data)
          //       {
          //           $('#result').html(data);
          //       }
          //   });
        }
    });
});
</script>
    <!--materialize js-->
    <script type="text/javascript" src="../assets/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="../assets/js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="../assets/js/custom-script.js"></script>

    <script>
     $(document).ready(function(){
    $('.modal').modal();
  });
    </script>
  </body>
</html>