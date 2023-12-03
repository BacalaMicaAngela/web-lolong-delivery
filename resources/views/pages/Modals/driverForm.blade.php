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
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Driver Name</label>
                        <input type="text" id="name" name="name" class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div>
                        <label class="block mb-1 text-gray-600 font-semibold">Age</label>
                        <input type="number" name="age" id="age"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Address</label>
                            <textarea class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" name="address" id="address" cols="30" rows="3"></textarea>
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Mobile</label>
                        <input type="number" name="mobile" id="mobile"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">License No.</label>
                        <input type="text" name="licenseno" id="licenseno"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <hr>
                    <div class="flex">
                        <input type="hidden" name="driver_id" id="driver_id" />
                        <button type="submit"
                            class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
