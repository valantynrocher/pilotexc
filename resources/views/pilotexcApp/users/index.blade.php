@extends('layouts.app')

@section('title')Utilisateurs
@endsection

@section('subTitle')Liste
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#list" data-toggle="tab">Liste</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"><i class="fas fa-plus-circle mr-2"></i>Nouveau</a></li>
              <li class="nav-item"><a class="nav-link disabled" href="#settings" data-toggle="tab"><i class="fas fa-user-edit mr-2"></i>Modifier</a></li>
            </ul>
        </div><!-- /.card-header -->

        <div class="card-body">
            <div class="tab-content">
                <!-- List users tab pane -->
                <div class="tab-pane active" id="list">
                    <div class="table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>183</td>
                                    <td>John Doe</td>
                                    <td>11-7-2014</td>
                                    <td><span class="tag tag-success">Approved</span></td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.tab-pane -->

                <!-- Create user tab pane -->
                <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</section>
<!-- /.content -->
@endsection
