<template>
    <form action="#" class="form-vertical" @submit.prevent="post">
        <div class="form-group">
            <textarea class="form-control" cols="30" rows="3" placeholder="Write something likable" v-model="body"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn bt-default">Post it!</button>
        </div>
    </form>
</template>

<script>
    import eventHub from '../event'

    export default {
        data () {
            return {
                body: null
            }
        },
        methods: {
            post () {
                axios.post('/posts', {
                    body: this.body
                }).then((response) => {
                    // Sucess Request
                    eventHub.$emit('post-added', { data: response.data });
                    this.body = null;
                });
            }
        }
    }
</script>
