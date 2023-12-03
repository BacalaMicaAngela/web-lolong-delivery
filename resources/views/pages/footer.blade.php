<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/datatables.min.js"></script>
<script src="js/main.js"></script>
<script src="js/jQuery.print.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
              "body").style.visibility = "hidden";
            document.querySelector(
              "#loader").style.visibility = "visible";
        } else {
            document.querySelector(
              "#loader").style.display = "none";
            document.querySelector(
              "body").style.visibility = "visible";
        }
    };

    $(document).on('click', '.btn-newFeedback', async function(e){
        let id = $(this).data('id');

        let response = await fetch(`a_showNewFeedback/${id}`, {
            method: 'GET',
            credentials: "same-origin",
        });

        let { message, status } = await response.json();

        if(status == 'success') {
            message.forEach(el => {
                const currentDate = new Date(el.created_at);
                const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };

                $('#showFeedBackEmail').text(el.feedback_email);
                $('#postedDate').text(currentDate.toLocaleDateString('en-us', options));
                $('#showFeedBackMsg').text(el.feedback_msg);
            });
            $('#newFeedbackModal').modal('show');
        } else {
            alert(message);
        }
    });
</script>
</body>
</html>
