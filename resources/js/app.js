// require('./bootstrap');
import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleTagsInput from './components/ArticleTagsInput'
import FollowButton from './components/FollowButton'
import ThumbnailArea from './components/ThumbnailComponent'
import GoogleMap from './components/GoogleMap'
import ArticleJoin from './components/ArticleJoin'

const app = new Vue({
    el: '#app',
    components: {
    ArticleLike,
    ArticleTagsInput,
    FollowButton,
    ThumbnailArea,
    GoogleMap,
    ArticleJoin,
    }
})