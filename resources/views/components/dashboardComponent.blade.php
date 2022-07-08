<table class="table table-striped">
    <head>
        <tr>
            @foreach ($contents as $key => $content)
                <th scope="col">{{ $content }}</th>
            @endforeach
        </tr>
    </head>

    <tbody>
        @foreach($accounts as $account)
            <tr>
                <td scope="row">{{$loop->index+1}}</td>
                <td>{{ $account->name }}</a></td>
                <td>{{ $account->number }}</td>
                <td>R$ {{ number_format($account->fund, 2) }}</td>
                <td class="d-flex">
                    <a href="/accounts/edit/{{ $account->id }}" class="btn btn-info edit-btn">
                        <i class="fa-solid fa-file-pen"></i></i>Editar
                    </a> 
                    <form action="/accounts/{{ $account->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <i class="fa-solid fa-trash"></i> Deletar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>