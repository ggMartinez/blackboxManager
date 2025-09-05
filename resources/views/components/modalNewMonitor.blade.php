    <div id="newMonitor" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Monitor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/monitor/add" method="post">
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

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" id="relevantCheckBox" name="relevant">
                        <label class="form-check-label" for="relevantCheckBox">
                            Relevant
                        </label>
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="authCheckBox">
                        <label class="form-check-label" for="authCheckBox">
                            Basic Authentication
                        </label>
                    </div>

                    <div id="auth">
                        <hr class="hr hr-blurry" />
                        
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <br>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
            
            </div>
        </div>
    </div>


    <script>
        $(function() {
            $("#auth").hide();
        });

        $("#authCheckBox").change(function() {
            if(this.checked) {
                $("#auth").show();
            } else {
                $("#auth").hide();
            }
        });

    </script>