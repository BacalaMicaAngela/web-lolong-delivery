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
                    <span class="schedule-label">SCHEDULE MANAGEMENT</span>
                    <p class="module-description">Use this module to view schedule management...</p>
                </div>
                    <div class="col d-flex flex-row-reverse">
                            <section class="p-2">
                            <button type="button" class="btn-sm btn btn-outline-danger w-full removeBtn"><i
                                        class="fa-solid fa-trash mr-1"></i>Remove</button>
                            </section>
                            <div class="dropdown-divider"></div>
                            <section class="p-2">
                            <button type="button" class="btn-sm btn btn-outline-primary addBtn w-full"><i
                                        class="fa-solid fa-plus mr-1"></i>New Schedule</button>
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
                                <th>Business Name</th>
                                <th>Delivery Address</th>
                                <th>Contact Perosn</th>
                                <th>Contact No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fetch as $fetchData)
                                <tr>
                                    <td>
                                        <center class="mt-3"><input class="form-check-input checkbox" type="checkbox"
                                                value="{{ $fetchData->schedule_id }}"></center>
                                    </td>
                                    <td>
                                        <p class="mt-3">{{ $fetchData->bussiness_name }}</p>
                                    </td>
                                    <td>
                                        <p class="mt-3">{{ $fetchData->delivery_address }}</p>
                                    </td>
                                    <td>
                                        <p class="mt-3">{{ $fetchData->contact_person }}</p>
                                    </td>
                                    <td>
                                        <p class="mt-3">{{ $fetchData->contactno }}</p>
                                    </td>
                                    <td>
                                        <p class="mt-3">
                                            @switch($fetchData->deliver_status)
                                            @case(0)
                                                <p class="text-primary text-center">Yet to start</p>
                                            @break

                                            @case(1)
                                                <p class="text-warning text-center">Ongoing</p>
                                            @break

                                            @case(2)
                                                <p class="text-success text-center">Completed</p>
                                            @break

                                            @case(3)
                                                <p class="text-danger text-center">Cancelled</p>
                                            @break
                                        @endswitch
                                        </p>
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
                                                        <button data-id="{{ $fetchData->schedule_id }}"
                                                            class="btn-sm btn btn-outline-success editBtn w-full"><i
                                                                class="fa-solid fa-pen mr-2"></i>Edit</button>
                                                    </li>
                                                    <li class="p-2">
                                                        <button data-id="{{ $fetchData->schedule_id }}"
                                                            class="btn-sm btn btn-outline-primary viewBtn w-full"><i
                                                                class="fa-solid fa-eye mr-2"></i>View</button>
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
        @include('pages.Modals.scheduleForm')
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

            $(document).on('click', '.viewBtn', function(e) {

                const showUser = async (id) => {
                    let response = await fetch(`viewSched/${id}`, {
                        method: 'GET',
                        credentials: "same-origin",
                    });

                    let {
                        message,
                        status
                    } = await response.json();


                    if (status == 200) {

                        let plateno;

                        message.deliver.map(el => {
                            plateno = el.truck_plateno;
                            let tbody1 = `<tr>
                                <th>Trucker Name:</th>
                                <td colspan="3">${el.truck_name}</td>
                            </tr>
                            <tr>
                                <th>Trucker ID:</th>
                                <td colspan="1">${el.trucker_code}</td>
                                <th>Plate No:</th>
                                <td colspan="1">${el.truck_plateno}</td>
                            </tr>
                            <tr>
                                <th>
                                    Driver:</th>
                                <td colspan="1">${el.driver_name}</td>
                                <th>Helper:</th>
                                <td colspan="1">${el.helper}</td>
                            </tr>`;

                            $('#tbody1').html(tbody1);
                        });

                        message.sched.map(el => {
                            var date1 = new Date(el.delivery_date).toDateString(),
                                date2 = new Date(el.delivery_date).toLocaleTimeString(),
                                tbody2 = ` <tr>
                                <th>Business Name:</th>
                                <td colspan="3">${el.bussiness_name }</td>
                            </tr>
                            <tr>
                                <th>Delivery<br>Address:</th>
                                <td colspan="1">${el.delivery_address}</td>
                                <th>Plate No:</th>
                                <td colspan="1">${plateno}</td>
                            </tr>
                            <tr>
                                <th>Contact Person:</th>
                                <td colspan="1">${el.contact_person}</td>
                                <th>Helper:</th>
                                <td colspan="1">${el.helper}</td>
                            </tr>
                            <tr>
                                <th>Delivery Date:</th>
                                <td colspan="1">${ date1 }</td>
                                <th>Delivery Time:</th>
                                <td colspan="1">${ date2 }</td>
                            </tr>`,
                                date3 = new Date(el.dispatch_date).toDateString(),
                                date4 = new Date(el.dispatch_date).toLocaleTimeString(),
                                tbody3 = `<tr>
                                <th>Dispatch By:</th>
                                <td colspan="3">${el.dispatch_by}</td>
                            </tr>
                            <tr>
                                <th>Dispatch Date:</th>
                                <td>${date3}</td>
                                <th>Dispatch Time:</th>
                                <td>${date4}</td>
                            </tr>`,
                                date5 = new Date(el.recieve_date).toDateString(),
                                date6 = new Date(el.recieve_date).toLocaleTimeString(),
                                tbody4 = `<tr>
                                <th>Recieve By:</th>
                                <td colspan="3">${el.recieve_by}</td>
                            </tr>
                            <tr>
                                <th>Recieve Date:</th>
                                <td>${date5}</td>
                                <th>Recieve Time:</th>
                                <td>${date6}</td>
                            </tr>`;

                            $('#hasno').html(el.hasno.toUpperCase());
                            $('#tbody2').html(tbody2);
                            $('#tbody3').html(tbody3);
                            $('#tbody4').html(tbody4);
                        });

                        $('#manageSchedLabel').html('View Form');
                        $('#manageSched').modal('show');

                    } else {
                        let comp = new Component();
                        comp.msg(
                            message,
                            status
                        );
                    }
                }

                return showUser($(this).data('id'));
            });

            $(document).on('click', '.addBtn', function(e) {
                $('#submitNewUser')[0].reset();
                $('#status-hide').hide();
                $('#manageUserLabel').html('New Data Form');
                $('#manageUser').modal('show');
            });

            $(document).on('submit', '#submitNewUser', async function(e) {
                e.preventDefault();

                let comp = new Component(),
                response = await fetch("{{ route('manageSchedule') }}", {
                    method: 'POST',
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value
                    },
                    body: new FormData(document.querySelector('#submitNewUser'))
                }),
                {
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
                }  else if (status == 'warning') {
                    comp.msg(
                        message,
                        status
                    );
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
                    let response = await fetch(`showSchedule/${id}`, {
                        method: 'GET',
                        credentials: "same-origin",
                    });

                    let {
                        message,
                        status
                    } = await response.json();

                    if (status == 'success') { 
                        message.sched.map(el => {
                           
                            $('#baname').val(el.bussiness_name)
                            $('#cperson').val(el.contact_person)
                            $('#contactno').val(el.contactno)
                            $('#deliver_id').val(el.deliver_id)
                            $('#daddress').html(el.delivery_address)
                            $('#deleliveryDate').val(el.delivery_date)
                            $('#dispatchby').val(el.dispatch_by)
                            $('#dispatchdate').val(el.dispatch_date)
                            $('#reciveby').val(el.recieve_by)
                            $('#recivedate').val(el.recieve_date)
                            $('#id').val(el.schedule_id)
                            
                            $('#status-hide').show();
                            $('#deliver_id').attr('disabled', true); 
                            $('#deliver_id').css({backgroundColor: '#fff'})
                            $('#manageUser').modal('show');
                            $('#manageUserLabel').html('Update Data Form');
                        });

                        message.deliver.map(el => {
                            $('#status').val(el.deliver_status);
                            $('#status_id').val(el.deliver_id);
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
                        let response = await fetch("{{ route('destroySchedule') }}", {
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
