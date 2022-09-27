@extends('layouts.main')

@section('title', 'Replicação com React.js')

@section('content')
    <div class="container pb-5">
        <section class="content col-12 mt-5">
            <div class="card p-3 mb-5">
                <div class="card-title"><h1>Replicação com React.js</h1></div>
            </div>

            <div class="card mt-5 p-3">
                <div class="card-date d-flex">
                    <a href="vue" class="mr-3">Replicação com Vue.js</a>
                    <a href="/">Página inicial</a>
                </div>
            </div>
        </section>
    </div>
@endsection

<script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>