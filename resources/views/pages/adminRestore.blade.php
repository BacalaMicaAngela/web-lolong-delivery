<div class="tab-pane fade" id="nav-restore" role="tabpanel" aria-labelledby="nav-restore-tab">
    <div class="flex justify-center mt-8">
        <div class="max-w-2xl rounded-lg shadow-xl bg-gray-50 w-full">
            <div class="m-4">
                <form id="restoreForm" enctype="multipart/form-data">
                    <label class="inline-block mb-2 text-gray-500">Database File Restore</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col w-full h-32 border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <i
                                    class="fa-solid fa-database w-8 h-8 text-gray-400 group-hover:text-gray-600 text-3xl"></i>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Attach a Database File</p>
                            </div>
                            <input type="file" name="file" class="opacity-0" id="pickerFile" accept="sql/*" />
                        </label>
                    </div>
            </div>
            <div class="flex justify-center p-2">
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded shadow-xl"><i
                        class="fa-solid fa-recycle mr-2"></i>Restore</button>
                </form>
            </div>
        </div>
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

        this.loadUpload = () => {
            pickerFile.onchange = (e) => {
                if (e.target.files && e.target.files[0]) {
                    alert('');
                }
            }
        }
    }

    $(document).on('submit', '#restoreForm', async function(e) {
        e.preventDefault();

        let comp = new Component();

        if ($('#pickerFile').val() == '') {
            comp.msg(
                'Warning: Empty Upload File!',
                'warning'
            );
            return;
        }

        let response = await fetch("{{ route('restoreDatabase') }}", {
            method: 'POST',
            credentials: "same-origin",
            headers: {
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body: new FormData(document.querySelector('#restoreForm'))
        });

        let {
            message,
            status
        } = await response.json();

        if (status == 'success') {
            comp.msg(
                message,
                status
            );
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            comp.msg(
                message,
                status
            );
        }
    });
</script>
