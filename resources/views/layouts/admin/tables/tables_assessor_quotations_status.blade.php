<div class="container-fluid mb-4">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0 height-table">
        <table class="table table-head-fixed">
            <thead class="header-table">
                <tr>
                    @foreach ($headers as $header)
                    <th scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach($datas as $data)
                <tr>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->