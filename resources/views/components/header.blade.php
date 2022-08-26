<div>
    @if(empty($username))
        <h1 class="mb-3">Bem-vindo ao nosso site</h1>
    @else
        <h1 class="mb-3">Bem-vindo {{ $username }}, sinta-se a vontade para mexer nas suas contas.</h1>
    @endif
</div>