@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
             <h6>Testimonials table</h6>
            </div>
            <div class="p-2 bd-highlight">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fa fa-plus-circle"></i> Create
              </button>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Position</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($testimonials as $item)
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1 mx-auto">
                        <div>
                          <img src="{{Storage::url($item->photo)}}" style="object-fit: cover" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                        </div>
                      </div>
                    </td>
                    <td class="text-center text-xs">
                      {{$item->description}}
                    </td>
                    <td class="text-center text-sm">
                      <b>{{$item->position}}</b> at <b>{{$item->company}}</b>
                    </td>
                    <td class="text-center">
                      <a href="javascript:;" onclick="editModal({{$item->id}})" class="text-secondary text-xs font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                        <i class="fa fa-edit text-info"></i>
                      </a>
                      <a href="javascript:;" onclick="destroy({{$item->id}})" class="text-secondary text-xs font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                        <i class="fa fa-trash text-danger"></i>
                      </a>
                    </td>
                </tr>
                @empty 
                <tr>
                  <td colspan="5" class="text-center text-xs">Testimonial Empty</td>
                </tr>
                @endforelse
                {{-- <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">John Michael</h6>
                        <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Manager</p>
                    <p class="text-xs text-secondary mb-0">Organization</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success">Online</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                  </td>
                  <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
                    </a>
                  </td>
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalLabel">Create</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Name <sup class="text-danger">*</sup></label>
                  <input type="text" name="name" id="name_create" class="form-control">
                  <small class="text-danger" id="name_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Description <sup class="text-danger">*</sup></label>
                  <textarea name="description" id="description_create" cols="30" rows="5" class="form-control"></textarea>
                  <small class="text-danger" id="description_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Photo <sup class="text-danger">*</sup></label>
                  <input type="file" name="photo" id="photo_create" class="form-control" onchange="showImage('create')">
                  <small class="text-danger" id="photo_create_validation"></small>
                    <div class="mt-3">
                        <img src="#" style="display: none;object-fit:cover" id="preview_img_create" width="312px" height="460px" class="rounded" alt="">
                    </div>
                </div>
                <div class="form-group">
                  <label for="">Company <sup class="text-danger">*</sup></label>
                  <input type="text" name="company" id="company_create" class="form-control">
                  <small class="text-danger" id="company_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Position <sup class="text-danger">*</sup></label>
                  <input type="text" name="position" id="position_create" class="form-control">
                  <small class="text-danger" id="position_create_validation"></small>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit">
              <input type="hidden" id="id_edit">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Name <sup class="text-danger">*</sup></label>
                  <input type="text" name="name" id="name_edit" class="form-control">
                  <small class="text-danger" id="name_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Description <sup class="text-danger">*</sup></label>
                  <textarea name="description" id="description_edit" cols="30" rows="5" class="form-control"></textarea>
                  <small class="text-danger" id="description_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Photo <sup class="text-danger">*</sup></label>
                  <input type="file" name="photo" id="photo_edit" class="form-control" onchange="showImage('edit')">
                  <small class="text-danger" id="photo_edit_validation"></small>
                    <div class="mt-3">
                        <img src="#" style="object-fit:cover" id="preview_img_edit" width="312px" height="460px" class="rounded" alt="">
                    </div>
                </div>
                <div class="form-group">
                  <label for="">Company <sup class="text-danger">*</sup></label>
                  <input type="text" name="company" id="company_edit" class="form-control">
                  <small class="text-danger" id="company_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Position <sup class="text-danger">*</sup></label>
                  <input type="text" name="position" id="position_edit" class="form-control">
                  <small class="text-danger" id="position_edit_validation"></small>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>

    function showImage(params) {
        const fileInput = document.getElementById('photo_'+params);
        const previewImg = document.getElementById("preview_img_"+params);
        previewImg.style.display = 'block'

        const reader = new FileReader();
        reader.onload = function() {
            previewImg.src = reader.result;
        }
        reader.readAsDataURL(fileInput.files[0]);
    }

    function hideValidation() {
        const validation = document.querySelectorAll(`[id$="_validation"]`)
        for(var i = 0; i < validation.length; i++){
            
            validation[i].style.display = "none";
        }
    }

    let create = document.getElementById('create');

    create.addEventListener('submit', (e) => {
        e.preventDefault();
        
        let name = create.name.value ?? '';
        let photo = document.getElementById('photo_create').files[0] ?? '';
        let description = create.description.value ?? '';
        let company = create.company.value ?? '';
        let position = create.position.value ?? '';

        let formData = new FormData();
        formData.append('name', name);
        formData.append('photo', photo);
        formData.append('description', description);
        formData.append('company', company);
        formData.append('position', position);

        fetch("{{route('testimonials.store')}}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": "{{csrf_token()}}"
            }
        })
        .then(response => response.json())
        .then(resp => {
            if (resp.status == true) {
              Swal.fire(
                'Good job!',
                'Testimonial Created!',
                'success'
              )
              setInterval(() => {
                location.reload(true)
              }, 1000);
            }else{
                if (resp.data) {
                    var error = Object.entries(resp.data);
                    hideValidation()
                    error.forEach((key,value) => {
                        document.getElementById(key[0]+'_create_validation').style.display = 'block';
                        document.getElementById(key[0]+'_create_validation').textContent = key[1];
                    });
                }
            }
        })

    })
    
    function editModal(id){
      var myModal = new bootstrap.Modal(document.getElementById("editModal"), {});
      
      fetch("{{url('testimonials')}}/"+id)
      .then(response => response.json())
      .then(function (resp) {
        if (resp.status == true) {

            document.getElementById('id_edit').value = id;
            document.getElementById('name_edit').value = resp.data.name;
            document.getElementById('preview_img_edit').src = resp.data.photo_storage;
            document.getElementById('description_edit').value = resp.data.description;
            document.getElementById('position_edit').value = resp.data.position;
            document.getElementById('company_edit').value = resp.data.company;

            myModal.show();
        } 
      })
    }

    let edit = document.getElementById('edit');

    edit.addEventListener('submit', (e) => {
        e.preventDefault();
        
        let id = edit.id_edit.value ?? '';
        let name = edit.name.value ?? '';
        let photo = document.getElementById('photo_edit').files[0] ?? '';
        let description = edit.description.value ?? '';
        let company = edit.company.value ?? '';
        let position = edit.position.value ?? '';

        let formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('photo', photo);
        formData.append('description', description);
        formData.append('company', company);
        formData.append('position', position);

        fetch("{{route('testimonials.update')}}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": "{{csrf_token()}}"
            }
        })
        .then(response => response.json())
        .then(resp => {
            if (resp.status == true) {
              Swal.fire(
                'Good job!',
                'Testimonial Edited!',
                'success'
              )
              setInterval(() => {
                location.reload(true)
              }, 1000);
            }else{
                if (resp.data) {
                    var error = Object.entries(resp.data);
                    hideValidation()
                    error.forEach((key,value) => {
                        document.getElementById(key[0]+'_edit_validation').style.display = 'block';
                        document.getElementById(key[0]+'_edit_validation').textContent = key[1];
                    });
                }
            }
        })

    })

    function destroy(id){
      Swal.fire({
                icon: 'info',
                title: 'Are you sure to delete this Testimonial?',
                showCancelButton: true,
                confirmButtonColor: '#fc4b6c',
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                  fetch("{{url('testimonials')}}/"+id+"/delete")
                  .then(response => response.json())
                  .then(function (resp) {
                    if (resp.status == true) {
                      Swal.fire(
                        'Good job!',
                        'Testimonial Deleted!',
                        'success'
                      )
                      setInterval(() => {
                        location.reload(true)
                      }, 1000);
                    } 
                  })
                }
            })
    }

  </script>
@endsection