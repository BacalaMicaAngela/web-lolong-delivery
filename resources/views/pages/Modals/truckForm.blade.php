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
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Brand Name</label>
                        <input type="text" id="brandname" name="brandname"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div>
                        <label class="block mb-1 text-gray-600 font-semibold">Plate no.</label>
                        <input type="text" name="plateno" id="plateno"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Model</label>
                        <input type="text" name="model" id="modelVal"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div>
                    <!-- <div>
                        <label for="text" class="block mb-1 text-gray-600 font-semibold">Chassis No.</label>
                        <input type="text" name="chassisno" id="chassisno"
                            class="bg-indigo-50 px-2 py-2 outline-none rounded-md w-full" />
                    </div> -->
                    <hr>
                    <div class="flex">
                        <input type="hidden" name="id" id="id" />
                        <button type="submit"
                            class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>