
<html lang="en">
<head>
    <title>demo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<body>
    <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">

          </div>
          <div class="panel-body">
 
            <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
            <a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
 
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ url('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf
 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
 
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
 
                <input type="file" name="import_file" />
                <button class="btn btn-primary">Import File</button>
            </form>

            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name

      </th>
      <th class="th-sm">Position

      </th>
      <th class="th-sm">Office

      </th>
      <th class="th-sm">Age

      </th>
      <th class="th-sm">Start date

      </th>
      <th class="th-sm">Salary

      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Tiger Nixon</td>
      <td>System Architect</td>
      <td>Edinburgh</td>
      <td>61</td>
      <td>2011/04/25</td>
      <td>$320,800</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <th>Name
      </th>
      <th>Position
      </th>
      <th>Office
      </th>
      <th>Age
      </th>
      <th>Start date
      </th>
      <th>Salary
      </th>
    </tr>
  </tfoot>
</table>

 
          </div>
        </div>
    </div>
</body>
<script>
    
</script>
</html>