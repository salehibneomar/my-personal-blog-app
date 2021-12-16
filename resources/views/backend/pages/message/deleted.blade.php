@extends('backend.layout')

@section('page_title')
{{ 'Deleted Messages' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="overflow-x: auto;">
                <h4>Deleted Messages</h4>
                <div class="m-t-25">
                    <table id="data-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:5% ;">Status</th>
                                <th >Sender</th>
                                <th >Email</th>
                                <th >Subject</th>
                                <th style="width:10% ;">IP</th>
                                <th style="width:10% ;">Date</th>
                                <th style="width:15% ;">Action</th>
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
                ajax: "{{ route('author.message.deleted') }}",
                language: {
                    processing: "Fetching data..."
                },
                columns: [
                    {data: 'seen_status', name: 'seen_status'},
                    {data: 'sender_name', name: 'sender_name'},
                    {data: 'sender_email', name: 'sender_email'},
                    {data: 'subject', name: 'subject'},
                    {data: 'sender_ip', name: 'sender_ip'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              order: [[ 0, "desc" ]],
              lengthMenu: ["10", "20"],
              pageLength: 10,
              responsive: true,
            });

            $('table').on('click', '.restore-button', function(e){
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Want to restore?',
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