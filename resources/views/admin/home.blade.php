
<!DOCTYPE html>
<html lang="en">
@include('admin.theme.head',['title' => 'Admin Dashboard'])
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('admin.theme.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">All Users</h3>
                <div class="card-title float-right">
                    <a href="/admin/add-user" class="text-muted">
                        <button class="btn btn-info">Add new user</button>
                    </a>
                </div>
              </div>
              <div class="card-body table-responsive">
                <table id="example1" class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Username</th>
                    <th>Is Active</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th style="text-align:right">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->status ? 'Yes' : 'No'}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td style="text-align:right">
                                @if ($user->user_type != 0)
                                    <button class="btn btn-danger" onclick="deleteUser({{$user->id}})">Delete Users</button>
                                @endif
                                <a href="/admin/edit-user/{{$user->id}}" class="text-muted">
                                    <button class="btn btn-primary">Edit Users</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

@include('admin.theme.footer')

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  function deleteUser(id){
      var status = confirm('Are you sure you want to delete this user. After deleted you can no longer access this data.');
      if(status){
           location.replace('/admin/delete-user/'+id);
      }
  }
</script>
</div>
</body>
</html>
