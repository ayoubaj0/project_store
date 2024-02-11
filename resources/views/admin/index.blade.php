@extends('layouts.admin')
@section('title', 'Mon commandes')
@section('content')

    <form action="{{ route('admin.index') }}" method="GET" class="row g-3">
        @csrf

        <div class="col-md-3">
            <label for="etat" class="form-label">Etat:</label>
            <select id="etat" name="etat" class="form-select">
                <option value="" selected disabled>Select Etat</option>
                <option value="En_attente_de_confirmation">En attente de confirmation</option>
                <option value="confirmee">Confirmée</option>
                <option value="envoyee">Envoyée</option>
                <option value="payee">Payée</option>
                <option value="retournee">Retournée</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="nom" class="form-label">Nom:</label>
            <input type="text" name="nom" id="nom" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control">
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    <h1>List des commandes</h1>
    <a href="{{ route('admin.exportCSV') }}" class="btn btn-success mb-3">Export CSV</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Date/Time</th>
                <th>Prix Total</th>
                <th>Client ID</th>
                <th>Nom de Client</th>
                <th>Prenom de Client</th>
                <th>Ville</th>
                <th>Telephone</th>
                <th>Etat</th>
                <th>Changer Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->date }}</td>
                    <td>{{ $commande->total_prix }} MAD</td>
                    <td>{{ $commande->client_id }}</td>
                    <td>{{ $commande->nom }}</td>
                    <td>{{ $commande->prenom }}</td>
                    <td>Agadir</td>
                    <td>{{ $commande->tele }}</td>
                    <td class="etatchange">
                    <div  class=" oldetat
                         @if($commande->etat == 'En_attente_de_confirmation') alert alert-danger
                         @elseif($commande->etat == 'confirmee') alert alert-warning
                         @elseif($commande->etat == 'envoyee') alert alert-info
                         @elseif($commande->etat == 'payee') alert alert-success
                         @elseif($commande->etat == 'retournee') alert alert-secondary
                         @endif
                     ">
                         {{ $commande->etat }}
                     </div>
                    </td>

                    <td>
                        <form action="{{ route('admin.changeEtat') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to change the Etat?')">
                            @csrf
                            {{-- @method('PUT') --}}
                
                            <select id="etatSelect" name="etat" class="form-select">
                                <option value="{{ $commande->etat }}"  selected>Select Etat</option>
                                @if($commande->etat == 'En_attente_de_confirmation')
                                    <option value="confirmee">Confirmée</option>
                                @elseif($commande->etat == 'confirmee')
                                    <option value="envoyee">Envoyée</option>
                                @elseif($commande->etat == 'envoyee')
                                    <option value="payee">Payée</option>
                                @elseif($commande->etat == 'payee')
                                    <option value="retournee">Retournée</option>
                                @endif
                            </select>
                            <input type="hidden" name="command_id" value="{{ $commande->id }}">
                            <button type="submit" class="btn btn-success etatsubmit">Submit Changes</button>
                        </form>
                    </td>
                    <td><a href="{{ route('commandes.show', ['commande' => $commande->id ]) }}" class="btn btn-info">Details</a></td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <button id="exportCSV2" class="btn btn-warning mb-3">Export CSV 2</button> --}}
    {{-- <a href="{{ route('admin.exportCSV') }}" id="exportCSV2" class="btn btn-warning mb-3">Export CSV 2</a> --}}

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.etatsubmit').on('click', function(e) {
            e.preventDefault();

            var form = $(this).closest('form');
            var formData = form.serialize();
            

           // var oldEtat = form.closest('tr').find('.oldetat').text();
            var newEtat = form.find('select[name="etat"]').val();
            var newEtatdiv ="<div  class='etatchange ";
            
            // console.log("oldEtat"+newEtat);
            // console.log(newEtat);

            // console.log(oldEtat);
            var optionsHtml = '<option value="" disabled  >Select Etat</option>';
            
            
            if (newEtat === 'En_attente_de_confirmation') {
                optionsHtml += '<option value="confirmee">Confirmee</option>';
                newEtatdiv +="alert alert-danger"
            } else if (newEtat === 'confirmee') {
                optionsHtml += '<option value="envoyee">Envoyée</option>';
                newEtatdiv +="alert alert-warning"
            } else if (newEtat === 'envoyee') {
                optionsHtml += '<option value="payee">Payée</option>';
                newEtatdiv +="alert alert-info"
            } else if (newEtat === 'payee') {
                optionsHtml += '<option value="retournee">Retournée</option>';
                newEtatdiv +="alert alert-success"
            }  else if (newEtat === 'retournee') { 
                // optionsHtml += '<option value="En_attente_de_confirmation">En_attente_de_confirmation</option>';
                optionsHtml += '<option value="retournee">Retournée</option>';

                newEtatdiv +="alert alert-secondary"
            }

            newEtatdiv +="'> "+newEtat+"</div>"
            form.closest('tr').find('.etatchange').html(newEtatdiv);
            form.find('#etatSelect').html(optionsHtml);
            
            $.ajax({
                url: "{{ route('admin.changeEtat') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log("Success!");
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
  
        $('#exportCSV2').on('click', function(e) {

            $.ajax({
                url: "{{ route('admin.exportCSV') }}",
                type: 'GET',
                success: function(response) {
                    console.log("CSV Export Success!");
                },
                error: function(error) {
                    console.error('CSV Export Error:', error);
                }
            });
        });
    });
</script> --}}

    

@endsection
