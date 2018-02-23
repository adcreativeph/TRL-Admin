</div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
    <script src="js/jquery.validate.min.js"></script>
	<!-- <script src="data/morris-data.js"></script> -->
	<script src="vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="js/withdraw.js"></script>
	<script>
    $('.tooltip').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    $("[data-toggle=popover]")
        .popover()
    </script>
	
	<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
    </script>

</body>
</html>