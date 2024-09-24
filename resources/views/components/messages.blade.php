@if(@session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            @if(@session('action') === "add" )
                Monitor "<b>{{ session('name') }}</b>" for "<b>{{ session('url') }}</b>" added successfully.
            @endif

            @if(@session('action') === "update" )
                Monitor "<b>{{ session('name') }}</b>" for "<b>{{ session('url') }}</b>" modified successfully.
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