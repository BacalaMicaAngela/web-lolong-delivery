<div class="tab-pane fade show active" id="nav-backup" role="tabpanel" aria-labelledby="nav-backup-tab">
    <div style="overflow: auto;">
        <table class="table table-bordered">
            <tr>
                <th>Table Name</th>
                <th class="text-center">Backup</th>
            </tr>
            @for ($i = 0; $i < count($tablesList); $i++)
                <tr>
                    <td>Table_{{ $tablesList[$i]['Tables_in_db_lts'] }}</td>
                    <td>
                        <center>
                            <button type="button" class="btn btn-outline-secondary btn-sm backupBtn"
                                data-id="{{ $tablesList[$i]['Tables_in_db_lts'] }}"><i
                                    class="fa-solid fa-database mr-2"></i>Backup</button>
                        </center>
                    </td>
                </tr>
            @endfor
        </table>
    </div>
</div>
<script>
    function Component() {
        this.msg = (msg, icon) => {
            Swal.fire({
                position: 'center',
                icon: icon,
                text: msg,
                showConfirmButton: false,
                timer: 2000
            });
        }
    }

    $(document).on('click', '.backupBtn', async function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to backup choose database table",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Backup'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let comp = new Component();

                let response = await fetch(`backupDatabase/${$(this).data('id')}`, {
                    method: 'GET',
                    credentials: "same-origin",
                });

                let {
                    message,
                    filename,
                    dataFile,
                    status
                } = await response.json();

                if (status == 'success') {
                    var zip = new JSZip();
                    zip.add(filename, dataFile);
                    content = zip.generate();
                    location.href = "data:application/zip;base64," + content;
                    comp.msg(
                        message,
                        status
                    );
                } else {
                    comp.msg(
                        message,
                        status
                    );
                }
            }
        });
    });
</script>
