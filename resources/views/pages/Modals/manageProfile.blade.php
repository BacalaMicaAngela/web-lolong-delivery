@include('pages.header')
<div class="modal fade" id="manageProfile" tabindex="-1" aria-labelledby="manageProfileLabel" aria-hidden="true" data-bs-backdrop="static"> 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Account Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="submitUpdateUser" enctype="multipart/form-data">
            @csrf
            <div class="w-full p-10 mt-2">
                <div class="relative mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                    <img id="avatar" class="w-full h-full rounded-full"
                        src="./img/user.png" />
                    <div id="camera"
                        class="cursor-pointer absolute bottom-0 h-10 w-full bg-white p-1 opacity-25 hover:opacity-75">
                        <img src="./img/camera.png" class="h-8 w-8 mx-auto" />
                    </div>
                </div>
                <input id="fileChooser" class="hidden" name="file" type="file" accept="image/*" />
            </div>

                <label for="text" class="block mb-1 text-gray-600 font-semibold">Full Name</label>
                <input type="text" name="u_name" value="{{ $data->u_name }}" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />

                <label for="text" class="block mb-1 text-gray-600 font-semibold">Username</label>
                <input type="text" name="username" value="{{ $data->username }}" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />

                <label for="text" class="block mb-1 text-gray-600 font-semibold">New Password</label>
                <input type="password" name="password" value="{{ old('password') }}" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />

                <label for="text" class="block mb-1 text-gray-600 font-semibold">Confirm Password</label>
                <input type="password" name="cpassword" value="{{ old('password') }}" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />

                <hr>
                <input type="hidden" name="user_id" value="{{ $data->user_id  }}"/>
                <button type="submit" 
                    class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Update Account</button>
            </form>
            </div>
        </div>
      </div>
    </div>

  <script>
      function UpdateUser() {
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
        this.submitUpdateUser = () => {
            submitUpdateUser.onsubmit = async(e) => {
                e.preventDefault();
                let response = await fetch("update-user", {
                    method: 'POST',
                    credentials: "same-origin",
                    body: new FormData(submitUpdateUser)
                });

                let { message, status } = await response.json();

                if(status == 'success') {
                    this.msg(
                        message,
                        status
                    );
                    submitUpdateUser.reset();
                    $('#manageProfile').modal('hide');
                } else {
                    this.msg(
                        message,
                        status
                    );
                }
            }
        }
    }

    let userObj = new UpdateUser();
    userObj.imgPicker();
    userObj.submitUpdateUser();
  </script>
