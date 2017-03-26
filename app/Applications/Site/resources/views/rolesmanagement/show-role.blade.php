@extends('site::layouts.app')

@section('template_title')
  Showing Role {{ $role->name }}
@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
  <style type="text/css" media="screen">
    .role-table {
        border: 0;
    }
    .role-table tr th {
        border: 0 !important;
    }
    .role-table tr th:first-child,
    .role-table tr td:first-child {
        padding-left: 15px;
    }
    .role-table tr th:last-child,
    .role-table tr td:last-child {
        padding-right: 15px;
    }
    .role-table .table-responsive,
    .role-table .table-responsive table {
        margin-bottom: 0;
        border-top: 0;
        border-left: 0;
        border-right: 0;
    }
  </style>
@endsection

@section('content')

  <div class="container">

    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
          <div class="panel-heading">

              Informações da função {{ $role->name }}

            <a href="/roles/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              Back to Users
            </a>

          </div>
          <div class="panel-body no-padding role-table table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nome</th>
                      <th>Slug</th>
                      <th>Descrição</th>
                      <th>Level</th>
                      <th>Permissões</th>
                      <th>Created</th>
                      <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;">
                            {{ $role->id }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ $role->name }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ $role->slug }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ $role->description }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ $role->level }}
                        </td>
                        <td>
                            <ul>
                            @foreach ($currentPermission as $role_permission)

                                <li>{{ $role_permission->name }}</li>

                            @endforeach
                            </ul>
                        </td>
                        <td style="vertical-align: middle;">
                            {{ $role->created_at }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ $role->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-xs-6">
                <a href="/roles/{{$role->id}}/edit" class="btn btn-small btn-info btn-block">
                  <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit<span class="hidden-xs hidden-sm"> this</span><span class="hidden-xs"> User</span>
                </a>
              </div>
              {!! Form::open(array('url' => 'roles/' . $role->id, 'class' => 'col-xs-6')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete<span class="hidden-xs hidden-sm"> this</span><span class="hidden-xs"> User</span>', array('class' => 'btn btn-danger btn-block btn-flat','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('site::modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('site::scripts.delete-modal-script')

@endsection