@extends('pages.navigator')
@section('contentAdmin')

<style>
    .schedule-label {
        font-size: 20px; /* Adjust the size as needed */
        font-weight: bold; /* Make the text bold */
    }

    .module-description {
        font-size: 12px; /* Adjust the size as needed */
        color: #6B7280; /* Set the color to a muted tone */
    }
</style>

<div class="container-fluid p-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <span class="schedule-label">TRASHED USERS</span>
                    <p class="module-description">Restore Users</p>

            </div>
            <div class="card-body">
                <div style="overflow: auto;">
                    <table id="dataTable" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deletedUsers as $user)
                                <tr>
                                    <td><p class="mt-3">{{ $user->u_name }}</p></td>
                                    <td><p class="mt-3">{{ $user->deleted_at }}</p></td>
                                    <td>
                                        <center class="mt-3">
                                        <button data-id="{{ $user->user_id }}" class="btn-sm btn btn-outline-success restoreBtn w-1/2"><i class="fa-solid fa-rotate-left mr-2"></i>Restore</button>
                                        </center>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
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

                this.imgPicker = () => {
                    camera.onclick = (e) => {
                        document.querySelector('#fileChooser').click();
                    }

                    fileChooser.onchange = (e) => {
                        if (e.target.files && e.target.files[0]) {
                            document.querySelector('#avatar').src = URL.createObjectURL(event.target.files[0]);
                        }
                    }
                }

                this.imgPicker = () => {
                    cameraNewUser.onclick = (e) => {
                        document.querySelector('#fileNewUserChooser').click();
                    }

                    fileNewUserChooser.onchange = (e) => {
                        if (e.target.files && e.target.files[0]) {
                            document.querySelector('#avatarNewUser').src = URL.createObjectURL(event.target.files[0]);
                        }
                    }
                }

                this.checkInput = () => {
                    return true;
                }
            }

$(document).on('click', '.restoreBtn', async function (e) {
    let id = $(this).data('id');
    restoreUser(id);});

    const restoreUser = async (id) => {
        console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: 'Restore user from Recycle Bin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Restore'
    }).then(async (result) => {
        if (result.isConfirmed) {
            let comp = new Component();
            let response = await fetch(`restoreUser/${id}`, {
                method: 'GET',
                credentials: "same-origin"
            });

            let { message, status } = await response.json();

            console.log(message, status)

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
                    'error'
                );
            }
        }
    });

}
</script>
@endsection
@include('pages.Modals.manageProfile')