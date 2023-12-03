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
            <div class="w-full p-10 mt-2">
                <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                    <img id="avatarNewUser" class="w-full h-full rounded-full"
                        src="./img/user.png" />
                    <div id="cameraNewUser"
                        class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                        <img src="./img/camera.png" class="h-8 w-8 mx-auto" />
                    </div>
                </div>
                <input id="fileNewUserChooser" class="hidden" name="file" type="file" accept="image/*" />
            </div>
            <div>
                <label for="text" class="block mb-1 text-gray-600 font-semibold">ID No.</label>
                <input type="text" name="user_id" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />
            </div>
            
            <div>
                <label for="text" class="block mb-1 text-gray-600 font-semibold">Full Name</label>
                <input type="text" name="u_name" id="u_name" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />
            </div>
            <div>
                <label for="text" class="block mb-1 text-gray-600 font-semibold">Username</label>
                <input type="text" name="username" id="username" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />
            </div>
            <div>
                <label for="text" class="block mb-1 text-gray-600 font-semibold">Password</label>
                <input type="text" name="password" id="password" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />
            </div>
            <input type="hidden" name="userType" value="1">
            <hr>
            <div class="flex">
                <input type="hidden" name="user_id" id="user_id"/>
                <button type="submit" 
                     class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">SUBMIT</button>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>
