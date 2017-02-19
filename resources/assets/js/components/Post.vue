<template>
    <div class="media">
        <like-button :post="post" v-if="post.likedByCurrentUser === false && post.user.id !== this.$root.user.id"></like-button>

        <div class="media-left">
            <a href="#">
                <img class="media-object" :src="post.user.avatar" :alt="post.user.name + ' avatar'">
            </a>
        </div>
        <div class="media-body">
            <strong>{{ post.user.name }}</strong>
            <p>{{ post.body }}</p>
            <p>{{ post.likeCount }} {{ pluralize('like', post.likeCount) }}</p>
        </div>
    </div>
</template>

<script>
    import LikeButton from './LikeButton.vue';
    import pluralize from 'pluralize';

    export default {
        props: [
            'post'
        ],
        component: {
            'like-button': LikeButton
        },
        methods: {
            pluralize
        },
        mounted() {
        }
    }
</script>

<style scoped>
    .media {
        position: relative;
        margin: 0;
        padding: 10px;
    }

    .media:hover .like {
        display: block;
    }
</style>
