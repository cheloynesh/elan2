@extends('home')
{{-- @section('title','Perfiles') --}}
@section('content')
    <div class="text-center"><h1>Catálogo de Perfiles</h1></div>
    <div style="max-width: 900px; margin: auto;">
        {{-- modal| --}}
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="gridModalLabek">Registro de Perfiles</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" id="name" name="name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                        <button type="button" onclick="guardarperfil()" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin modal| --}}
        @include('admin.profile.profileedit')
        {{-- Inicia pantalla de inicio --}}
        <div class="bd-example bd-example-padded-bottom">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo</button>
        </div>
        <br><br>
        <div class="table-responsive" style="margin-bottom: 10px; max-width: 1200px; margin: auto;">
            <table class="table table-striped table-hover text-center" id="tbProf">
                <thead>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Opciones</th>
                </thead>

                <tbody>
                    @foreach ($profiles as $profile)
                        <tr id="{{$profile->id}}">
                            <td>{{$profile->name}}</td>
                            <td>
                                <a href="#|" class="btn btn-warning" onclick="editarperfil({{$profile->id}})" >Editar</a>
                                <a href="#|" class="btn btn-danger" onclick="eliminarperfil({{$profile->id}})">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
{{-- <script src="{{URL::asset('public/js/admin/profile.js')}}"></script> --}}
    <script>
        var ruta = window.location;
        var baseURL = "{{url()->current()}}";
        // console.log(baseURL);
        function guardarperfil()
        {
            var name = $("#name").val();
            // alert(name);
            var route = "profiles";
            // alert(route);
            var data = {
                "_token": "{{ csrf_token() }}",
                'name':name
            };
            // if(jQuery) alert('jQuery is loaded');
            // $.noConflict();
            jQuery.ajax({
                url:route,
                type:"post",
                data: data,
                dataType: 'json',
                success:function(result)
                {
                    $("#myModal").modal('hide');
                    window.location.reload(true);
                }
            })
        }
        var idupdate = 0;
        function editarperfil(id)
        {
            idupdate=id;
            // alert(id);
            var route = baseURL + '/GetInfo/'+ id;
            // console.log(route);
            jQuery.ajax({
                url:route,
                type:'get',
                dataType:'json',
                success:function(result)
                {
                    $("#name1").val(result.data.name);
                    $("#myModaledit").modal('show');
                }
            })
        }
        function cancelareditar()
        {
            $("#name1").val("");
            $("#myModaledit").modal('hide');
        }
        function actualizarperfil()
        {
            var name = $("#name1").val();
            var route = "profiles/"+idupdate;
            var data = {
                'id':idupdate,
                "_token": "{{ csrf_token() }}",
                'name':name
            };
            jQuery.ajax({
                url:route,
                type:'put',
                data:data,
                dataType:'json',
                success:function(result)
                {
                    $("#myModaledit").modal('hide');
                    window.location.reload(true);
                }
            })
        }

        function eliminarperfil(id)
        {
            var route = "profiles/"+id;
            var data = {
                    'id':id,
                    "_token": "{{ csrf_token() }}"
            };
            jQuery.ajax({
                url:route,
                data: data,
                type:'delete',
                dataType:'json',
                success:function(result)
                {
                    window.location.reload(true);
                }
            })
        }
    </script>
@endsection
{{-- @endsection --}}
