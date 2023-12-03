@include('pages.header')


<div class="modal fade" id="manageUser" tabindex="-1" aria-labelledby="manageUserLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageUserLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="submitNewUser" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Upload Proof Receipt</label>
                        <input type="file" name="file" id="file" class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" required />
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Driver name</label>
                        <select class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full select2" name="driver" id="driver_id">
                            @foreach ($driverData as $row)
                            <option value="{{ $row->driver_id }}"> {{ $row->driver_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-gray-600 font-semibold">Truck Unit</label>
                        <select class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full select2" name="truck" id="truck_id">
                            @foreach ($truckData as $row)
                            <option value="{{ $row->truck_id }}"> {{ $row->truck_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="status-hide">
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Source Type</label>
                        <select class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" name="outsourced" id="outsourced">
                            <option disabled>-Select Source Type-</option>
                            <option value="0">
                                <p class="text-primary text-center">Out Source Trucks</p>
                            </option>
                            <option value="1">
                                <p class="text-warning text-center">Owned Trucks</p>
                            </option>
                        </select>
                    </div>
                    <hr>
                    <div class="flex">
                        <input type="hidden" name="id" id="id" />
                        <button type="submit" class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- preview --}}
<div class="modal fade" id="previewImageModal" tabindex="-1" aria-labelledby="previewImageModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewImageModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="previewImage"></div>
                <hr>
                <div class="flex">
                    <button class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900 downloadBtn"><i class="fa fa-download mr-2"></i> Download</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Select2 for driver and truck unit selects
    $('.select2').select2();
</script>
