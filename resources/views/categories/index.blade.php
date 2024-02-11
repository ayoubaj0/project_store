@extends('layouts.admin')
@section('title', 'Gestion des categories')
@section('content')
    <div class="container mt-3">
        <h1>Liste des categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Ajouter une nouvelle categorie</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Description</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td class="cat-id">{{ $cat->id }}</td>
                        <td class="cat-designation">{{ $cat->designation }}</td>
                        <td class="cat-description">{{ $cat->description }}</td>
                        <td><a href="{{ route('categories.show', ['category' => $cat->id]) }}" class="btn btn-info">Details</a></td>
                        <td>
                            {{-- <a href="{{ route('categories.edit', ['category' => $cat->id]) }}" class="btn btn-warning edit-btn">Edit</a> --}}
                            <form action="{{ route('categories.update', ['category' => $cat->id]) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-warning edit-btn" >Edit</button>
                            </form>
                        </td>
                        <td>
                            {{-- <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn btn-danger" value="Supprimer"
                                    onclick="return confirm('Voulez-vous supprimer cette categorie?')">
                            </form> --}}
                            
                                <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="edit-delete btn btn-danger" onclick="return confirm('Voulez-vous supprimer cette categorie?')">Supprimer</button>
                                </form>
                                
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
    $('.edit-delete').click(function (e) {
        e.preventDefault();       
        var $row = $(this).closest('tr');  
        var id = $row.find('.cat-id').text();
       console.log(id);
        $.ajax({
            type: 'DELETE',
            url: "{{ route('categories.destroy', ['category' => ':id']) }}".replace(':id', id),
            data: {
                _token: '{{ csrf_token() }}'
            },
            // headers: {
            //     // 
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            success: function (data) {
                // Handle success, e.g., update the UI or display a message
                console.log(data.message);
                $row.remove();
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., display an error message
                console.error('Error:', error);
            }
        });
    });
});

    </script>
    <script>
        $('.edit-btn').click(function () {
    let btn_text = $(this).text();

    if (btn_text === 'Edit') {
        let $row = $(this).closest('tr');
        let id = $row.find('.cat-id').text();
        let cat_designation = $row.find('.cat-designation').text();
        let description = $row.find('.cat-description').text();

        // Replace the text with text boxes
        $row.find('.cat-designation').html('<input type="text" class="edit-designation" value="' + cat_designation + '">');
        $row.find('.cat-description').html('<input type="text" class="edit-description" value="' + description + '">');

        $(this).text('Save');
    } else {
        let $row = $(this).closest('tr');
        let id = $row.find('.cat-id').text();
        let newcat_designation = $row.find('.edit-designation').val();
        let newDescription = $row.find('.edit-description').val();

        $.ajax({
            type: 'PUT',
            url: "{{ route('categories.update', ['category' => 'id']) }}".replace('id', id),
            data: {
                designation: newcat_designation,
                description: newDescription,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log(response);
                $row.find('.cat-designation').text(newcat_designation);
                $row.find('.cat-description').text(newDescription);
                $row.find('.edit-btn').text('Edit');
            },
            error: function (error) {
                console.log(error);
                $row.find('.edit-btn').text('Edit');
            }
        });
    }
});

    </script>
@endsection
