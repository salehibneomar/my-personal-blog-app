@extends('backend.layout')

@section('page_title')
{{ 'All Posts' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="overflow-x: auto;">
                <h4>All Posts</h4>
                <div class="m-t-25">
                    <table id="data-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 8%">#ID</th>
                                <th style="width: 10%">Image</th>
                                <th>Title/Caption</th>
                                <th style="width: 5%">Type</th>
                                <th style="width: 12%">Date</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra_script')
    <script>
        $(document).ready(function(){
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('author.post.all') }}",
                language: {
                    processing: "Fetching data..."
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              order: [[ 0, "desc" ]],
              lengthMenu: ["10", "20"],
              pageLength: 10, 
            });

            $('table').on('click', '.delete-button', function(e){
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Want to delete?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'YES'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            });
        });
    </script>
@endsection