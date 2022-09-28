@extends('layouts.main')

@section('title', 'Replicação com Vue.js')

@section('content')
    <div class="container pb-5">
        <section class="content col-12 mt-5">
            <div class="card p-3 mb-5">
                <div class="card-title"><h1>Replicação com Vue.js</h1></div>
            </div>

            <div id="replicas"></div>

            <div class="card mt-5 p-3">
                <div class="card-date d-flex">
                    <a href="react" class="mr-3">Replicação com React.js</a>
                    <a href="/">Página inicial</a>
                </div>
            </div>
        </section>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://unpkg.com/vue@next"></script>
<script>
    const app = Vue.createApp({
        template: '<h2>Vue Replica</h2>'
    });
    console.log(app);
    app.mount("#replicas");
</script>