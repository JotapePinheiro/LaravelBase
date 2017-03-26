@extends('site::layouts.app')

@section('template_title')
  Lista de Funções
@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .roles-table {
            border: 0;
        }
        .roles-table tr td:first-child {
            padding-left: 15px;
        }
        .roles-table tr td:last-child {
            padding-right: 15px;
        }
        .roles-table.table-responsive,
        .roles-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Exibindo todas as Funções
                            <a href="/roles/create" class="btn btn-default btn-sm pull-right">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                Criar Nova Função
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="table-responsive roles-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th class="hidden-xs">Slug</th>
                                        <th class="hidden-xs">Descrição</th>
                                        <th class="hidden-xs">Level</th>
                                        <th class="hidden-sm hidden-xs hidden-md">Created</th>
                                        <th class="hidden-sm hidden-xs hidden-md">Updated</th>
                                        <th>Actions</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td class="hidden-xs">{{ $role->description }}</td>
                                            <td class="hidden-xs">{{$role->level}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$role->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$role->updated_at}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'roles/' . $role->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> Role</span>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Role', 'data-message' => 'Are you sure you want to delete this role ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('roles/' . $role->id) }}" data-toggle="tooltip" title="Show">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> Role</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('roles/' . $role->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> Role</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site::modals.modal-delete')

@endsection

@section('footer_scripts')

    @if (count($roles) > 10)
        @include('site::scripts.datatables')
    @endif
    @include('site::scripts.delete-modal-script')
    @include('site::scripts.save-modal-script')
    {{--
        @include('scripts.tooltips')
    --}}
@endsection