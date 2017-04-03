
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.jcarousel.min.js"></script>
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/jquery.cookie.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/jquery.nicescroll.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="assets/js/jquery.textresizer.min.js"></script>



 <script type="text/javascript">
    $(document).ready(function () {
        $('button').click(function () {
            var rno = $(this).val();
            $.ajax({
                type: "POST",
                url: "deleteUser.php",
                data: {id: rno},
                success: function (response) {
                    $('#row' + rno).fadeOut('slow');
                }
            }).done(function (result) {
                $("#msg").html("<div class='alert alert-info' role='alert'><h3 class='text-center'>Item at line number " + rno + " deleted </h3></div>");
            });
        });
    });
</script>

    </body>
</html>
