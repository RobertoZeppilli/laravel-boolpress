<template>
  <div>
    <Header />
    <main class="container">
      <div class="row">
        <Card v-for="post in posts" 
        :key="post.id" 
        :post="post" 
        :categories="categories"
        />
      </div>
      <Paginate
        :current="current_page"
        :last="last_page"
        @active="activePosts"
        @prev="getPosts(current_page - 1)"
        @next="getPosts(current_page + 1)"
      />
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from "./components/Header";
import Card from "./components/Card";
import Paginate from "./components/Paginate";
import Footer from "./components/Footer";

export default {
  name: "App",
  components: {
    Header,
    Card,
    Paginate,
    Footer,
  },
  data() {
    return {
      posts: [],
      categories: [],
      // tags: [],
      current_page: 1,
      last_page: 1,
      num: 0
    };
  },
  methods: {
    truncateText(string, charsNumber) {
      if (string.length > charsNumber) {
        return string.substr(0, charsNumber) + "...";
      } else {
        return string;
      }
    },
    getPosts(page = 1) {
      axios
        .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
        .then((res) => {
          this.posts = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;

          this.posts.forEach((post) => {
            post.extract = this.truncateText(post.body, 150);
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCategories() {
      axios.get('http://127.0.0.1:8000/api/categories')
      .then(res => {
        this.categories = res.data;
      })
      .catch(err => {
        console.log(err);
      })
    },
    getTags() {
      axios.get('http://127.0.0.1:8000/api/tags')
      .then(res => {
        this.tags = res.data;
      })
      .catch(err => {
        console.log(err);
      })
    },
    activePosts(n) {
      this.num = n
      this.getPosts(this.num);
    }
  },
  created() {
    this.getPosts();
    this.getCategories();
    // this.getTags()
  },
};
</script>

<style lang="scss">
</style>


// :getPaginate="getPosts"