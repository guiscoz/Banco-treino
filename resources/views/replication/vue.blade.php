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
<script>
    new Vue({
        el: '#replicas',
        template: `
            <h1>Comentários</h1>
            <hr />
            <div class="form-todo form-group">
                <p>
                <input placeholder="nome" type="text" name="author" class="form-control" v-model="name" />
                </p>
                <p>
                <textarea placeholder="Comentário" name="message"  class="form-control" v-model="message"></textarea>
                </p>
                <button v-on:click="addComment" type="submit" class="btn btn-primary">Comentar</button>
            </div>
            <div class="list-group">
                <div class="list-group-item" v-for="(comment, index) in allComments">
                <span class="comment__author">Autor: <strong>Replica</strong></span>
                <p>Replica</p>
                <div>
                    <a href="#" title="Excluir" v-on:click.prevent="removeComment(index)">Excluir</a>
                </div>
                </div>
            </div>
            <hr />
        `,
        data() {
            return {
            comments: [],
            name: '',
            message: ''
            }
        },
        methods: {
            addComment() {
                this.comments.push({
                    name: this.name,
                    message: this.message
                });

                this.name = '';
                this.message = '';
            },
            removeComment(index) {
                this.comments.splice(index, 1);
            }
        }
    })
</script>