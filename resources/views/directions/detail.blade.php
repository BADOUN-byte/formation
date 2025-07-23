<h3>{{ $direction->nom }}</h3>

@if($direction->description)
    <p>{{ $direction->description }}</p>
@endif

<h4>Services</h4>
@if($direction->services->count())
    <ul>
        @foreach($direction->services as $service)
            <li>{{ $service->nom }}</li>
        @endforeach
    </ul>
@else
    <p>Aucun service trouvé.</p>
@endif

<h4>Formations</h4>
@if($direction->formations->count())
    <ul>
        @foreach($direction->formations as $formation)
            <li>{{ $formation->nom }}</li>
        @endforeach
    </ul>
@else
    <p>Aucune formation trouvée.</p>
@endif
