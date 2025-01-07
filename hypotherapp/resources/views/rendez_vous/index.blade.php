@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1 class="text-center mb-4">Gestion journalière</h1>

        <div class="row">
            <!-- Section gauche : Rendez-vous prévus -->
            <div class="col-md-7">
                <!-- Date en court en francais-->
                <h2 class="mb-3"><?php echo // Date en français

                                date('d-m-Y');?></h2>

                <h4>Rendez-vous prévus :</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Z'amis des Z'animaux</span>
                        <span>12h30 à 14h30</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>L'école les foufous</span>
                        <span>13h à 16h</span>
                    </li>
                </ul>

                <h4>Assigner 4 poneys : <small>4 Personnes attendues</small></h4>
                <form class="mb-3">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Poney 1</option>
                                <option>Mercenaire</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Poney 2</option>
                                <option>Bébert le gros</option>
                                <option>Anastallion</option>
                                <option>Gérard Tacos</option>
                                <option>Gros Tonnerre</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Mercenaire</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Poney 4</option>
                                <option>Bébert le gros</option>
                                <option>Anastallion</option>
                                <option>Gérard Tacos</option>
                                <option>Gros Tonnerre</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmer</button>
                </form>

                <h4>Rendez-vous passés :</h4>
                <ul class="list-group">
                    @foreach ($clients as $client)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $client->nom }}</span>
                            <span>{{ $client->heures }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Section droite : Enregister un Rendez-vous et Enregistrer un nouveau client -->
            <div class="col-md-5">
                <h4 class="mb-3">Enregistrer un rendez-vous :</h4>
                <form action="{{ route('rendez_vous.store') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input type="text" name="nom" class="form-control" placeholder="Nom du rendez-vous" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input type="datetime-local" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <select class="form-select">
                                <option>Poney 1</option>
                                <option>Mercenaire</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
                <h4 class="mb-3">Enregistrer un nouveau client :</h4>
                <form action="{{ route('clients.store') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <input type="text" name="nom" class="form-control" placeholder="Nom du client" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="nombre_personnes" class="form-control" placeholder="Nbr personnes" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <input type="text" name="heures" class="form-control" placeholder="Heures" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="prix" class="form-control" placeholder="Prix" required>
                        </div>
                    </div>

                    <h5 class="mt-3">Assigner des poneys :</h5>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <select class="form-select">
                                <option>Poney 1</option>
                                <option>Bébert le gros</option>
                                <option>Anastallion</option>
                                <option>Gérard Tacos</option>
                                <option>Gros Tonnerre</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select">
                                <option>Poney 2</option>
                                <option>Bébert le gros</option>
                                <option>Anastallion</option>
                                <option>Gérard Tacos</option>
                                <option>Gros Tonnerre</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <select class="form-select">
                                <option>Gérard Tacos</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
