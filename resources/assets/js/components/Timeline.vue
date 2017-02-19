<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Timeline</div>

                    <div class="panel-body">
                        <!-- <post-form v-on:post-added="addPost"></post-form> -->
                        <post-form></post-form>
                        <hr>
                        <post v-for="post in posts" :post="post" v-model="posts"></post>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import eventHub from '../event';
    import Post from './Post.vue';
    import PostForm from './PostForm.vue';

    export default {
        data() {
            return {
                posts: []
            }
        },
        components: {
            'post': Post,
            'post-form': PostForm
        },
        methods: {
            addPost (post) {
                this.posts.unshift(post);
            },
            likePost (postId, likedByCurrentUser) {
                for (var i = 0; i < this.posts.length; i++) {
                    if (this.posts[i].id === postId) {
                        this.posts[i].likeCount++;

                        if (likedByCurrentUser) {
                            this.posts[i].likedByCurrentUser = true;
                        }

                        break;
                    }
                }
            }
        },
        mounted() {
            eventHub.$on('post-added', this.addPost);
            eventHub.$on('post-liked', this.likePost);

            axios.get('/posts').then((response) => {
                
                Echo.private('post-created').listen('PostWasCreated', (e)=> {
                    eventHub.$emit('post-added', e.post);
                });

                Echo.private('post-liked').listen('PostWasLiked', (e)=> {
                    eventHub.$emit('post-liked', e.post.id, false);
                });

                if (window.Notification && Notification.permission !== 'denied') {  
                    Notification.requestPermission((status) => {
                        Echo.private('App.User.' + this.$root.user.id ).listen('PostWasLiked', (e)=> {
                            new Notification('Post Liked', {
                                body: e.user.name + ' Liked Your Post "' + e.post.body + '"'
                            });
                        });
                    });
                }


                this.posts = response.data;
            });

        }
    }
</script>
