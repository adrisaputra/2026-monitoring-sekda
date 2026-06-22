<!--begin::Form-->
<form id="myForm" action="{{ url('/'.Request::segment(1)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{ csrf_field() }}
    <!--begin::Card body-->
    <input type="hidden" class="form-control" id="id_user" value="{{ Crypt::encrypt($user->id) }}"/>
    
    <div class="form-group row mb-4">
        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{ __('Nama Pengguna') }}  <span class="required" style="color: #dd4b39;">*</span></label>
        <div class="col-xl-9 col-lg-9 col-sm-10">
            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Pengguna" value="{{ $user->name }}"/>
            <div id="name-error" class="fv-plugins-message-container invalid-feedback" style="display: block;"></div>
		</div>
    </div>
    
    <div class="form-group row mb-4">
        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{ __('Email') }}  <span class="required" style="color: #dd4b39;">*</span></label>
        <div class="col-xl-9 col-lg-9 col-sm-10">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $user->email }}"/>
            <div id="email-error" class="fv-plugins-message-container invalid-feedback" style="display: block;"></div>
        </div>
    </div>
    
    <div class="form-group row mb-4">
        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{ __('Foto User') }}  <span class="required" style="color: #dd4b39;">*</span></label>
        <div class="col-xl-9 col-lg-9 col-sm-10">
            <input type="file" name="photo" id="photo" class="form-control form-control-sm" placeholder="Foto"/>
            <span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 300 Kb (jpg,jpeg,png)</i></span>
            <div id="show_photo">
                @if($user->photo)
                    <img src="{{ asset('upload/photo/'.$user->photo) }}" width="150px" height="150px">
                @endif
            </div> 
        </div>
    </div>

    <hr style="border-top: 1px solid #d4d8e0;">

    <div class="form-group row mb-4">
        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{ __('Password Baru') }}  <span class="required" style="color: #dd4b39;">*</span></label>
        <div class="col-xl-9 col-lg-9 col-sm-10">
            <input type="password" class="form-control form-control-sm" name="password" id="password">
            <div id="password-error" class="fv-plugins-message-container invalid-feedback" style="display: block;"></div>
        </div>
    </div>
    
    <div class="form-group row mb-4">
        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{ __('Konfirmasi Password') }}  <span class="required" style="color: #dd4b39;">*</span></label>
        <div class="col-xl-9 col-lg-9 col-sm-10">
            <input type="password" class="form-control form-control-sm" name="password_confirmation" id="password_confirmation">
        </div>
    </div>
    
    <button type="submit" class="btn btn-success">Simpan</button>
    <button type="reset" class="btn btn-warning">Reset</button>
</form>	