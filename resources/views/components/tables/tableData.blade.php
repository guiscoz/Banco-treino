<tr>
    <td scope="row">{{$index}}</td>
    @foreach ($data as $key => $d)
        <td scope="col">{{ $d }}</td>
    @endforeach
    <td>
        <a href="/accounts/edit/{{ $id }}" class="btn btn-info edit-btn">
            <ion-icon name="create-outline"></ion-icon>Editar
        </a> 
        <form action="/accounts/{{ $id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger delete-btn">
                <ion-icon name="trash-outline"></ion-icon> Deletar
            </button>
        </form>
    </td>
</tr>