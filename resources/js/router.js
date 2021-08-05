import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Home from './pages/Home';
import About from './pages/About';
import Blog from './pages/Blog';
import Post from './pages/Post';
import NotFound from './pages/NotFound';
import Category from './pages/Category';
import Tag from './pages/Tag';
import Contact from './pages/Contact';

const router = new VueRouter(
    {
        mode: 'history',
        linkExactActiveClass: 'active',
        routes: [
            {
                path: '/',
                name: 'home',
                component: Home
            },
            {
                path: '/about',
                name: 'about',
                component: About
            },
            {
                path: '/contacts',
                name: 'contacts',
                component: Contact
            },
            {
                path: '/blog',
                name: 'blog',
                component: Blog
            },
            {
                path: '/blog/:slug',
                name: 'post',
                component: Post
            },
            {
                path: '/blog/category/:slug',
                name: 'category',
                component: Category
            },
            {
                path: '/blog/tag/:slug',
                name: 'tag',
                component: Tag
            },
            {
                path: '*',
                name: 'not-found',
                component: NotFound
            }
        ]
    }
);

export default router;