<x-dashboard-layout>
    <div class="section-body">
        <div class="card ">
            <div class="card-header">
                <h4>Search User Data</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12 ">
                    <form method="get" action="{{route('home')}}">
                        <div class="row">
                            <div class="form-group  col-md-4 col-sm-12 ">
                                <div class="section-title ">Username :</div>
                                <div class="input-group mb-3">
                                    <input type="text" id="username" name="username"
                                           {{old('username')}} class="form-control" placeholder="username .."
                                           aria-label="">

                                </div>

                            </div>
                            <div class="form-group  col-md-4 col-sm-12 ">
                                <div class="section-title ">Number :</div>
                                <div class="input-group mb-3">
                                    <input type="text" id="number" name="number" {{old('number')}} class="form-control"
                                           placeholder="username .." aria-label="">

                                </div>

                            </div>

                        </div>
                        <div class="form-group pt-4">
                            <button type="submit" class="btn btn-outline-success btn-lg">Search </button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-md ">
                            <tr>
                                <th>#</th>
                                <th> {{__('Name')}}</th>
                                <th>{{__('username')}}</th>
                                <th>{{__('number')}}</th>
                            </tr>
                            @foreach($users_response??[] as $u)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$u['name']}}</td>
                                    <td>{{$u['username']}}</td>
                                    <td>{{$u['number']}}</td>

                                </tr>
                                {{--                              <x-delete link="{{route('brands.destroy',['brand'=>$u->id])}}" />--}}
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                <h4>Search Post Data</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12 ">
                    <form method="get" action="#">


                        <div class="row">
                            <div class="form-group  col-md-4 col-sm-12 ">
                                <div class="section-title ">key word :</div>
                                <div class="input-group mb-3">
                                    <input type="text" id="keyword" name="keyword"
                                           {{old('keyword')}} class="form-control" placeholder="username .."
                                           aria-label="">

                                </div>

                            </div>


                        </div>

                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-md ">
                            <tr>
                                <th>#</th>
                                <th> {{__('Name')}}</th>
                                <th>{{__('Create Time')}}</th>
                                <th>{{__('Operation')}}</th>
                            </tr>
                            @foreach($brands??[] as $u)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->mcreated}}</td>
                                    <td>
                                        <a href="{{route('admin.brands.edit',$u)}}" class="btn btn-warning"><i
                                                class="fas fa-edit"></i></a>
                                        {{--                              <button onclick="openDeleteModal('{{$u->_id}}')" class="btn btn-danger"><i class="fas fa-trash"></i></button>--}}
                                    </td>
                                </tr>
                                {{--                              <x-delete link="{{route('brands.destroy',['brand'=>$u->id])}}" />--}}
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card  px-4 ">
            <div class="row">
                <div class="section-title col-4">Users Max Age : {{$age_response['max_age']['value']}}</div>
                <div class="section-title   col-4">Users Average Age : {{$age_response['avg_age']['value']}}</div>
                <div class="section-title   col-4">Users Min Age : {{$age_response['min_age']['value']}}</div>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                <h4>get User Posts(CSV)</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12 ">
                    <form method="get" action="#">
                        <div class="row">
                            <div class="form-group  col-md-4 col-sm-12 ">
                                <div class="section-title ">User Id :</div>
                                <div class="input-group mb-3">
                                    <input type="text" id="_id" name="_id"
                                           {{old('id')}} class="form-control" placeholder="User Id .."
                                           aria-label="">

                                </div>

                            </div>


                        </div>

                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-md ">
                            <tr>
                                <th>#</th>
                                <th> {{__('Name')}}</th>
                                <th>{{__('Create Time')}}</th>
                                <th>{{__('Operation')}}</th>
                            </tr>
                            @foreach($brands??[] as $u)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->mcreated}}</td>
                                    <td>
                                        <a href="{{route('admin.brands.edit',$u)}}" class="btn btn-warning"><i
                                                class="fas fa-edit"></i></a>
                                        {{--                              <button onclick="openDeleteModal('{{$u->_id}}')" class="btn btn-danger"><i class="fas fa-trash"></i></button>--}}
                                    </td>
                                </tr>
                                {{--                              <x-delete link="{{route('brands.destroy',['brand'=>$u->id])}}" />--}}
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                <h4>Search Posts By Keywords</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12 ">
                    <form method="get" action="{{route('home')}}">
                        <div class="row">
                            <div class="form-group col-md-5 col-sm-12">
                                <label class="control-label">  Keyword (type and press enter) :</label>
                                <select multiple type="text"  name="caption_keywords[]"  id="caption_keywords"
                                        class="form-control select2 ">

                                </select>
                            </div>


                        </div>
                        <div class="form-group pt-4">
                            <button type="submit" class="btn btn-outline-success btn-lg">Search </button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-md ">
                            <tr>
                                <th>#</th>
                                <th> {{__('Name')}}</th>
                                <th>{{__('Create Time')}}</th>
                                <th>{{__('Operation')}}</th>
                            </tr>
                            @foreach($brands??[] as $u)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->mcreated}}</td>
                                    <td>
                                        <a href="{{route('admin.brands.edit',$u)}}" class="btn btn-warning"><i
                                                class="fas fa-edit"></i></a>
                                        {{--                              <button onclick="openDeleteModal('{{$u->_id}}')" class="btn btn-danger"><i class="fas fa-trash"></i></button>--}}
                                    </td>
                                </tr>
                                {{--                              <x-delete link="{{route('brands.destroy',['brand'=>$u->id])}}" />--}}
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                <h4>Search Posts By User ID(1-300)</h4>
                @if(session('file_status')=='ok')
                <a class="btn btn-info" href="{{asset('fileout.csv')}}">Download Csv</a>
                @endif
            </div>
            <div class="card-body">
                <div class="col-md-12 ">
                    <form method="get" action="{{route('search.user-posts')}}">
                        <div class="row">
                            <div class="form-group col-md-5 col-sm-12">
                                <label class="control-label"> Enter User Id ID(1-300) :</label>
                                <input type="text" id="_id" name="_id" {{old('_id')}} class="form-control"
                                       placeholder="User Id .." aria-label="">
                            </div>


                        </div>
                        <div class="form-group pt-4">
                            <button type="submit" class="btn btn-outline-success btn-lg">Search </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {

                $('#caption_keywords').select2({tags:true,
                    width:'100%'
                })
            });
        </script>
            @endpush
</x-dashboard-layout>
