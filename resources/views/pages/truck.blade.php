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
                    <span class="schedule-label">TRUCK UNITS</span>
                    <p class="module-description">Use this module to view your Truck Units...</p>
                </div>
                <div class="col d-flex flex-row-reverse">
                            <section class="p-2">
                            <button type="button" class="btn-sm btn btn-outline-danger w-full removeBtn"><i
                                        class="fa-solid fa-trash mr-1"></i>Remove From List</button>
                            </section>
                            <div class="dropdown-divider"></div>
                            <section class="p-2">
                            <button type="button" class="btn-sm btn btn-outline-primary addBtn w-full"><i
                                        class="fa-solid fa-plus mr-1"></i>New Trucks</button>
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
                                <th>Brand Name</th>
                                <th>Plate no.</th>
                                <th>model</th>
                                <!-- <th>Chassis No.</th> -->
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fetch as $fetchData)
                                <tr>
                                    <td>
                                        <center class="mt-3"><input class="form-check-input checkbox" type="checkbox"
                                                value="{{ $fetchData->truck_id }}"></center>
                                    </td>
                                    <td>
                                        <p class="mt-3">{{ $fetchData->truck_name }}</p>
                                    </td>
                                    <td>
                                        <p class="mt-3">{{ $fetchData->truck_plateno }}</p>
                                    </td>
                                    <td>
                                        <p class="mt-3">{{ $fetchData->model }}</p>
                                    </td>
                                    <!-- <td>
                                        <p class="mt-3">{{ $fetchData->chasisno }}</p>
                                    </td> -->
                                    <td>
                                        <p class="mt-3">{{ date('Y-m-d', strtotime($fetchData->created_at)) }}</p>
                                    </td>
                                    <td>
                                        <center class="mt-3">

                                            <div class="dropdown">
                                                <button class="btn-sm btn btn-outline-secondary dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="p-2">
                                                        <button data-id="{{ $fetchData->truck_id }}"
                                                            class="btn-sm btn btn-outline-success editBtn w-full"><i
                                                                class="fa-solid fa-pen mr-2"></i>Edit</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('pages.Modals.truckForm')
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

                this.checkInput = () => {
                    if ($('#brandname').val() == '' ||
                        $('#plateno').val() == '' ||
                        $('#modelVal').val() == '' ||
                        $('#chassisno').val() == '' 
                    ) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }

            $(document).on('click', '.addBtn', function(e) {
                $('#submitNewUser')[0].reset();
                $('#manageUserLabel').html('New Data Form');
                $('#manageUser').modal('show');
            });

            $(document).on('submit', '#submitNewUser', async function(e) {
                e.preventDefault();

                let comp = new Component();

                if (!comp.checkInput()) {
                    comp.msg(
                        'Warning: Fill up all the required fields.',
                        'warning'
                    );
                    return;
                }

                let response = await fetch("{{ route('manageTruck') }}", {
                    method: 'POST',
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value
                    },
                    body: new FormData(document.querySelector('#submitNewUser'))
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
                    $('#manageUser').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    console.error(message);
                }
            });

            $('#selectAll').click(function(event) {
                if (this.checked) {
                    $('.checkbox').each(function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $('.checkbox').each(function() {
                        $(this).prop('checked', false);
                    });
                }
            });

            $(document).on('click', '.editBtn', function(e) {
                const showUser = async (id) => {
                    let response = await fetch(`showTruck/${id}`, {
                        method: 'GET',
                        credentials: "same-origin",
                    });

                    let {
                        message,
                        status
                    } = await response.json();

                    if (status == 'success') {
                        message.map(el => {
                            console.log(el);
                            $('#id').val(el.truck_id)
                            $('#brandname').val(el.truck_name)
                            $('#plateno').val(el.truck_plateno)
                            $('#modelVal').val(el.model)
                            $('#chassisno').val(el.chasisno)

                            $('#manageUser').modal('show');
                            $('#manageUserLabel').html('Update Data Form');
                        });
                    } else {
                        console.error(message);
                    }
                }
                showUser($(this).data('id'));
            });

            $(document).on('click', '.removeBtn', async function(e) {
                e.preventDefault();
                Swal.fire({
                    text: 'Are you sure?',
                    text: "Do you want to remove",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',  
                    confirmButtonText: 'Remove'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let comp = new Component();
                        let data = $('input:checkbox:checked');
                        let formData = new FormData();
                        data.map((i, el) =>
                            formData.append(i, el.value)
                        );
                        let response = await fetch("{{ route('destroyTruck') }}", {
                            method: 'POST',
                            credentials: "same-origin",
                            headers: {
                                "X-CSRF-Token": document.querySelector('input[name=_token]')
                                    .value
                            },
                            body: formData
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
                        } else if (status == 'warning') {
                            comp.msg(
                                message,
                                status
                            );
                        } else {
                            console.error(message);
                        }
                    }
                });
            });
        </script>
    </div>
@endsection
@include('pages.Modals.manageProfile')
