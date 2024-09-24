@include('layouts.header')
    
    <p class="fs-3">
        Active Monitors
        <a href="#"  type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#newMonitor"><i class="bi bi-plus-circle"></i> New Monitor</a>
    </p>
    
    <br><br>

    @include("components.messages")
    @include("components.monitorsList")
    @include("components.modalNewMonitor")
    @include("components.modalUpdateMonitor")



@include('layouts.footer')