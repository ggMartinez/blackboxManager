@include('layouts.header')

    
    <p class="fs-3">
        Active Monitors
        <a href="#"  type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#newMonitor"><i class="bi bi-plus-circle"></i> New Monitor</a>
    </p>
    
    <br><br>

    @if(@session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            @if(@session('action') === "add" )
                Monitor "<b>{{ session('name') }}</b>" for "<b>{{ session('url') }}</b>" added successfully.
            @endif

            @if(@session('action') === "delete" )
                Monitor "<b>{{ session('name') }}</b>" for "<b>{{ session('url') }}</b>" deleted successfully.
            @endif


            @if(@session('action') === "import" )
                Monitors imported successfully.
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(@session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
             @if(@session('action') === "export" )
               No monitors to export.
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <hr class="bg border-2 border-top border" />
    

    <div id="newMonitor" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Monitor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/monitor" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="category">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            
            </div>
        </div>
    </div>

    


    
    @if($categorizedMonitors === null || count($categorizedMonitors) === 0)
        <br>
        <h3>No monitors found.</h3>
    @else 

        @foreach($categorizedMonitors as $category)
            <h4>{{ $category['category'] }}</h4>
            <table class="table table-striped table-hover">
                <thead> 
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Category</th>
                        <th>Added Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach($category['sites'] as $site)
                        <tr>
                            <td>{{ $site->name }}</td>
                            <td>{{ $site->url }}</td>
                            <td>{{ $site->category }}</td>
                            <td>{{ $site->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="/monitor/{{ $site->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                <a href="/monitor/{{ $site->id }}/delete" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br> <br>
            <hr class="bg border-2 border-top border" />

        @endforeach        
    @endif

@include('layouts.footer')