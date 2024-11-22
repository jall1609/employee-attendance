@extends('admin.main')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"> {{ empty($employe) ? 'Create' : 'Edit' }}  Employee</h6>
            </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0 m-3">
                    <form action="{{  empty($employe) ?  url('/admin/employee') : url('/admin/employee/' . $employe->username)  }}" method="post" class="m-3">
                        {{ csrf_field() }}
                        <h6 class="m-0">Isi Form Berikut Ini</h6>
                        @foreach(['name', 'email', 'city', 'jabatan'] as $item)
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center my-2">
                            <div class="input-group input-group-outline">
                                <label class="form-label">{{ ucwords($item) }}</label>
                                <input type="{{ $item == 'email' ? 'email' : $item }}" class="form-control" name="{{$item}}" value="{{ $employe->$item ?? old($item)}}" required>
                            </div>
                        </div>
                        @error($item)
                            <div class="invalid-inputan">
                                {{ $message }}
                            </div>
                        @enderror
                        @endforeach
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center my-2">
                            <div class="input-group input-group-outline has-validation">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="{{  old('password')}}" required>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-inputan">
                                {{ $message }} 
                            </div>
                        @enderror
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center my-2">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth" value="{{ $employe->date_of_birth ??   old('date_of_birth')  }}" required>
                            </div>
                        </div>
                        @error('date_of_birth')
                            <div class="invalid-inputan">
                                {{ $message }}
                            </div>
                        @enderror
                        @isset($employe)
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center my-2">
                            <select name="status"    id="" class="js-select2 form-control">
                                <option value="active" @if($employe->status == 'active') selected @endif>Active</option>
                                <option value="inactive"  @if($employe->status == 'inactive') selected @endif>Inactive</option>
                            </select>
                        </div>
                        @endisset
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection