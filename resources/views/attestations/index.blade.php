@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Liste des attestations</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('attestations.create') }}" class="btn btn-primary mb-3">Ajouter une attestation</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Utilisateur</th>
                    <th>Formation</th>
                    <th>Date</th>
                    <th>Fichier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attestations as $attestation)
                    <tr>
                        <td>{{ $attestation->user->nom }} {{ $attestation->user->prenom }}</td>
                        <td>{{ $attestation->formation->type }}</td>
                        <td>{{ $attestation->date_emission }}</td>
                        <td>{{ $attestation->fichier_pdf }}</td>
                        <td>
                            <a href="{{ route('attestations.download', $attestation->id) }}" class="btn btn-sm btn-success">📥
                                Télécharger</a>

                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#pdfModal"
                                onclick="setPDF('{{ asset('storage/attestations/' . $attestation->fichier_pdf) }}')">
                                👁 Aperçu
                            </button>

                            <form action="{{ route('attestations.destroy', $attestation) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cette attestation ?')"
                                    class="btn btn-sm btn-danger">
                                    🗑 Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aperçu de l'attestation PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfFrame" src="" width="100%" height="600px" style="border:none;"></iframe>
                </div>
                <div class="mt-3">
                    {{ $attestations->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function setPDF(url) {
            document.getElementById('pdfFrame').src = url;
        }
    </script>
@endsection
