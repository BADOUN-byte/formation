<h2>Liste des Directions</h2>
@foreach($directions as $direction)
    <div>
        <h3>{{ $direction->nom }}</h3>
        @foreach($direction->services as $service)
            <ul>
                @foreach($service->formations as $formation)
                    <li>{{ $formation->titre }}</li>
                @endforeach
            </ul>
        @endforeach
    </div>
@endforeach
