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
                    <span class="schedule-label">MANAGE USERS</span>
                    <p class="module-description">Use this module to view manage users...</p>

                </div>
                    <div class="col d-flex flex-row-reverse">
                            <section class="p-2">
                            <button type="button" class="btn-sm btn btn-outline-danger w-full removeBtnCheck">
                                <i class="fa-solid fa-trash mr-1"></i>Remove From List</button>
                                 </section>
                            
                            <div class="dropdown-divider"></div>
                            <section class="p-2">
                            <button type="button" class="btn-sm btn btn-outline-primary addBtn w-full">
                                <i class="fa-solid fa-plus mr-1"></i>New User</button>
                        </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="overflow: auto;">
                    <table id="dataTable" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>
                                    <center>
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                        <label class="form-check-label">
                                            Select All
                                        </label>
                                    </center>
                                </th>
                                <th>Avatar</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userDatas as $userData)
                                <tr>
                                    <td>
                                        <center class="mt-3"><input class="form-check-input checkbox" type="checkbox" value="{{ $userData->user_id }}"></center>
                                    </td>
                                    <td><center><img src="./uploads/{{ $userData->user_avatar }}" class="rounded-full w-16 h-16 border-2 border-gray-500" alt="avatar">
                                    </center></td>
                                    <td><p class="mt-3">{{ $userData->u_name }}</p></td>
                                    <td><p class="mt-3">{{ $userData->username }}</p></td>
                                    <td>
                                        <center class="mt-3">
                                            @if ($userData->status==0)
                                            <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center class="mt-3">
                                            @if ($userData->status==1)
                                                <button class="btn-sm btn btn-outline-primary restoreBtn " data-id="{{ $userData->user_id }}"> <i class="fa-solid fa-recycle mr-2"></i>Restored Status</button>
                                            @else
                                                <div class="dropdown">
                                                    <button class="btn-sm btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="p-2">
                                                            <button data-id="{{ $userData->user_id }}" class="btn-sm btn btn-outline-success editBtn w-full"><i class="fa-solid fa-pen mr-2"></i>Edit</button>
                                                        </li>
                                                        <li class="p-2">
                                                            <button class="btn-sm btn btn-outline-danger removeBtn w-full" data-id="{{ $userData->user_id }}"> Switch Status</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </center>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('pages.Modals.adminUsers')
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
                    if($('#u_name').val() == ''
                    || $('#username').val() == ''
                    || $('#userType').val() == ''
                    || $('#password').val() == ''
                    ) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }

            $(document).on('click', '.addBtn', function(e){
                let comp = new Component();
                comp.imgPicker();
                $("#avatarNewUser").attr("src", `./img/user.png`);
                $('#submitNewUser')[0].reset();
                $('#manageUser').modal('show');
                $('#manageUserLabel').html('New User Form');
            });

            $(document).on('submit', '#submitNewUser', async function(e){
            e.preventDefault();

                let comp = new Component();

                if(!comp.checkInput()
                ) {
                    comp.msg(
                        'Warning: Fill up all the required fields.',
                        'warning'
                    );
                    return;
                }

                let response = await fetch("{{ route('a_newUser') }}", {
                    method: 'POST',
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value
                    },
                    body: new FormData(document.querySelector('#submitNewUser'))
                });

                let { message, status } = await response.json();

                if(status == 'success') {
                    comp.msg(
                        message,
                        status
                    );
                    $('#manageUser').modal('hide');
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

            $('#selectAll').click(function (event) {
                if (this.checked) {
                    $('.checkbox').each(function () {
                        $(this).prop('checked', true);
                    });
                } else {
                    $('.checkbox').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            });

            $(document).on('click', '.editBtn', function(e){
                let comp = new Component();
                comp.imgPicker()
                const showUser = async(id) => {
                    let response = await fetch(`a_showUser/${id}`, {
                    method: 'GET',
                    credentials: "same-origin",
                });

                let { message, status } = await response.json();

                    if(status == 'success') {
                        message.forEach(el => {
                            $('#u_name').val(el.u_name);
                            $('#username').val(el.username);
                            $('#user_id').val(el.user_id);
                            $("#avatarNewUser").attr("src", `./uploads/${el.user_avatar}`);
                            $('#manageUser').modal('show');
                            $('#manageUserLabel').html('Update User Form');
                        });
                    } else {
                        comp.msg(
                            message,
                            'error'
                        );
                    }
                }
                showUser($(this).data('id'));
            });

            $(document).on('click', '.removeBtnCheck', async function(e){
                e.preventDefault();
                Swal.fire({
                    text: 'Are you sure?',
                    text: "Do you want to remove",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Remove'
                    }).then( async(result) => {
                    if (result.isConfirmed) {
                        let comp     = new Component();
                        let data     = $('input:checkbox:checked');
                        let formData = new FormData();
                        data.map((i, el) =>
                            formData.append(i, el.value)
                        );
                        let response = await fetch("destroyUser", {
                            method: 'POST',
                            credentials: "same-origin",
                            headers: {
                                "X-CSRF-Token": document.querySelector('input[name=_token]').value
                            },
                            body: formData
                        });

                        let { message, status } = await response.json();

                        if(status == 'success') {
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
                    }
                });
            });

            $(document).on('click', '.restoreBtn', async function (e) {
    let id = $(this).data('id');
    restoreUser(id);
});

const restoreUser = async (id) => {
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


            $(document).on('click', '.removeBtn', async function(e) {
                let id=$(this).data('id');
                approveType(
                    id,
                    '1'
                );
            });

            $(document).on('click', '.restoreBtn', async function(e) {
                let id=$(this).data('id');
                approveType(
                    id,
                    '0'
                );
            });

            const approveType = async(id, type) => {
                let msg = type == '0' ? 'active' : 'inactive';

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Switch User Status to ${msg}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Proceed'
                }).then( async (result) => {
                    if (result.isConfirmed) {
                        let comp = new Component();
                        let response = await fetch(`actionUser/${id}/${type}`, {
                            method: 'GET',
                            credentials: "same-origin"
                        });

                        let { message, status } = await response.json();

                        if(status == 'success') {
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
                })
            }
        </script>
    </div>
@endsection
@include('pages.Modals.manageProfile')
