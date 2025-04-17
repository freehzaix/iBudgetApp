@extends('layout.base')

@section('titlePage')
    Profile
@endsection

@section('contentPage')
    <div class="content-body default-height">
        <!-- row -->
        <div class="container-fluid">
            <div class="row bt-3">
                <h2>Modifier mes informations personnelles</h2>
                @if (session('status'))
                    <div class="alert alert-success"> {{ session('status') }} </div>
                @endif
            </div>
            <div class="row mt-3">
                <div class="col">
                    <form action="{{ route('profile', Auth::user()->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        
                        <div class="form-group">
                            <label for="nom" class="text-black font-w600">Nom <span class="required">*</span></label>
                            <input type="text" class="form-control" value="{{ Auth::user()->nom }}" name="nom"
                                placeholder="Nom de famille" id="nom">
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="text-black font-w600">Prénom <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control" value="{{ Auth::user()->prenom }}" name="prenom"
                                placeholder="Prénom" id="prenom">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-black font-w600">E-mail <span
                                    class="required">*</span></label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email"
                                placeholder="E-mail" id="email" disabled>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="submit btn btn-primary" value="Enregistrer les modifications" />
                        </div>
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
@endsection
