@include('pages.header')
<div class="modal fade" id="manageUser" tabindex="-1" aria-labelledby="manageUserLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageUserLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="submitNewUser">
                    @csrf
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Trucker ID</label>
                        <input type="number" name="truckercode" id="truckercode"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Driver</label>
                        <select class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" name="driver_id"
                            id="driver_id">
                            @foreach ($driverData as $row)
                                <option value="{{ $row->driver_id }}">{{ $row->driver_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-gray-600 font-semibold">Truck Units</label>
                        <select class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" name="truck_id"
                            id="truck_id">
                            @foreach ($truckData as $row)
                                <option value="{{ $row->truck_id }}">{{ $row->truck_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Helper</label>
                        <input type="text" name="helper" id="helper"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
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
</div>
