@extends('layouts.app')

@section('head')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .select2{
      width: 100px;
      font-size: 15px;
    }
  </style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
             <h6>Webinars table</h6>
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
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Webinar</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Mentors & Categories</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Class Type</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Quota</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Date</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($webinars as $item)
                <tr>
                    <td class="text-center text-xs">
                      <div class="py-2">
                        <img src="{{Storage::url($item->thumbnail)}}" style="object-fit: cover" width="175px" height="75px" class="rounded" alt="">
                      </div>
                      <b>{{$item->title}}</b>
                    </td>
                    <td class="text-center text-xs">
                      @if ($item->mentors)
                          <div class="flex mt-3">
                            @foreach ($item->mentors as $mentor)
                                <img src="{{Storage::url($mentor->photo)}}" style="object-fit: cover; cursor:pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$mentor->name}}" class="avatar avatar-sm me-3 rounded-circle" alt="user1">
                            @endforeach
                          </div>
                      @endif
                      @if ($item->categories)
                          <div class="flex mt-3">
                            {{$item->categories ? implode(', ', $item->categories->pluck('name')->toArray()) : '-'}}
                          </div>
                      @endif
                    </td>
                    <td class="text-center text-cs">
                      @php
                          $classColor = 'info';
                          if($item->class_type == 'Intermediete'){
                            $classColor = 'success';
                          }elseif ($item->class_type == 'Expert') {
                            $classColor = 'danger';
                          }
                      @endphp
                      <span class="badge badge-sm bg-gradient-{{$classColor}}">{{$item->class_type}}</span>
                    </td>
                    <td class="text-center text-xs">
                      {{$item->participants->count() ?: 0}} / {{$item->quota}}
                      
                      @php
                          $percentage = 0;
                          $color = 'danger';
                          if ($item->participants->count() > 0 && $item->quota > 0) {
                              $percentage = ($item->participants->count() / $item->quota) * 100;
                          }
                          if($percentage == 100){
                            $color = 'primary';
                          }
                      @endphp
                      
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold">{{round($percentage)}}%</span>
                        <div>
                        <div class="progress">
                        <div class="progress-bar bg-gradient-{{$color}}" role="progressbar" aria-valuenow="{{round($percentage)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($percentage)}}%;"></div>
                        </div>
                        </div>
                      </div>

                    </td>
                    <td class="text-center text-xs">
                      {{date('d M Y', strtotime($item->date))}}
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
                  <td colspan="6" class="text-center text-xs">Webinar Empty</td>
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
                  <label for="">Title <sup class="text-danger">*</sup></label>
                  <input type="text" name="title" id="title_create" class="form-control">
                  <small class="text-danger" id="title_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Thumbnail <sup class="text-danger">*</sup></label>
                  <input type="file" name="thumbnail" id="thumbnail_create" class="form-control" onchange="showImage('create')">
                  <small class="text-danger" id="thumbnail_create_validation"></small>
                    <div class="mt-3">
                        <img src="#" style="display: none;object-fit:cover" id="preview_img_create" width="350px" height="130px" class="rounded" alt="">
                    </div>
                </div>
                <div class="form-group">
                  <label for="">Quota <sup class="text-danger">*</sup></label>
                  <input type="number" name="quota" id="quota_create" class="form-control">
                  <small class="text-danger" id="quota_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Description <sup><small>(Optional)</small></sup></label>
                  <textarea name="description" class="form-control" id="description_create" cols="30" rows="5"></textarea>
                  <small class="text-danger" id="description_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Class Type <sup class="text-danger">*</sup></label>
                  <select name="class_type" class="form-select" id="class_type_create">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediete">Intermediete</option>
                    <option value="Expert">Expert</option>
                  </select>
                  <small class="text-danger" id="class_type_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Date <sup class="text-danger">*</sup></label>
                  <input type="date" name="date" id="date_create" class="form-control">
                  <small class="text-danger" id="date_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Mentor <sup class="text-danger">*</sup> </label>
                    <select name="mentors_id[]" multiple="multiple" class="form-select select2" id="mentors_id_create">
                      @foreach ($mentors as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                    <small class="text-danger" id="mentors_id_create_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Categories <sup class="text-danger">*</sup> </label>
                    <select name="categories_id[]" multiple="multiple" class="form-select select2" id="categories_id_create">
                      @foreach ($categories as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                    <small class="text-danger" id="categories_id_create_validation"></small>
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
                  <label for="">Title <sup class="text-danger">*</sup></label>
                  <input type="text" name="title" id="title_edit" class="form-control">
                  <small class="text-danger" id="title_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Thumbnail <sup class="text-danger">*</sup></label>
                  <input type="file" name="thumbnail" id="thumbnail_edit" class="form-control" onchange="showImage('create')">
                  <small class="text-danger" id="thumbnail_edit_validation"></small>
                    <div class="mt-3">
                        <img src="#" style="object-fit:cover" id="preview_img_edit" width="350px" height="130px" class="rounded" alt="">
                    </div>
                </div>
                <div class="form-group">
                  <label for="">Quota <sup class="text-danger">*</sup></label>
                  <input type="number" name="quota" id="quota_edit" class="form-control">
                  <small class="text-danger" id="quota_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Description <sup class="text-danger">*</sup></label>
                  <textarea name="description" class="form-control" id="description_edit" cols="30" rows="5"></textarea>
                  <small class="text-danger" id="description_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Class Type <sup class="text-danger">*</sup></label>
                  <select name="class_type" class="form-select" id="class_type_edit">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediete">Intermediete</option>
                    <option value="Expert">Expert</option>
                  </select>
                  <small class="text-danger" id="class_type_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Date <sup class="text-danger">*</sup></label>
                  <input type="date" name="date" id="date_edit" class="form-control">
                  <small class="text-danger" id="date_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Mentor <sup class="text-danger">*</sup> </label>
                    <select name="mentors_id[]" multiple="multiple" class="form-select select2" id="mentors_id_edit">
                      @foreach ($mentors as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                    <small class="text-danger" id="mentors_id_edit_validation"></small>
                </div>
                <div class="form-group">
                  <label for="">Categories <sup class="text-danger">*</sup> </label>
                    <select name="categories_id[]" multiple="multiple" class="form-select select2" id="categories_id_edit">
                      @foreach ($categories as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                    <small class="text-danger" id="categories_id_edit_validation"></small>
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
@endsection

@section('body')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

  function showImage(params) {
      const fileInput = document.getElementById('thumbnail_'+params);
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
      
      var mentorsOptions = $('#mentors_id_create').select2('data');
      var mentorsValues = [];
      for (var i = 0; i < mentorsOptions.length; i++) {
        mentorsValues.push(mentorsOptions[i].id);
      }
      
      var categoriesOptions = $('#categories_id_create').select2('data');
      var categoriesValues = [];
      for (var i = 0; i < categoriesOptions.length; i++) {
        categoriesValues.push(categoriesOptions[i].id);
      }

      let title = create.title.value ?? '';
      let thumbnail = document.getElementById('thumbnail_create').files[0] ?? '';
      let class_type = create.class_type.value ?? '';
      let date = create.date.value ?? '';
      let quota = create.quota.value ?? '';
      let description = create.description.value ?? '';

      let formData = new FormData();
      formData.append('mentors_id', mentorsValues);
      formData.append('categories_id', categoriesValues);
      formData.append('title', title);
      formData.append('thumbnail', thumbnail);
      formData.append('quota', quota);
      formData.append('description', description);
      formData.append('class_type', class_type);
      formData.append('date', date);

      fetch("{{route('webinars.store')}}", {
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
              'Webinar Created!',
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
    
    fetch("{{url('webinars')}}/"+id)
    .then(response => response.json())
    .then(function (resp) {
      if (resp.status == true) {

          document.getElementById('id_edit').value = id;
          document.getElementById('title_edit').value = resp.data.title;
          document.getElementById('description_edit').value = resp.data.description;
          document.getElementById('quota_edit').value = resp.data.quota;
          document.getElementById('preview_img_edit').src = resp.data.thumbnail_storage;
          document.getElementById('class_type_edit').value = resp.data.class_type;
          document.getElementById('date_edit').value = resp.data.date;

          $('#mentors_id_edit').val(resp.data.mentorsSelected).trigger('change');
          $('#categories_id_edit').val(resp.data.categoriesSelected).trigger('change');

          myModal.show();
      } 
    })
  }

  let edit = document.getElementById('edit');

  edit.addEventListener('submit', (e) => {
      e.preventDefault();
      
      var mentorsOptions = $('#mentors_id_edit').select2('data');
      var mentorsValues = [];
      for (var i = 0; i < mentorsOptions.length; i++) {
        mentorsValues.push(mentorsOptions[i].id);
      }
      
      var categoriesOptions = $('#categories_id_edit').select2('data');
      var categoriesValues = [];
      for (var i = 0; i < categoriesOptions.length; i++) {
        categoriesValues.push(categoriesOptions[i].id);
      }

      let id = edit.id_edit.value ?? '';
      let title = edit.title.value ?? '';
      let thumbnail = document.getElementById('thumbnail_edit').files[0] ?? '';
      let class_type = edit.class_type.value ?? '';
      let date = edit.date.value ?? '';
      let quota = edit.quota.value ?? '';
      let description = edit.description.value ?? '';

      let formData = new FormData();
      formData.append('mentors_id', mentorsValues);
      formData.append('categories_id', categoriesValues);
      formData.append('id', id);
      formData.append('title', title);
      formData.append('thumbnail', thumbnail);
      formData.append('quota', quota);
      formData.append('description', description);
      formData.append('class_type', class_type);
      formData.append('date', date);

      fetch("{{route('webinars.update')}}", {
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
              'Webinar Edited!',
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
        title: 'Are you sure to delete this Webinar?',
        showCancelButton: true,
        confirmButtonColor: '#fc4b6c',
        confirmButtonText: 'Delete',
    }).then((result) => {
        if (result.isConfirmed) {
          fetch("{{url('webinars')}}/"+id+"/delete")
          .then(response => response.json())
          .then(function (resp) {
            if (resp.status == true) {
              Swal.fire(
                'Good job!',
                'Webinar Deleted!',
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

  $(document).ready(function() {
      $('.select2').select2({
        width: '100%'
      });
  });

</script>
    
@endsection