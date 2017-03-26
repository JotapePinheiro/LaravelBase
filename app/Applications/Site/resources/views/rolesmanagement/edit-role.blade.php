@extends('site::layouts.app')

@section('template_title')
  Editing User {{ $role->name }}
@endsection

@section('template_linked_css')
  <style type="text/css">
    .btn-save,
    .pw-change-container {
      display: none;
    }
  </style>
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            <strong>Editing Role:</strong> {{ $role->name }}

            <a href="/roles/{{$role->id}}" class="btn btn-primary btn-xs pull-right" style="margin-left: 1em;">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
             Back  <span class="hidden-xs">to Role</span>
            </a>

            <a href="/roles" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to </span>Roles
            </a>

          </div>

          {!! Form::model($role, array('action' => array('RolesManagementController@update', $role->id), 'method' => 'PUT')) !!}

            {!! csrf_field() !!}

            <div class="panel-body">

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', 'Name' , array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.ph-username'))) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-user }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('slug') ? ' has-error ' : '' }}">
                {!! Form::label('slug', 'Slug' , array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('slug', old('slug'), array('id' => 'slug', 'class' => 'form-control', 'placeholder' => trans('forms.ph-useremail'))) !!}
                    <label class="input-group-addon" for="slug"><i class="fa fa-fw fa-envelope " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>


              <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                {!! Form::label('description', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('description', NULL, array('id' => 'description', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                    <label class="input-group-addon" for="description"><i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('level') ? ' has-error ' : '' }}">
                {!! Form::label('level', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('level', NULL, array('id' => 'level', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                    <label class="input-group-addon" for="level"><i class="fa fa-fw {{ trans('forms.create_user_icon_lastname') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('level'))
                    <span class="help-block">
                        <strong>{{ $errors->first('level') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row text-left">
                {!! Form::label('permissions', trans('forms.create_user_label_role'), array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                  @if ($permissions->count())
                    @foreach($permissions as $permission)
                        {{--@php--}}
                        {{--dd($role_permissions);--}}
                        {{--@endphp--}}
                      <input type="checkbox" {{in_array($permission->id,$role_permissions)?"checked":""}} name="permission[]" value="{{$permission->id}}" > {{$permission->name}} <br>
                    @endforeach
                  @endif
                  </div>
                  @if ($errors->has('permissions'))
                    <span class="help-block">
                        <strong>{{ $errors->first('permissions') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              </div>

            </div>
            <div class="panel-footer">

              <div class="row">

                <div class="col-xs-6">
                  <a href="#" class="btn btn-default btn-block margin-bottom-1 btn-change-pw" title="Change Password">
                    <i class="fa fa-fw fa-lock" aria-hidden="true"></i>
                    <span></span> Change Password
                  </a>
                </div>

                <div class="col-xs-6">
                  {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes', array('class' => 'btn btn-success btn-block margin-bottom-1 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                </div>
              </div>
            </div>

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

  @include('site::modals.modal-save')
  @include('site::modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('site::scripts.delete-modal-script')
  @include('site::scripts.save-modal-script')
  @include('site::scripts.check-changed')

@endsection