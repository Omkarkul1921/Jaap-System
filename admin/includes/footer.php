</main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy;  Vidyanand Seva Mandal 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../../assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap core JavaScript-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../assets/js/sb-admin-2.min.js"></script>


<!-- Simple-DataTables plugin -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/datatables-simple-demo.js"></script>
</div>
        <script>
    // Function to filter records based on search input
    function filterRecords() {
        var input, filter, table, tr, td, i, txtValue, noRecordMsg;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("Table");
        tr = table.getElementsByTagName("tr");
        noRecordMsg = document.getElementById("noRecordMsg"); // Get the message element
        var found = false; // Flag to track if any record is found
        for (i = 0; i < tr.length; i++) {
            // Exclude table header rows (th tags)
            if (tr[i].getElementsByTagName("th").length > 0) {
                continue;
            }
            td = tr[i].getElementsByTagName("td");
            var rowDisplayed = false;
            for (var j = 0; j < td.length; j++) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rowDisplayed = true;
                    break; // If any cell in the row matches, break the inner loop
                }
            }
            if (rowDisplayed) {
                tr[i].style.display = "";
                found = true; // Set the flag to true if at least one record is found
            } else {
                tr[i].style.display = "none";
            }
        }
        // Show/hide the message based on the flag
        if (found) {
            noRecordMsg.style.display = "none"; // Hide the message
        } else {
            noRecordMsg.style.display = "block"; // Show the message
        }
    }

    // Add event listener for input event on search input field
    document.getElementById("searchInput").addEventListener("input", function() {
        filterRecords(); // Call filterRecords function when input event occurs
    });

    // Reset all records to default when 'x' mark in search box is clicked
    document.getElementById("searchInput").addEventListener("search", function() {
        if (!this.value) {
            var table = document.getElementById("memberTable");
            var tr = table.getElementsByTagName("tr");
            for (var i = 0; i < tr.length; i++) {
                tr[i].style.display = "";
            }
            var noRecordMsg = document.getElementById("noRecordMsg");
            noRecordMsg.style.display = "none"; // Hide the message
        }
    });
</script>



    </body>
</html>