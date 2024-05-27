<x-sidebar>
    <div class="col-lg-6 col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">Add Employee</h4>

            <div class="card-content">
                <form>
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone1">Phone</label>
                        <input type="text" class="form-control" id="exampleInputPhone1" placeholder="Enter phone">
                    </div>

                    <div class="form-group">
                        <label>Type </label>
                        <div class="radio">
                            <input type="radio" name="type" id="underwear1" required="">
                            <label for="underwear1">Client</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="type" id="underwear2" required="">
                            <label for="underwear2">Student</label>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-sm waves-effect waves-light">Submit</button>
                </form>
            </div>

        </div>

    </div>
</x-sidebar>
