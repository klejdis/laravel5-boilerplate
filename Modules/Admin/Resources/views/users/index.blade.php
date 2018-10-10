@extends("admin::layouts.admin")

@section('page')

    <div class="p20">
        <div class="panel panel-default">
            <div class="page-title clearfix">
                <h1>{{ $panel['name'] }}</h1>

                <div class="title-button-group">

                </div>
            </div>

            <div class="panel-body">
                <table id="users" class="table"></table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $('#users').appTable({
               source :  '{{ route('admin.users.datatable') }}',
               columns : [
                   {  title : 'Id' , data : 'id'},
                   {  title : 'Name' , data : 'first_name' },
                   {  title : 'Surname' , data : 'last_name' },
                   {  title : 'Email' , data : 'email'},
                   {  title : 'Created At' , data : 'created_at' },
                   {  data : 'actions', title: '<i class="fa fa-bars"></i>', "class": "text-center option w150" , orderable: false},
               ],
            });


        });
    </script>
@endpush


