<x-sidebar>
    <div class="col-lg-4 ol-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">Access Role</h4>
            <form action="/addRole" method="post">
            <div class="card-content">
                <div class="form-group margin-bottom-20">
                    <select class="form-control">
                        <option value="">Employee Name</option>
                        <option value="1">Dropdown 1</option>
                        <option value="2">Dropdown 1</option>
                        <option value="3">Dropdown 1</option>
                    </select>
                </div>

                <div class="form-group margin-bottom-20">
                    <select class="form-control">
                        <option value="">Role</option>
                        <option value="1">Dropdown 1</option>
                        <option value="2">Dropdown 1</option>
                        <option value="3">Dropdown 1</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-sm waves-effect waves-light">Submit</button>


            </div>
        </form>

        </div>

    </div>
</x-sidebar>
