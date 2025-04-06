@extends('layout.base')

@section('titlePage')
    Profile
@endsection

@section('contentPage')
    <div class="content-body default-height">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <h2>Modifier mes informations personnelles</h2>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="nom" class="text-black font-w600">Nom <span class="required">*</span></label>
                            <input type="text" class="form-control" value="{{ Auth::user()->nom }}" name="nom"
                                placeholder="Nom de famille" id="nom">
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="text-black font-w600">Prénom <span class="required">*</span></label>
                            <input type="text" class="form-control" value="{{ Auth::user()->prenom }}" name="prenom"
                                placeholder="Prénom" id="prenom">
                        </div>
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
@endsection
