<x-app-layout>
    @section('title')
        List Form PREMPDR
    @endsection

    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap.min.css">
    @endpush


    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">List Form PREMPDR</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">List Form PREMPDR</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets') }}/images/breadcrumb/ChatBc.png" alt="modernize-img"
                            class="img-fluid mb-n4">
                    </div>
                </div>
                <div class="col-3">
                    <button onclick="history.back()" class="btn btn-sm btn-primary flex-end">Back</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">
        <a href=" {{ route('prempdr.create') }} " class="btn btn-outline-primary">Create New Form</a>
    </div>

    <div class="card">
        <div class="card-body">
           <div class="table-responsive">
            <table class="table table-striped table-bordered" id="prempdrTable">
                <thead class="header-item">
                    <th>No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Route To</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
           </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
    <script>
        $('#prempdrTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '{{ route('prempdr.form.list') }}',
                type: 'GET',
                dataSrc: function(response) {
                    return response;
                }
            },
            columns: [
                { data: 'no', name: 'no_reg' },
                { data: 'project_name', name: 'name' },
                { data: 'status', name: 'status',
                    render: function(data, type, row) {
                        if (data === 'Rejected') {
                            return '<span class="text-danger">' + data + '</span>';
                        } else if (data === 'Approved') {
                            return '<span class="text-success">' + data + '</span>';
                        } else if (data === 'In Approval'){
                            return `<span class="text-primary"> ${data}  (${row.approved_detail[0].approved_count}/${row.approved_detail[0].total}) </span>`;
                        }else if (data === 'Draft'){
                            return '<span class="text-body-secondary">' + data + '</span>';
                        }
                        // return data;
                    }
                },
                { data: 'route_to', name: 'route_to' },
                { data: null, name: 'action', orderable: false, searchable: false, 
                    render: function(data, type, row) {
                        if (data.status === 'Draft') {
                            const editRoute = "{{ route('prempdr.edit', ':formId') }}".replace(':formId', row.no);
                            const deleteRoute = "{{ route('prempdr.destroy', ':formId') }}".replace(':formId', row.no);

                            return `
                            <div class="d-flex gap-6">
                                <a href="${editRoute}" class="btn btn-outline-primary" >Edit Form</a>
                                <form id="delete-form-${row.no}" action="${deleteRoute}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <a href="javascript:void(0)" class="btn btn-outline-danger" data-form-no="${row.no}" onClick="confirmDelete(this)">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </form>
                            </div>
                            `;
                        } else {
                            const route = "{{ route('prempdr.form', ':formId') }}";
                            const url = route.replace(':formId', row.no);
                            return `<a href="${url}" class="btn btn-outline-primary" >View Form</a>`;
                        }
                    }
                }
            ]
        });

        // Function untuk konfirmasi delete user
        function confirmDelete(button){
            var formNo = button.getAttribute('data-form-no');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + formNo).submit();
                }
            });
        }
    </script>
    @endpush

</x-app-layout>
