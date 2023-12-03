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
                        <select class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" name="deliver_id"
                            id="deliver_id">
                            <option disabled>--Select Trucker ID--</option>
                            @foreach (isset($deliverData) ? $deliverData : [] as $row)
                                <option value="{{ $row->deliver_id }}">--{{ $row->trucker_code }}--</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Business Name</label>
                        <input required type="text" id="baname" name="baname"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Delivery Address</label>
                        <textarea id="daddress" name="daddress" cols="30" rows="5"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full"></textarea>
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Contact Person</label>
                        <input required type="text" id="cperson" name="cperson"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Contact No.</label>
                        <input required type="number" id="contactno" name="contactno"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Delivery Date &
                            Time</label>
                        <input required type="datetime-local" id="deleliveryDate" name="deleliveryDate"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Dispatch By</label>
                        <input required type="text" id="dispatchby" name="dispatchby"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Dispatch Date &
                            Time</label>
                        <input required type="datetime-local" id="dispatchdate" name="dispatchdate"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Recieve By</label>
                        <input required type="text" id="reciveby" name="reciveby"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>

                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Recieve Date & Time</label>
                        <input required type="datetime-local" id="recivedate" name="recivedate"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div id="status-hide">
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Status</label>
                        <select class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" name="status"
                            id="status">
                            <option disabled>--Select Status--</option>
                            <option value="0">
                                <p class="text-primary text-center">Yet to start</p>
                            </option>
                            <option value="1">
                                <p class="text-warning text-center">Ongoing</p>
                            </option>
                            <option value="2">
                                <p class="text-success text-center">Completed</p>
                            </option>
                            <option value="3">
                                <p class="text-danger text-center">Cancelled</p>
                            </option>
                        </select>
                    </div>
                    <hr>
                    <div class="flex">
                        <input required type="hidden" name="id" id="id" />
                        <input required type="hidden" name="status_id" id="status_id" />
                        <button type="submit"
                            class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



{{-- =======view============ --}}
<div class="modal fade" id="manageSched" tabindex="-1" aria-labelledby="manageSchedLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageSchedLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printReciept">
                <h4><strong>Has No: </strong><span id="hasno"></span></h4>
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-indigo-50">
                                <th colspan="4">TRUCKER INFORMATION</th>
                            </tr>
                        </thead>
                        <tbody id="tbody1"></tbody>
                    </table>


                    <table class="table table-bordered">
                        <tr class="bg-indigo-50">
                            <th colspan="4">DELIVERY TO</th>
                        </tr>
                        <tbody id="tbody2"></tbody>
                    </table>

                    <table class="table table-bordered">
                        <tr class="bg-indigo-50">
                            <th colspan="4">DISPATCH INFORMATION</th>
                        </tr>
                        <tbody id="tbody3"></tbody>
                    </table>

                    <table class="table table-bordered">
                        <tr class="bg-indigo-50">
                            <th colspan="4">DELIVERY AKNOWLEDGEMENT</th>
                        </tr>
                        <tbody id="tbody4"></tbody>
                    </table>
                </div>
                <hr>
                <button type="BUTTON"
                    class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900 print-link no-print"
                    onclick="jQuery('#printReciept').print()"> <i class="fa fa-print mr-2"></i> PRINT</button>
            </div>
        </div>
    </div>
</div>
</div>
